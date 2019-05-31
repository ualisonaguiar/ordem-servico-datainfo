CREATE TABLE tb_justificava_ponto (
    id_justificava_ponto INTEGER  PRIMARY KEY AUTOINCREMENT
                                  NOT NULL,
    id_usuario           INTEGER  REFERENCES tb_usuario (id_usuario)
                                  NOT NULL,
    dt_justificativa     DATE     NOT NULL,
    hr_justificada       TIME     NOT NULL,
    id_usuario_alteracao INTEGER  NOT NULL,
    dt_alteracao         DATETIME NOT NULL
);

CREATE UNIQUE INDEX uk_hr_justificativa ON tb_justificava_ponto (
    id_usuario,
    dt_justificativa,
    hr_justificada
);

PRAGMA foreign_keys = 0;

CREATE TABLE sqlitestudio_temp_table AS SELECT *
                                          FROM tb_justificava_ponto;

DROP TABLE tb_justificava_ponto;

CREATE TABLE tb_justificava_ponto (
    id_justificava_ponto INTEGER  PRIMARY KEY AUTOINCREMENT
                                  NOT NULL,
    id_usuario           INTEGER  REFERENCES tb_usuario (id_usuario)
                                  NOT NULL,
    dt_justificativa     DATE     NOT NULL,
    hr_justificada       TIME     NOT NULL,
    id_usuario_alteracao INTEGER  NOT NULL
                                  REFERENCES tb_usuario (id_usuario),
    dt_alteracao         DATETIME NOT NULL
);

INSERT INTO tb_justificava_ponto (
                                     id_justificava_ponto,
                                     id_usuario,
                                     dt_justificativa,
                                     hr_justificada,
                                     id_usuario_alteracao,
                                     dt_alteracao
                                 )
                                 SELECT id_justificava_ponto,
                                        id_usuario,
                                        dt_justificativa,
                                        hr_justificada,
                                        id_usuario_alteracao,
                                        dt_alteracao
                                   FROM sqlitestudio_temp_table;

DROP TABLE sqlitestudio_temp_table;

CREATE UNIQUE INDEX uk_hr_justificativa ON tb_justificava_ponto (
    id_usuario,
    dt_justificativa,
    hr_justificada
);

PRAGMA foreign_keys = 1;

PRAGMA foreign_keys = 0;

CREATE TABLE sqlitestudio_temp_table AS SELECT *
                                          FROM tb_usuario;

DROP TABLE tb_usuario;

CREATE TABLE tb_usuario (
    id_usuario   INTEGER       PRIMARY KEY AUTOINCREMENT
                               NOT NULL,
    no_usuario   STRING (300)  NOT NULL,
    nu_pis       VARCHAR (12),
    ds_email     STRING (150)  NOT NULL
                               UNIQUE,
    ds_login     STRING (100)  UNIQUE,
    tp_vinculo   INTEGER       NOT NULL,
    in_ativo     BOOLEAN       DEFAULT (1),
    ds_hash_apex VARCHAR (500)
);

INSERT INTO tb_usuario (
                           id_usuario,
                           no_usuario,
                           nu_pis,
                           ds_email,
                           ds_login,
                           tp_vinculo,
                           in_ativo
                       )
                       SELECT id_usuario,
                              no_usuario,
                              nu_pis,
                              ds_email,
                              ds_login,
                              tp_vinculo,
                              in_ativo
                         FROM sqlitestudio_temp_table;

DROP TABLE sqlitestudio_temp_table;

PRAGMA foreign_keys = 1;

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
           ordem_servico.tp_situacao,
           usuario.id_usuario,
           demanda_servico.id_catalogo_servico_atividade
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
           INNER JOIN
           tb_usuario usuario ON usuario.id_usuario = demanda.id_usuario
     ORDER BY ordem_servico_demanda.id_demanda ASC;

