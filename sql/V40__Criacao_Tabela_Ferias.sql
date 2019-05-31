CREATE TABLE tb_ferias (
    id_ferias            INTEGER  PRIMARY KEY AUTOINCREMENT
                                  NOT NULL,
    id_usuario           INTEGER  REFERENCES tb_usuario (id_usuario)
                                  NOT NULL,
    dt_inicio            DATE     NOT NULL,
    dt_fim               DATE     NOT NULL,
    id_usuario_alteracao INTEGER  REFERENCES tb_usuario (id_usuario)
                                  NOT NULL,
    dt_alteracao         DATETIME NOT NULL
);

CREATE UNIQUE INDEX uk_usuario_periodicidade ON tb_ferias (
    id_usuario,
    dt_inicio,
    dt_fim
);
