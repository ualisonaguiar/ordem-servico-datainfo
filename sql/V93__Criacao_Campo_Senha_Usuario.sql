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
    ds_hash_apex VARCHAR (500),
    ds_senha     VARCHAR (32) 
);

INSERT INTO tb_usuario (
                           id_usuario,
                           no_usuario,
                           nu_pis,
                           ds_email,
                           ds_login,
                           tp_vinculo,
                           in_ativo,
                           ds_hash_apex
                       )
                       SELECT id_usuario,
                              no_usuario,
                              nu_pis,
                              ds_email,
                              ds_login,
                              tp_vinculo,
                              in_ativo,
                              ds_hash_apex
                         FROM sqlitestudio_temp_table;

DROP TABLE sqlitestudio_temp_table;

PRAGMA foreign_keys = 1;
