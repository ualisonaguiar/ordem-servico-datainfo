PRAGMA foreign_keys = 0;

CREATE TABLE sqlitestudio_temp_table AS SELECT *
                                          FROM tb_arquivo_ponto;

DROP TABLE tb_arquivo_ponto;

CREATE TABLE tb_arquivo_ponto (
    id_arquivo_ponto     INTEGER       PRIMARY KEY AUTOINCREMENT
                                       NOT NULL,
    in_linha             INTEGER       NOT NULL,
    ds_linha             VARCHAR (600) NOT NULL,
    id_usuario_alteracao INTEGER       REFERENCES tb_usuario (id_usuario) 
                                       NOT NULL,
    dt_alteracao         DATETIME      NOT NULL,
    tp_migracao          INTEGER
);

INSERT INTO tb_arquivo_ponto (
                                 id_arquivo_ponto,
                                 in_linha,
                                 ds_linha,
                                 id_usuario_alteracao,
                                 dt_alteracao
                             )
                             SELECT id_arquivo_ponto,
                                    in_linha,
                                    ds_linha,
                                    id_usuario_alteracao,
                                    dt_alteracao
                               FROM sqlitestudio_temp_table;

DROP TABLE sqlitestudio_temp_table;

PRAGMA foreign_keys = 1;