drop table tb_aceite_ordem_servico;
drop table tb_aceite_gestao;
drop table tb_aceite;

CREATE TABLE tb_ordem_servico_aceite (
    id_ordem_servico     INTEGER  REFERENCES tb_ordem_servico (id_ordem_servico)
                                  NOT NULL,
    id_usuario_gestao    INTEGER  REFERENCES tb_usuario (id_usuario)
                                  NOT NULL,
    in_gestao            INTEGER  CHECK (in_gestao > 0 AND
                                         in_gestao < 5),
    id_usuario_alteracao INTEGER  REFERENCES tb_usuario (id_usuario)
                                  NOT NULL,
    dt_alteracao         DATETIME NOT NULL
                                  DEFAULT (CURRENT_TIMESTAMP)
);

CREATE UNIQUE INDEX uk_ordem_servico_getao ON tb_ordem_servico_aceite (
    id_ordem_servico,
    in_gestao
);
