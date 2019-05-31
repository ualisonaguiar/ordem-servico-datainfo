PRAGMA foreign_keys = 0;

CREATE TABLE sqlitestudio_temp_table AS SELECT *
                                          FROM tb_ordem_servico_aceite;

DROP TABLE tb_ordem_servico_aceite;

CREATE TABLE tb_ordem_servico_aceite (
    id_ordem_servico     INTEGER  REFERENCES tb_ordem_servico (id_ordem_servico)
                                  NOT NULL,
    id_usuario_gestao    INTEGER  REFERENCES tb_usuario (id_usuario)
                                  NOT NULL,
    in_gestao            INTEGER  CHECK (in_gestao > 0 AND
                                         in_gestao < 5),
    in_situacao          INTEGER  NOT NULL,
    id_usuario_alteracao INTEGER  REFERENCES tb_usuario (id_usuario)
                                  NOT NULL,
    dt_alteracao         DATETIME NOT NULL
                                  DEFAULT (CURRENT_TIMESTAMP)
);

INSERT INTO tb_ordem_servico_aceite (
                                        id_ordem_servico,
                                        id_usuario_gestao,
                                        in_gestao,
                                        id_usuario_alteracao,
                                        dt_alteracao
                                    )
                                    SELECT id_ordem_servico,
                                           id_usuario_gestao,
                                           in_gestao,
                                           id_usuario_alteracao,
                                           dt_alteracao
                                      FROM sqlitestudio_temp_table;

DROP TABLE sqlitestudio_temp_table;

CREATE UNIQUE INDEX uk_ordem_servico_getao ON tb_ordem_servico_aceite (
    id_ordem_servico,
    in_gestao
);

PRAGMA foreign_keys = 1;


DROP INDEX uk_ordem_servico_getao;

CREATE UNIQUE INDEX uk_ordem_servico_getao ON tb_ordem_servico_aceite (
    id_ordem_servico,
    in_gestao,
    in_situacao
);
