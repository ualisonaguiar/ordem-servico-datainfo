CREATE TABLE tb_log_lancamento (
    id_log_lancamento             INTEGER       PRIMARY KEY AUTOINCREMENT
                                                NOT NULL,
    id_demanda                    INTEGER       REFERENCES tb_demanda (id_demanda)
                                                NOT NULL,
    id_catalogo_servico_atividade INTEGER       REFERENCES tb_demanda_servico (id_catalogo_servico_atividade)
                                                NOT NULL,
    id_usuario                    INTEGER       REFERENCES tb_usuario (id_usuario)
                                                NOT NULL,
    dt_ponto                      DATE          NOT NULL,
    hr_inicio                     TIME          NOT NULL,
    hr_fim                        TIME          NOT NULL
);

PRAGMA foreign_keys = 0;

CREATE TABLE sqlitestudio_temp_table AS SELECT *
                                          FROM tb_log_lancamento;

DROP TABLE tb_log_lancamento;

CREATE TABLE tb_log_lancamento (
    id_log_lancamento             INTEGER PRIMARY KEY AUTOINCREMENT
                                          NOT NULL,
    id_demanda                    INTEGER REFERENCES tb_demanda (id_demanda)
                                          NOT NULL,
    id_catalogo_servico_atividade INTEGER REFERENCES tb_demanda_servico (id_catalogo_servico_atividade)
                                          NOT NULL,
    id_usuario                    INTEGER REFERENCES tb_usuario (id_usuario)
                                          NOT NULL,
    dt_ponto                      DATE    NOT NULL,
    hr_inicio                     TIME    NOT NULL,
    hr_fim                        TIME    NOT NULL,
    tp_operacao                   INTEGER NOT NULL
);

INSERT INTO tb_log_lancamento (
                                  id_log_lancamento,
                                  id_demanda,
                                  id_catalogo_servico_atividade,
                                  id_usuario,
                                  dt_ponto,
                                  hr_inicio,
                                  hr_fim
                              )
                              SELECT id_log_lancamento,
                                     id_demanda,
                                     id_catalogo_servico_atividade,
                                     id_usuario,
                                     dt_ponto,
                                     hr_inicio,
                                     hr_fim
                                FROM sqlitestudio_temp_table;

DROP TABLE sqlitestudio_temp_table;

PRAGMA foreign_keys = 1;

CREATE INDEX idx_log_lancamento_01 ON tb_log_lancamento (
    id_usuario ASC,
    dt_ponto ASC
);
