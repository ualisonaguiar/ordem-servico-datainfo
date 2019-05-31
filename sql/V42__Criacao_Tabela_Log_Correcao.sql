CREATE TABLE tb_log_verificacao_dados (
    id_log_verificacao_dados INTEGER  PRIMARY KEY AUTOINCREMENT
                                      NOT NULL,
    dt_incio                 DATETIME NOT NULL,
    dt_fim                   DATETIME,
    nu_quantidade_demandas   INTEGER  NOT NULL
);
