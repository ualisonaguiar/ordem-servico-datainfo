update tb_ordem_servico set
    no_fiscal_tecnico = 'Carlos Roberto Porfírio',
    no_fiscal_requisitante = 'Carlos Roberto Porfírio',
    no_gestor_contrato = 'Camilo Mussi',
    no_preposto = 'Paulo Eduardo Costa Oliveira',
    dt_recepcao = '2016-10-17 08:00:00',
    dt_emissao = '2016-10-17 08:00:00',
    dt_prazo = '2016-10-18 18:00:00',
    tp_situacao = 2,
    id_usuario_alteracao = 13,
    dt_alteracao = '2016-10-18 18:00:00'
where
    nu_ordem_servico in (782, 783, 784, 786, 787, 788, 789, 790, 791, 792, 793, 799, 800, 802, 804, 805, 806, 808, 809, 810, 811, 815, 818, 820, 822, 823, 824, 825, 826, 827, 832, 833, 834, 835, 836, 840);