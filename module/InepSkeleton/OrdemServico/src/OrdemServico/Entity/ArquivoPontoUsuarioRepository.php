<?php

namespace OrdemServico\Entity;

use InepZend\Repository\Repository;

class ArquivoPontoUsuarioRepository extends Repository
{
    protected function getListagem($arrCriteria)
    {
        try {
            $strSQL = '
                select * from (
                    select
                        dt_ponto,
                        hr_ponto
                    from
                        tb_arquivo_ponto_usuario pu
                    where
                        pu.id_usuario = :idUsuario
                        and pu.dt_ponto BETWEEN :dtInicio and :dtFim

                    union
                    select
                        dt_justificativa dt_ponto,
                        hr_justificada  hr_ponto
                    from
                        tb_justificava_ponto
                    where
                        id_usuario = :idUsuario
                        and dt_justificativa BETWEEN :dtInicio and :dtFim
                ) order by 1, 2';
            return $this->executeSQL($strSQL, $arrCriteria, true);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
