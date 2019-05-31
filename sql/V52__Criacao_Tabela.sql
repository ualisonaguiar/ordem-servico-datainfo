CREATE TABLE tb_arquivo_ponto_usuario (
    id_arquivo_ponto_usuario INTEGER PRIMARY KEY AUTOINCREMENT
                                     NOT NULL,
    id_arquivo_ponto         INTEGER REFERENCES tb_arquivo_ponto (id_arquivo_ponto)
                                     NOT NULL,
    id_usuario               INTEGER REFERENCES tb_usuario (id_usuario)
                                     NOT NULL,
    dt_ponto                 DATE    NOT NULL,
    hr_ponto                 TIME    NOT NULL
);

