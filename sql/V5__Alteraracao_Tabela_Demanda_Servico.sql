alter table tb_demanda add COLUMN id_usuario_alteracao integer references tb_usuario(id_usuario);
alter table tb_demanda add COLUMN dt_alteracao integer;

alter table tb_demanda_servico add COLUMN id_usuario_alteracao integer references tb_usuario(id_usuario);
alter table tb_demanda_servico add COLUMN dt_alteracao integer;

alter table tb_ordem_servico add COLUMN id_usuario_alteracao integer references tb_usuario(id_usuario);
alter table tb_ordem_servico add COLUMN dt_alteracao integer;