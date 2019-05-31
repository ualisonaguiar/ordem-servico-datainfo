PRAGMA foreign_keys = 0;

CREATE TABLE sqlitestudio_temp_table AS SELECT *
                                          FROM tb_log_verificacao_dados;

DROP TABLE tb_log_verificacao_dados;

CREATE TABLE tb_log_verificacao_dados (
    id_log_verificacao_dados INTEGER  PRIMARY KEY AUTOINCREMENT
                                      NOT NULL,
    dt_incio                 DATETIME NOT NULL,
    dt_fim                   DATETIME,
    nu_quantidade_demandas   INTEGER  NOT NULL,
    ds_demanda_corrigidas    TEXT
);

INSERT INTO tb_log_verificacao_dados (
                                         id_log_verificacao_dados,
                                         dt_incio,
                                         dt_fim,
                                         nu_quantidade_demandas
                                     )
                                     SELECT id_log_verificacao_dados,
                                            dt_incio,
                                            dt_fim,
                                            nu_quantidade_demandas
                                       FROM sqlitestudio_temp_table;

DROP TABLE sqlitestudio_temp_table;

PRAGMA foreign_keys = 1;
