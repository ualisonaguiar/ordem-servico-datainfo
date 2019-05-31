/* global angular, OrdemServicoService, DemandaService */

var strController = 'DemandaFormController';
angular.module(strController, ['CalculaMathController', 'AbstractGridController'])
    .service('OrdemServicoDemandaService', ['RestClient', 'AsyncMessage', OrdemServicoDemandaService])
    .service('DemandaService', ['RestClient', 'AsyncMessage', DemandaService])
    .controller(strController, [
        '$scope', '$controller', 'DemandaService', '$location', 'AsyncMessage', 'OrdemServicoDemandaService',
        function ($scope, $controller, DemandaService, $location, AsyncMessage, OrdemServicoDemandaService) {
            $scope.service = DemandaService;
            $scope.booChecked = false;
            $scope.booExibeOrdemServicoAberto = true;

            $scope.getDateCurrent = function () {
                var dateCurrent = new Date(),
                    strDateNow = dateCurrent.toLocaleString(),
                    arrDateNow = strDateNow.split(' ');
                return arrDateNow[0];
            };
            angular.extend($scope, $controller('CalculaMathController', {$scope: $scope}));
            angular.extend($scope, $controller('AbstractGridController', {$scope: $scope}));

            $scope.getAtividadeServicoAssessoria = function (intIdDemanda) {
                $scope.service.getAtividadesVinculadaAssessoria(function (mixResult) {
                    $scope.id_catalogo_servico = mixResult.result;
                    if (intIdDemanda === undefined) {
                        var divAtividadeVinculada = document.getElementById('atividadeVinculada');
                        if (divAtividadeVinculada.firstChild !== null) {
                            divAtividadeVinculada.removeChild(divAtividadeVinculada.firstChild)
                        }
                    }
                }, $scope.data.no_area_assessoria);
            };

            $scope.getValoresAtividadeServico = function () {
                $scope.data.catalogo_servico_vinculo = [];
                $('#atividadeVinculada table tbody tr').each(function (intPosicao, linhaAtividade) {
                    intPosicao += 1;
                    if (
                        $('#atividadeVinculada tbody tr:nth-child(' + intPosicao + ') input[type="text"]').eq(0).val() !== "" &&
                        $('#atividadeVinculada tbody tr:nth-child(' + intPosicao + ') input[id="vl_qma"]').eq(1).val() !== ""
                    ) {
                        var strVlComplexidade = $('#atividadeVinculada tbody tr:nth-child(' + intPosicao + ') select[name*="vl_complexidade"]').val(),
                            strVlImpacto = $('#atividadeVinculada tbody tr:nth-child(' + intPosicao + ') select[name*="vl_impacto"]').val(),
                            strVlCriticidade = $('#atividadeVinculada tbody tr:nth-child(' + intPosicao + ') select[name*="vl_criticidade"]').val(),
                            strVlFatorPonderacao = $('#atividadeVinculada tbody tr:nth-child(' + intPosicao + ') input[type="text"]').eq(0).val(),
                            strVlFacim = $('#atividadeVinculada tbody tr:nth-child(' + intPosicao + ') select[name*="vl_facim"]').val(),
                            strVlQma = $('#atividadeVinculada tbody tr:nth-child(' + intPosicao + ') input[type="text"]').eq(1).val();
                        $scope.data.catalogo_servico_vinculo.push({
                            id_catalogo_servico_atividade: linhaAtividade.getAttribute("data-catalogo-servico-atividade"),
                            vl_complexidade: strVlComplexidade,
                            vl_impacto: strVlImpacto,
                            vl_criticidade: strVlCriticidade,
                            vl_fator_ponderacao: strVlFatorPonderacao,
                            vl_facim: strVlFacim,
                            vl_qma: strVlQma,
                        });
                    }
                });
            };

            $scope.vincularServico = function (intIdDemanda, intIdCatalogoServico) {
                $scope.data.catalogo_servico_vinculo = [];
                if ($scope.data.id_catalogo_servico !== '') {
                    var arrParam = new Array(),
                        mixResult;
                    if (intIdCatalogoServico === undefined)
                        arrParam['id_catalogo_servico'] = $scope.data.id_catalogo_servico;
                    else
                        arrParam['id_catalogo_servico'] = intIdCatalogoServico;
                    if (intIdDemanda !== undefined)
                        arrParam['id_demanda'] = intIdDemanda;
                    arrParam['tipo'] = 'servico';
                    mixResult = ajaxRequest('/demanda/atividade-vinculada-servico', arrParam);
                    $('#atividadeVinculada').html(mixResult);
                    $('form:last').validate().cancelSubmit = true;
                }
            };

            $scope.vincularAtividadesDemandasAntiga = function (intIdDemanda) {
                var arrParam = new Array(),
                    mixResult;
                arrParam['id_demanda'] = intIdDemanda;
                arrParam['tipo'] = 'atividade';
                mixResult = ajaxRequest('/demanda/atividade-vinculada-servico', arrParam);
                $('#atividadeVinculada').html(mixResult);
                $('form:last').validate().cancelSubmit = true;
            };

            $scope.getInformacaoAlteracaoDemanda = function (intIdDemanda) {
                $scope.service.getInformacaoAlteracaoDemanda(function (mixResult) {
                    if (mixResult.result.length !== 0) {
                        $scope.exibeDataAlteracao = true;
                        $scope.data_alteracao = mixResult.result.dt_alteracao;
                        $scope.no_usuario = mixResult.result.no_usuario;
                    }
                }, intIdDemanda);
            };

            $scope.save = function () {
                if (!$('form', document.getElementById('frm')).valid()) {
                    AsyncMessage.addError('Favor preencher todos os campos obrigatórios.');
                    return false;
                }
                $scope.getValoresAtividadeServico();
                return $scope.service.save(function () {
                    AsyncMessage.addSuccess('Operação realizada com sucesso!');
                    var strUrl = $location.absUrl();
                    var arrUrl = explode('/edit/', strUrl);
                    if (arrUrl.length <= 1) {
                        arrUrl = explode('/add', strUrl);
                        if (arrUrl.length <= 1)
                            return;
                    }
                    $scope.locationHref(arrUrl[0]);
                }, $scope.data);
            };

            $scope.init = function () {
                $scope.booExibeOrdemServicoAberto = true;
                var strUrl = $location.absUrl();
                var arrUrl = explode('/edit/', strUrl);
                if (arrUrl.length <= 1) {
                    return true;
                }
                var intIdDemanda = arrUrl[1].substr(5);
                $scope.getInformacaoAlteracaoDemanda(intIdDemanda);

                $scope.service.getValorServicoAcessoria(function (mixResult) {
                    $scope.data.no_area_assessoria = mixResult.result.assessinatura;
                    $scope.getAtividadeServicoAssessoria(intIdDemanda);
                    $scope.data.id_catalogo_servico = mixResult.result.id_catalogo_servico;
                    $('#atividadeVinculada select').removeAttr('disabled');
                    if (mixResult.result.tipo_servico === 'Servico')
                        $scope.vincularServico(intIdDemanda);
                    else
                        $scope.vincularAtividadesDemandasAntiga(intIdDemanda);
                    $scope.getValorFatorPonderacao();
                }, intIdDemanda);

                $scope.service.hasEditDemanda(function (mixResult) {
                    $scope.booChecked = mixResult.result;
                    if ($scope.booChecked === true) {
                        $scope.booExibeOrdemServicoAberto = false;
                        $scope.booExibeOrdemServicoFechado = true;
                    } else {
                        $scope.booExibeOrdemServicoAberto = true;
                        $scope.booExibeOrdemServicoFechado = false;
                    }
                }, intIdDemanda);

                OrdemServicoDemandaService.findBy(function (mixResult) {
                    var resultDemandaVinculo = mixResult.result[0];
                    if (resultDemandaVinculo !== undefined) {
                        var intIdOrdemServico = resultDemandaVinculo.id_ordem_servico;
                        $scope.data.id_ordem_servico = intIdOrdemServico.toString();
                        $scope.data.id_ordem_servico_encerrada = intIdOrdemServico.toString();
                    }
                }, {id_demanda: intIdDemanda});
            };

            openWaitDialog();
            setTimeout(function(){
                $scope.init();
                closeWaitDialog();
            }, 4000);

            $scope.data.dt_abertura = convertDate($scope.getDateCurrent());
            $scope.data.in_situacao = '1';

            $('body').on('click', '.excluir-atividade', function () {
                $(this).closest('tr').remove();
                if ($('#atividadeVinculada tbody tr').length === 0) {
                    $('#id_catalogo_servico option:contains("Selecione")').attr('selected', true).trigger('change');
                }
            });
        }]);
try {
    angular.bootstrap($('.' + strController), [strController]);
} catch (exception) {

}