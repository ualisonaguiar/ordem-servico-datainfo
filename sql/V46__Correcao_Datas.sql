update tb_demanda set dt_abertura = strftime('%Y-%m-%d', dt_alteracao) where id_demanda in (2314, 2312, 2313);