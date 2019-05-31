CREATE TABLE tb_aceite (
    id_aceite            INTEGER  PRIMARY KEY AUTOINCREMENT
                                  UNIQUE,
    id_usuario           INTEGER  REFERENCES tb_usuario (id_usuario)
                                  NOT NULL,
    dt_inicio             DATE,
    dt_fim                DATE,
    id_usuario_alteracao INTEGER  REFERENCES tb_usuario (id_usuario) NOT NULL,
    dt_alteracao         DATETIME NOT NULL
);

CREATE TABLE tb_aceite_ordem_servico (
  id_aceite_ordem_servico INTEGER PRIMARY KEY AUTOINCREMENT
                                  NOT NULL,
  id_aceite               INTEGER NOT NULL
    REFERENCES tb_aceite (id_aceite),
  id_ordem_servico        INTEGER REFERENCES tb_ordem_servico (id_ordem_servico)
);


CREATE UNIQUE INDEX uk_aceite_ordem_servico ON tb_aceite_ordem_servico (
  id_aceite,
  id_ordem_servico
);

CREATE TABLE tb_aceite_gestao (
  id_aceite_gestao   INTEGER       PRIMARY KEY AUTOINCREMENT
                                   NOT NULL,
  id_aceite          INTEGER       REFERENCES tb_aceite (id_aceite)
                                   NOT NULL,
  ds_usuario         VARCHAR (255) NOT NULL,
  in_tp_usuario      INTEGER       NOT NULL,
  dt_inicio          DATE          NOT NULL,
  dt_fim             DATE          NOT NULL,
  dt_alteracao       DATETIME      NOT NULL
);

DROP VIEW vw_demanda_vinculada_ordem_servico;

CREATE VIEW vw_demanda_vinculada_ordem_servico AS
  SELECT ordem_servico.id_ordem_servico,
    demanda.id_demanda,
    atividade.id_atividade,
    ordem_servico.ds_nome AS descricao_os,
    ordem_servico.nu_ordem_servico,
    ordem_servico.dt_emissao,
    ordem_servico.dt_prazo,
    catalogo_servico.no_catalogo_servico,
    atividade.co_atividade,
    atividade.no_atividade,
    demanda_servico.vl_complexidade,
    demanda_servico.vl_impacto,
    demanda_servico.vl_criticidade,
    demanda_servico.vl_fator_ponderacao,
    demanda_servico.vl_facim,
    demanda_servico.vl_qma,
    demanda.dt_abertura,
    demanda.no_executor,
    demanda.no_demanda,
    ordem_servico.tp_situacao
  FROM tb_ordem_servico ordem_servico
    INNER JOIN
    tb_ordem_servico_demanda ordem_servico_demanda ON ordem_servico_demanda.id_ordem_servico = ordem_servico.id_ordem_servico
    INNER JOIN
    tb_demanda_servico demanda_servico ON demanda_servico.id_demanda = ordem_servico_demanda.id_demanda
    INNER JOIN
    tb_catalogo_servico_atividade catalogo_servico_atividade ON catalogo_servico_atividade.id_catalogo_servico_atividade = demanda_servico.id_catalogo_servico_atividade
    INNER JOIN
    tb_catalogo_servico catalogo_servico ON catalogo_servico.id_catalogo_servico = catalogo_servico_atividade.id_catalogo_servico
    INNER JOIN
    tb_atividade atividade ON atividade.id_atividade = catalogo_servico_atividade.id_atividade
    INNER JOIN
    tb_demanda demanda ON demanda.id_demanda = ordem_servico_demanda.id_demanda
  ORDER BY ordem_servico_demanda.id_demanda ASC;

