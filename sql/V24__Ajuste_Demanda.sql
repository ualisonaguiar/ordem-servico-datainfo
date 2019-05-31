update tb_ordem_servico set tp_situacao = 2 where nu_ordem_servico in (873,874,879,881,882,883,885,889,899,900,901,902,908,910,911,912,915,918,920,921,922,927);
update tb_demanda set id_usuario_alteracao = 23, id_usuario = 23 where no_executor = 'Jorge Luiz Ferreira de Souza Junior';
update tb_demanda set id_usuario_alteracao = 18, id_usuario = 18 where no_executor = 'Sergio Luciano Soares Gaiao';
update tb_demanda set id_usuario_alteracao = id_usuario, dt_alteracao = dt_abertura where id_usuario_alteracao is null;
update tb_demanda set dt_alteracao = dt_abertura where dt_alteracao is null;

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
  vl_complexidade      CHAR (2),
  vl_impacto           CHAR (2),
  vl_criticidade       CHAR (2),
  vl_fator_ponderacao  CHAR (2),
  vl_facim             CHAR (2),
  vl_qma               CHAR (2),
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
  vl_complexidade,
  vl_impacto,
  vl_criticidade,
  vl_fator_ponderacao,
  vl_facim,
  vl_qma,
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
    vl_complexidade,
    vl_impacto,
    vl_criticidade,
    vl_fator_ponderacao,
    vl_facim,
    vl_qma,
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
