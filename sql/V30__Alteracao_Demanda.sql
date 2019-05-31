update tb_demanda set vl_complexidade = null, vl_impacto = null, vl_criticidade = null, vl_fator_ponderacao = null, vl_facim = null, vl_qma = null;

PRAGMA foreign_keys = 0;

CREATE TABLE sqlitestudio_temp_table AS SELECT *
                                        FROM tb_demanda;

DROP TABLE tb_demanda;

CREATE TABLE tb_demanda (
  id_demanda           INTEGER       PRIMARY KEY,
  id_atividade         INTEGER       REFERENCES tb_atividade (id_atividade),
  id_demanda_superior  INTEGER       REFERENCES tb_demanda (id_demanda),
  id_usuario           INTEGER       REFERENCES tb_usuario (id_usuario)
                                     NOT NULL,
  dt_abertura          DATE          NOT NULL,
  no_demanda           VARCHAR (500) NOT NULL,
  ds_descricao         TEXT          NOT NULL,
  no_projeto           VARCHAR (255),
  ds_ambiente          VARCHAR (255),
  ds_solucao           TEXT          NOT NULL,
  no_executor          CHAR,
  tp_situacao          INTEGER       NOT NULL
    DEFAULT (1),
  id_usuario_alteracao INTEGER       REFERENCES tb_usuario (id_usuario)
                                     NOT NULL,
  dt_alteracao         DATETIME      NOT NULL
);

INSERT INTO tb_demanda (
  id_demanda,
  id_atividade,
  id_demanda_superior,
  id_usuario,
  dt_abertura,
  no_demanda,
  ds_descricao,
  no_projeto,
  ds_ambiente,
  ds_solucao,
  no_executor,
  tp_situacao,
  id_usuario_alteracao,
  dt_alteracao
)
  SELECT id_demanda,
    id_atividade,
    id_demanda_superior,
    id_usuario,
    dt_abertura,
    no_demanda,
    ds_descricao,
    no_projeto,
    ds_ambiente,
    ds_solucao,
    no_executor,
    tp_situacao,
    id_usuario_alteracao,
    dt_alteracao
  FROM sqlitestudio_temp_table;

DROP TABLE sqlitestudio_temp_table;

CREATE UNIQUE INDEX uk_demanda_validar_ ON tb_demanda (
  dt_abertura,
  no_demanda,
  ds_descricao,
  ds_ambiente,
  ds_solucao,
  no_executor
);

PRAGMA foreign_keys = 1;

PRAGMA foreign_keys = 0;

CREATE TABLE sqlitestudio_temp_table AS SELECT *
                                        FROM tb_demanda;

DROP TABLE tb_demanda;

CREATE TABLE tb_demanda (
  id_demanda           INTEGER       PRIMARY KEY,
  id_atividade         INTEGER       REFERENCES tb_atividade (id_atividade),
  id_demanda_superior  INTEGER       REFERENCES tb_demanda (id_demanda),
  id_usuario           INTEGER       REFERENCES tb_usuario (id_usuario)
                                     NOT NULL,
  dt_abertura          DATE          NOT NULL,
  no_demanda           VARCHAR (500) NOT NULL,
  ds_descricao         TEXT          NOT NULL,
  no_projeto           VARCHAR (255) NOT NULL,
  ds_ambiente          VARCHAR (255),
  ds_solucao           TEXT          NOT NULL,
  no_executor          CHAR,
  tp_situacao          INTEGER       NOT NULL
    DEFAULT (1),
  id_usuario_alteracao INTEGER       REFERENCES tb_usuario (id_usuario)
                                     NOT NULL,
  dt_alteracao         DATETIME      NOT NULL
);

INSERT INTO tb_demanda (
  id_demanda,
  id_atividade,
  id_demanda_superior,
  id_usuario,
  dt_abertura,
  no_demanda,
  ds_descricao,
  no_projeto,
  ds_ambiente,
  ds_solucao,
  no_executor,
  tp_situacao,
  id_usuario_alteracao,
  dt_alteracao
)
  SELECT id_demanda,
    id_atividade,
    id_demanda_superior,
    id_usuario,
    dt_abertura,
    no_demanda,
    ds_descricao,
    no_projeto,
    ds_ambiente,
    ds_solucao,
    no_executor,
    tp_situacao,
    id_usuario_alteracao,
    dt_alteracao
  FROM sqlitestudio_temp_table;

DROP TABLE sqlitestudio_temp_table;

CREATE UNIQUE INDEX uk_demanda_validar_ ON tb_demanda (
  dt_abertura,
  no_demanda,
  ds_descricao,
  ds_ambiente,
  ds_solucao,
  no_executor
);

PRAGMA foreign_keys = 1;

update tb_demanda set no_projeto = 'ApiDoc' where 'Apidoc';
