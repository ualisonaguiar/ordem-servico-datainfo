package br.gov.inep;

import java.util.AbstractMap;
import java.util.Base64;
import java.util.Collections;
import java.util.Map;
import java.util.stream.Collectors;
import java.util.stream.Stream;

import com.google.common.base.Strings;

import io.netty.handler.codec.http.HttpResponseStatus;
import io.vertx.core.AbstractVerticle;
import io.vertx.core.eventbus.EventBus;
import io.vertx.core.http.HttpHeaders;
import io.vertx.core.json.JsonObject;
import io.vertx.ext.web.Router;
import io.vertx.ext.web.RoutingContext;
import io.vertx.ext.web.handler.BodyHandler;
import lombok.extern.slf4j.Slf4j;

@Slf4j
public class RestVerticle extends AbstractVerticle {

    public static final String DATE_REGEX = "^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\\d\\d$";
    public static final String TIME_REGEX = "([01]?[0-9]|2[0-3]):[0-5][0-9]";

    @Override
    public void start() throws Exception {
        final Router router = Router.router(vertx);
        router.route("/apex/*").handler(BodyHandler.create());
        router.post("/apex/lancamento").consumes("application/json").handler(this::handleLancamento);

        final Integer port = config().getJsonObject("webServer").getInteger("port");
        vertx.createHttpServer().requestHandler(router::accept).listen(port);

        RestVerticle.log.info("Webserver started at port: {}", port);
    }

    private void handleLancamento(final RoutingContext rc) {
        final String authorization = rc.request().headers().get(HttpHeaders.AUTHORIZATION);
        if (authorization == null) {
            rc.response().setStatusCode(HttpResponseStatus.UNAUTHORIZED.code())
                    .end("Header Authorization requerido");
        } else {
            final String token = authorization.split(" ")[1];
            final String[] credentials = decode(token).split(":");

            final EventBus eb = vertx.eventBus();
            final JsonObject body = rc.getBodyAsJson();

            body.put("usuario", credentials[0]);
            body.put("senha", credentials[1]);
            final JsonObject errors = validade(body);
            if (errors.isEmpty()) {

                eb.send("apex::lancarAtividade", body, rs -> {
                    if (rs.succeeded()) {
                        rc.response().end(rs.result().body().toString());
                    } else {
                        rc.response().setStatusCode(HttpResponseStatus.BAD_REQUEST.code())
                                .end(rs.cause().getMessage());
                    }
                });
            } else {
                rc.response().setStatusCode(HttpResponseStatus.BAD_REQUEST.code()).end(errors.encodePrettily());
            }
        }
    }

    private JsonObject validade(final JsonObject body) {
        final JsonObject errors = new JsonObject();

        if (!validDate(body.getString("data"))) {
            errors.put("data", "Formato invalido");
        }

        if (!validTime(body.getString("horaInicio"))) {
            errors.put("horaInicio", "Formato invalido");
        }

        if (!validTime(body.getString("horaFim"))) {
            errors.put("horaFim", "Formato invalido");
        }

        final String atividade = body.getString("atividade");
        final Integer codigoAtividade = CACHE_ATIVIDADES.get(atividade);
        if (codigoAtividade == null) {
            final String atividade2 = body.getString("atividade-pessoal");
            if (atividade2.isEmpty()) {
                errors.put("atividade", "Código de atividade inexistente: " + atividade);
            } else {
                body.put("atividade", String.valueOf(atividade2));
            }
        } else {
            body.put("atividade", String.valueOf(codigoAtividade));
        }

        if (Strings.isNullOrEmpty(body.getString("descricao"))) {
            errors.put("descricao", "Requerido!");
        }

        if (Strings.isNullOrEmpty(body.getString("numeroOS"))) {
            errors.put("numeroOS", "Requerido!");
        }

        return errors;
    }

    private String decode(final String token) {
        return new String(Base64.getDecoder().decode(token));
    }

    private boolean validDate(final String value) {
        return value.matches(RestVerticle.DATE_REGEX);
    }

    private boolean validTime(final String value) {
        return value.matches(RestVerticle.TIME_REGEX);
    }

    private static Map.Entry<String, Integer> entry(final String key, final int value) {
        return new AbstractMap.SimpleEntry<>(key, value);
    }

    private final Map<String, Integer> CACHE_ATIVIDADES = Collections.unmodifiableMap(Stream.of(entry("A1", 14475),
            entry("A2", 14476), entry("A3", 14477), entry("A4", 14478), entry("A5", 14479), entry("A6", 14480),
            entry("A7", 14481), entry("A8", 14482), entry("A9", 14483), entry("A10", 14484), entry("A11", 14485),
            entry("A12", 14486), entry("A13", 14487), entry("A14", 14488), entry("A15", 14489),
            entry("A16", 14490), entry("A17", 14491), entry("A18", 14492), entry("A19", 14493),
            entry("A20", 14477), entry("A21", 14477), entry("A22", 14477),

            entry("N1", 14495), entry("N2", 14496), entry("N3", 14497), entry("N4", 14498), entry("N5", 14499),
            entry("N6", 14500), entry("N7", 14501), entry("N8", 14502), entry("N9", 14503), entry("N10", 14504),
            entry("N11", 14505), entry("N12", 14506), entry("N13", 14507),

            entry("B1", 16103), entry("B2", 16104), entry("B3", 16105), entry("B4", 16106), entry("B5", 16107),
            entry("B6", 16108), entry("B7", 16109), entry("B8", 16110), entry("B9", 16111), entry("B10", 16112),
            entry("B11", 16113), entry("B12", 16114), entry("B13", 16115), entry("B14", 16116),
            entry("B15", 16117), entry("B16", 16118), entry("B17", 16119), entry("B18", 16120),
            entry("B19", 16121), entry("B20", 16122), entry("B21", 16123), entry("B22", 16124),
            entry("B23", 16125), entry("B24", 16126),

            entry("F0", 6814), entry("216335", 216335)

    ).collect(Collectors.toMap((e) -> e.getKey(), (e) -> e.getValue())));

}
