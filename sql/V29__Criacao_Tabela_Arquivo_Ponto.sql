CREATE TABLE tb_arquivo_ponto (
    id_arquivo_ponto     INTEGER       PRIMARY KEY AUTOINCREMENT
                                       NOT NULL,
    in_linha             INTEGER       NOT NULL,
    ds_linha             VARCHAR (600) NOT NULL,
    id_usuario_alteracao INTEGER       REFERENCES tb_usuario (id_usuario) 
                                       NOT NULL,
    dt_alteracao         DATETIME      NOT NULL
);
