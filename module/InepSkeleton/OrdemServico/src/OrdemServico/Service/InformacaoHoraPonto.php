<?php

namespace OrdemServico\Service;


use InepZend\Util\Date;

trait InformacaoHoraPonto
{

    /**
     * Metodo responsavel por calcular a hora de trabalho.
     *
     * @param $arrInformationPonto
     * @return mixed
     */
    protected function calculaIntervaloHoraPonto($arrInformationPonto)
    {
        foreach ($arrInformationPonto as $strDate => $arrHora) {
            $arrHora = $arrHora['horario'];
            $arrSoma = array();
            $strHora = null;
            for ($intPosicao = 0; $intPosicao < count($arrHora); $intPosicao++) {
                if ($intPosicao == 1 || $intPosicao == 3 || $intPosicao == 5) {
                    $inicio = \DateTime::createFromFormat('H:i:s', $arrHora[$intPosicao - 1] . ':00');
                    $fim = \DateTime::createFromFormat('H:i:s', $arrHora[$intPosicao] . ':00');
                    $intervalo = $inicio->diff($fim);
                    $arrSoma[] = $intervalo->format('%H:%I:%S');
                }
            }
            if (count($arrSoma) > 1) {
                $inicio = \DateTime::createFromFormat('H:i:s', $arrSoma[0]);
                $fim = \DateTime::createFromFormat('H:i:s', $arrSoma[1]);
                if (array_key_exists(2, $arrSoma)) {
                    $ultimoHorario = \DateTime::createFromFormat('H:i:s', $arrSoma[2]);
                    $intCalculo = mktime(
                        $inicio->format('H') + $fim->format('H') + $ultimoHorario->format('H'),
                        $inicio->format('i') + $fim->format('i') + $ultimoHorario->format('i')
                    );
                } else {
                    $intCalculo = mktime(
                        $inicio->format('H') + $fim->format('H'),
                        $inicio->format('i') + $fim->format('i')
                    );
                }
                $strHora = date('H:i', $intCalculo);
            } elseif ($arrSoma[0]) {
                $strHora = date('H:i', strtotime(end($arrSoma)));
            }
            $arrInformationPonto[$strDate]['soma'] = $strHora;
            $horaTotal = \DateTime::createFromFormat('H:i:s', $strHora . ':00');
            $horaCarga = \DateTime::createFromFormat('H:i:s', '08:30:00');
            $strSinal = '';
            $arrInformationPonto[$strDate]['total'] = '';
            if ($strHora) {
                if (strtotime($strHora) >= strtotime('08:30')) {
                    $intCalculo = mktime(
                        $horaTotal->format('H') - $horaCarga->format('H'),
                        $horaTotal->format('i') - $horaCarga->format('i')
                    );
                    $strSinal = '+';
                } else {
                    $intCalculo = mktime(
                        $horaCarga->format('H') - $horaTotal->format('H'),
                        $horaCarga->format('i') - $horaTotal->format('i')
                    );
                    $strSinal = '-';
                }
                $arrInformationPonto[$strDate]['total'] = $strSinal . ''. date('H:i', $intCalculo);
            }            
        }
        return $arrInformationPonto;
    }

    protected function getRangeDates($strDataInicial, $strDataFinal)
    {
        $arrDateRange = array();
        $interval = new \DateInterval('P1D');
        $realEnd = new \DateTime($strDataFinal);
        $realEnd->add($interval);
        $period = new \DatePeriod(new \DateTime($strDataInicial), $interval, $realEnd);
        foreach ($period as $date)
            $arrDateRange[] = $date->format('Y-m-d');
        return $arrDateRange;
    }
}
