<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractService;
use InepZend\Service\ServiceAngularTrait;
use InepZend\Util\Date;
use OrdemServico\Entity\Usuario as UsuarioEntity;
use Zend\Form\Element\DateTime;

class ArquivoPontoUsuarioFile extends AbstractService
{
    use ServiceAngularTrait;

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = ['id_arquivo_ponto_usuario'];
    }

    protected function getListagem($arrCriteria)
    {
        return $this->getRepositoryEntity()->getListagem($arrCriteria);
    }

    protected function getMigracaoFileBanco()
    {
        try {
            $this->begin();
            $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->fetchPairs([
                'tp_vinculo' => [UsuarioEntity::CO_PERFIL_FUNCIONARIO, UsuarioEntity::CO_PERFIL_PREPOSTO]
            ], 'getIdUsuario', 'getNuPis');
            $arrUsuario = array_flip(array_map(function ($strValue) {
                return str_pad($strValue, 12, '0', STR_PAD_LEFT);
            }, $arrUsuario));
            $serviceArquivoPonto = $this->getService('OrdemServico\Service\ArquivoPontoFile');
            $arrLinhaArquivo = $serviceArquivoPonto->getRegistroPontoNaoVinculado();
            self::setFlush(false);
            foreach ($arrLinhaArquivo as $int => $linhaArquivo) {
                $arrInformacao = $this->getInformacaoLinhaPonto($linhaArquivo->getDsLinha());
                if (array_key_exists($arrInformacao['nu_pis'], $arrUsuario)) {
                    $this->save([
                        'id_arquivo_ponto' => $linhaArquivo->getIdArquivoPonto(),
                        'id_usuario' => $arrUsuario[$arrInformacao['nu_pis']],
                        'dt_ponto' => $arrInformacao['dt_ponto'],
                        'hr_ponto' => $arrInformacao['hr_ponto'],
                    ]);
                }
            }
            self::setFlush(true);
            $serviceArquivoPonto->updateBy(['tp_migracao' => 2], ['tp_migracao' => 1]);
            $this->commit();
        } catch (\Exception $exception) {
            $this->rollback();
            throw new \Exception($exception->getMessage());
        }
    }

    protected function getInformacaoLinhaPonto($strValorLinha)
    {
        if (strlen($strValorLinha) > 39) {
            return [];
        }
        $strValorLinha = trim(substr($strValorLinha, 10));
        $strDataLinha = substr($strValorLinha, 0, 8);
        $strNuPis = substr($strValorLinha, 12, 12);
        $strData = $strDataLinha{0} . $strDataLinha{1} . '-' . $strDataLinha{2} . $strDataLinha{3} . '-' . substr($strDataLinha, 4);

        if (!Date::isDate($strData)) {
            return [];
        }

        $date = new \DateTime($strData);
        $strHora = substr(str_replace($strNuPis, '', $strValorLinha), 8);
        $strHora = substr($strHora, 0, 2) . ':' . substr($strHora, 2);
        $strHora = substr($strHora, 0, 5);
        return [
            'dt_ponto' => $date->format('Y-m-d'),
            'hr_ponto' => $strHora,
            'nu_pis' => $strNuPis
        ];
    }

}
