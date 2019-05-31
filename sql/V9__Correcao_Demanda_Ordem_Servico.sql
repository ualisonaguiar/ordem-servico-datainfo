update tb_ordem_servico set
    no_fiscal_tecnico = 'Carlos Roberto Porfírio',
    no_fiscal_requisitante = 'Carlos Roberto Porfírio',
    no_gestor_contrato = 'Camilo Mussi',
    no_preposto = 'Paulo Eduardo Costa Oliveira',
    dt_recepcao = '2016-10-14 08:00:00',
    dt_emissao = '2016-10-14 08:00:00',
    dt_prazo = '2016-10-31 18:00:00'
where
    nu_ordem_servico in (758, 764, 770, 771, 775, 777, 778, 780);

update tb_ordem_servico set tp_situacao = 1 where nu_ordem_servico = 771;