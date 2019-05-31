PRAGMA foreign_keys = 0;

CREATE TABLE sqlitestudio_temp_table AS SELECT *
                                          FROM tb_ordem_servico_demanda;

DROP TABLE tb_ordem_servico_demanda;

CREATE TABLE tb_ordem_servico_demanda (
    id_ordem_servico_demanda INTEGER  PRIMARY KEY AUTOINCREMENT
                                      NOT NULL,
    id_ordem_servico         INTEGER  REFERENCES tb_ordem_servico (id_ordem_servico) 
                                      NOT NULL,
    id_demanda               INTEGER  REFERENCES tb_demanda (id_demanda),
    id_usuario_alteracao     DOUBLE   REFERENCES tb_usuario (id_usuario),
    dt_alteracao             DATETIME
);

INSERT INTO tb_ordem_servico_demanda (
                                         id_ordem_servico_demanda,
                                         id_ordem_servico,
                                         id_demanda
                                     )
                                     SELECT id_ordem_servico_demanda,
                                            id_ordem_servico,
                                            id_demanda
                                       FROM sqlitestudio_temp_table;

DROP TABLE sqlitestudio_temp_table;

PRAGMA foreign_keys = 1;
