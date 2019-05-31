package br.gov.inep;

import java.io.IOException;

import org.apache.http.HttpHost;
import org.apache.http.client.methods.CloseableHttpResponse;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.CloseableHttpClient;
import org.apache.http.impl.client.HttpClientBuilder;
import org.apache.http.impl.client.HttpClients;
import org.apache.http.impl.client.LaxRedirectStrategy;
import org.apache.http.impl.conn.DefaultProxyRoutePlanner;
import org.apache.http.util.EntityUtils;
import org.jsoup.Jsoup;

import io.vertx.core.AbstractVerticle;
import io.vertx.core.Future;
import io.vertx.core.eventbus.Message;
import io.vertx.core.json.JsonObject;
import lombok.extern.slf4j.Slf4j;

@Slf4j
public class ApexVerticle extends AbstractVerticle {

    private static final String INIT_SESSION_URL =
            "http://sistema.datainfo.inf.br/apex/f?p=104:LOGIN:10137469284473";
    private static final String URL_LOGIN = "http://sistema.datainfo.inf.br/apex/wwv_flow.accept";
    private static final String URL_LOGOUT =
            "http://sistema.datainfo.inf.br/apex/apex_authentication.logout?p_app_id=104&p_session_id=";
    private static final String URL_LANCAMENTO_REALIZADO = "http://sistema.datainfo.inf.br/apex/wwv_flow.show";

    @Override
    public void start(final Future<Void> startFuture) throws Exception {
        vertx.eventBus().consumer("apex::lancarAtividade", this::handleApex);
        startFuture.complete();
    }

    private void handleApex(final Message<JsonObject> msg) {
        final JsonObject proxy = config().getJsonObject("proxy");

        try (CloseableHttpClient httpClient = createHttpClient(proxy)) {
            final JsonObject params = msg.body();
            final String sessionId = initSession(httpClient);
            final String token =
                    login(httpClient, sessionId, params.getString("usuario"), params.getString("senha"));
            efetuarLancamento(httpClient, sessionId, token, params);
            logout(httpClient, sessionId);

            msg.reply(new JsonObject().put("status", "OK"));
        } catch (final IllegalArgumentException ex) {
            ApexVerticle.log.error("Erro: {}", ex.getMessage());
            msg.fail(500, ex.getMessage());
        } catch (final IOException e) {
            e.printStackTrace();
        }
    }

    private CloseableHttpClient createHttpClient(final JsonObject proxySettings) {
        final HttpClientBuilder clientBuilder =
                HttpClients.custom().setRedirectStrategy(new LaxRedirectStrategy());

        if (proxySettings != null) {
            final HttpHost proxy = new HttpHost(proxySettings.getString("host"), proxySettings.getInteger("port"));
            final DefaultProxyRoutePlanner routePlanner = new DefaultProxyRoutePlanner(proxy);
            clientBuilder.setRoutePlanner(routePlanner);
        }

        return clientBuilder.build();
    }

    private String initSession(final CloseableHttpClient client) {
        try (CloseableHttpResponse response = client.execute(new HttpGet(ApexVerticle.INIT_SESSION_URL))) {
            final String responseBody = EntityUtils.toString(response.getEntity());
            final String sessionId = Jsoup.parse(responseBody).getElementById("pInstance").val();

            return sessionId;
        } catch (final IOException e) {
            throw new IllegalArgumentException(e.getMessage(), e);
        } catch (final ArrayIndexOutOfBoundsException e) {
            throw new IllegalArgumentException("Não foi possível recuperar o session_id no Apex", e);
        }
    }

    private String login(final CloseableHttpClient client, final String sessionId, final String usuario,
            final String senha) {
        final HttpPost postLogin = new HttpPost(ApexVerticle.URL_LOGIN);
        postLogin.setEntity(new FormParamsBuilder().add("p_flow_id", "104").add("p_flow_step_id", "101")
                .add("p_instance", sessionId).add("p_page_submission_id", "2793078410081")
                .add("p_request", "LOGIN").add("p_arg_names", "22836724431945509").add("p_t01", usuario)
                .add("p_arg_names", "22836815674945509").add("p_t02", senha)
                .add("p_page_checksum", "7E85DC8037E1A9FBFAA152291ECD2452").build());

        try (CloseableHttpResponse response = client.execute(postLogin);
                CloseableHttpResponse responseLancamento = client
                        .execute(new HttpGet("http://sistema.datainfo.inf.br/apex/f?p=104:100:" + sessionId))) {
            final String bodyLancamento = EntityUtils.toString(responseLancamento.getEntity());
            final int regexIndex = bodyLancamento
                    .indexOf(",\"attribute01\":\"#P100_NUMSEQESFORCO,#P100_USUARIO,#P100_DATAESFORCO,#");
            final String token = bodyLancamento.substring(regexIndex - 65, regexIndex - 1);
            return token;
        } catch (final IOException e) {
            throw new IllegalArgumentException(e.getMessage(), e);
        } catch (final StringIndexOutOfBoundsException e) {
            throw new IllegalArgumentException("Não foi possível efetuar o login no APEX", e);
        }
    }

