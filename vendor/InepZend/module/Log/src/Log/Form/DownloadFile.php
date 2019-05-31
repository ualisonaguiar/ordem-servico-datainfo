<?php

namespace InepZend\Module\Log\Form;

use InepZend\FormGenerator\FormGenerator;

/**
 * Formulario responsavel pela selecao dos arquivos para download
 */
class DownloadFile extends FormGenerator
{

    public function __construct($strName = null)
    {
        parent::__construct((empty($strName) ? $this->generateFormName(__CLASS__) : $strName));
        $this->setAttributes(
                array(
                    'id' => 'formDownload',
                    'action' => $this->getBaseUrl() . '/log/download-file',
                    'target' => '_blank'
                )
        );
    }

    /**
     * Metodo responsavel por adicionar os elementos ao formulario
     */
    public function prepareElementsFilter()
    {
        $this->addHtml('<table id="listFileDownload" class="table table-bordered table-borderless hide">', 'table');
        $this->addHtml('
                <thead>
                    <tr>
                        <th>Arquivo</th>
                        <th>Criação</th>
                        <th>Level</th>
                        <th style="width: 5%">Ação</th>
                    </tr>
                </thead>
            ', 'thead'
        );
        $this->addHtml('<tbody></tbody>', 'tbody');
        $this->addHtml('</table>', 'fimTable');
        $this->addHtml('<div class="pull-right">', 'divRight');
        $this->addButton(
                array(
                    'name' => 'btnDownload',
                    'title' => 'Download',
                    'class' => 'btnDefault btnDownload btn-inep hide'
                )
        );
        $this->addHtml('</div>', 'fimDivRight');
    }

}
