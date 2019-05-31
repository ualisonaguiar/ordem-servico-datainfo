delete from tb_ordem_servico_demanda where id_demanda = 440;
delete from tb_demanda_servico where id_demanda = 440;
delete from tb_demanda where id_demanda = 440;

delete from tb_ordem_servico_demanda where id_demanda in (658, 659, 661);
delete from tb_demanda_servico where id_demanda in (658, 659, 661);
delete from tb_demanda where id_demanda in (658, 659, 661);

delete from tb_ordem_servico_demanda where id_demanda in (806, 810);
delete from tb_demanda_servico where id_demanda in (806, 810);
delete from tb_demanda where id_demanda in (806, 810);

delete from tb_ordem_servico_demanda where id_demanda in (811);
delete from tb_demanda_servico where id_demanda in (811);
delete from tb_demanda where id_demanda in (811);

delete from tb_ordem_servico_demanda where id_demanda in (1340);
delete from tb_demanda_servico where id_demanda in (1340);
delete from tb_demanda where id_demanda in (1340);

delete from tb_ordem_servico_demanda where id_demanda in (1223);
delete from tb_demanda_servico where id_demanda in (1223);
delete from tb_demanda where id_demanda in (1223);

delete from tb_ordem_servico_demanda where id_demanda in (1552);
delete from tb_demanda_servico where id_demanda in (1552);
delete from tb_demanda where id_demanda in (1552);

delete from tb_ordem_servico_demanda where id_demanda in (1563, 1564, 1565, 1566, 1567, 1568, 1569);
delete from tb_demanda_servico where id_demanda in (1563, 1564, 1565, 1566, 1567, 1568, 1569);
delete from tb_demanda where id_demanda in (1563, 1564, 1565, 1566, 1567, 1568, 1569);

CREATE UNIQUE INDEX uk_demanda_validar_ ON tb_demanda (
    dt_abertura,
    no_demanda,
    ds_descricao,
    ds_ambiente,
    ds_solucao,
    no_executor
);