    public void efetuarLancamento1(final CloseableHttpClient client, final String sessionId, final String token,
            final JsonObject params) {
        final HttpPost postLancamento = new HttpPost(ApexVerticle.URL_LANCAMENTO_REALIZADO);
        postLancamento
                .setEntity(new FormParamsBuilder().add("p_request", "PLUGIN=" + token).add("p_flow_id", "104")
                        .add("p_flow_step_id", "100").add("p_instance", sessionId).add("p_debug", "")

                        .add("p_arg_names", "P100_NUMSEQESFORCO").add("p_arg_names", "P100_F_APEX_USER")
                        .add("p_arg_names", "P100_DATAESFORCO")

                        .add("p_arg_values", "").add("p_arg_values", params.getString("usuario").toUpperCase())
                        .add("p_arg_values", params.getString("data"))

                        .build()

        );

        try (CloseableHttpResponse execute = client.execute(postLancamento)) {
            final String body = EntityUtils.toString(execute.getEntity());

            System.out.println("*****************************************************");
            System.out.println("Retorno efetuarLancamento1: " + body);
            System.out.println("*****************************************************");

            if (body.contains("informadas")) {
                throw new IllegalArgumentException("Horas já informadas");
            }
            if (body.contains("Fora do Periodo Permitido.")) {
                throw new IllegalArgumentException("Lançamento do Esforço fora do período permitido");
            }
            if (body.contains("O percentual de conclusão da OS somente pode ser incrementado.")) {
                throw new IllegalArgumentException(
                        "O percentual de conclusão da OS somente pode ser incrementado.");
            }
        } catch (final IOException e) {
            throw new IllegalArgumentException(e.getMessage(), e);
        }
    }

    public void efetuarLancamento(final CloseableHttpClient client, final String sessionId, final String token,
            final JsonObject params) {
        final HttpPost postLancamento = new HttpPost(ApexVerticle.URL_LANCAMENTO_REALIZADO);
        final String codigoProjeto = params.getString("atividade").equals(6814) ? Projeto.ADMINISTRATIVO.codigo
                : Projeto.ARQUITETURA.codigo;
        postLancamento
                .setEntity(new FormParamsBuilder().add("p_request", "PLUGIN=" + token).add("p_flow_id", "104")
                        .add("p_flow_step_id", "100").add("p_instance", sessionId).add("p_debug", "")

                        .add("p_arg_names", "P100_NUMSEQESFORCO").add("p_arg_names", "P100_SYSMSG")
                        .add("p_arg_names", "P100_DIAFUTURO").add("p_arg_names", "P100_PROGRESSO")
                        .add("p_arg_names", "P100_F_APEX_USER").add("p_arg_names", "P100_PERMISSAO")
                        .add("p_arg_names", "P100_DATAESFORCO").add("p_arg_names", "P100_DESCRICAO")
                        .add("p_arg_names", "P100_PROJETOUSUARIO").add("p_arg_names", "P100_SEQORDEMSERVICO")
                        .add("p_arg_names", "P100_HORINICIO").add("p_arg_names", "P100_HORFIM")
                        .add("p_arg_names", "P100_PERCONCLUSAO").add("p_arg_names", "P100_TIPOESFORCO")
                        .add("p_arg_names", "P100_TIP_ORDEM_SERVICO").add("p_arg_names", "P100_CHAMADO")

                        .add("p_arg_values", "").add("p_arg_values", "").add("p_arg_values", "N")
                        .add("p_arg_values", "").add("p_arg_values", params.getString("usuario").toUpperCase())
                        .add("p_arg_values", "S").add("p_arg_values", params.getString("data"))
                        .add("p_arg_values", params.getString("descricao")).add("p_arg_values", codigoProjeto)
                        .add("p_arg_values", params.getString("atividade"))
                        .add("p_arg_values", params.getString("horaInicio"))
                        .add("p_arg_values", params.getString("horaFim")).add("p_arg_values", "1")
                        .add("p_arg_values", "1").add("p_arg_values", "1").add("p_arg_values", "")

                        .build()

        );

        try (CloseableHttpResponse execute = client.execute(postLancamento)) {
            final String body = EntityUtils.toString(execute.getEntity());

            System.out.println("*****************************************************");
            System.out.println("Retorno: " + body);

            if (body.contains("informadas")) {
                throw new IllegalArgumentException("Horas já informadas");
            }
            if (body.contains("Fora do Periodo Permitido.")) {
                throw new IllegalArgumentException("Lançamento do Esforço fora do período permitido");
            }
            if (body.contains("O percentual de conclusão da OS somente pode ser incrementado.")) {
                throw new IllegalArgumentException(
                        "O percentual de conclusão da OS somente pode ser incrementado.");
            }
        } catch (final IOException e) {
            System.out.println("************************");
            System.out.println("Erro: " + e.getMessage());
            throw new IllegalArgumentException(e.getMessage(), e);
        }
    }

    private void logout(final CloseableHttpClient client, final String sessionId) {
        final String urlLogout = ApexVerticle.URL_LOGOUT + sessionId;
        try (CloseableHttpResponse execute = client.execute(new HttpGet(urlLogout))) {
        } catch (final IOException ex) {
        }
    }

}

enum Projeto {
    ADMINISTRATIVO("PJ588"), ARQUITETURA("PJ861"),;

    public final String codigo;

    Projeto(final String codigo) {
        this.codigo = codigo;
    }
}
