/* global angular */

var strController = 'CalculaMathController';
angular.module(strController, ['AbstractCoreController'])
    .service('DemandaService', ['RestClient', DemandaService])
    .controller(strController, [
        '$scope', '$controller', 'RestClient', 'DemandaService',
        function ($scope, $controller, RestClient, DemandaService) {

        $scope.getValorFatorPonderacao = function () {
            var callback = function (mixResult) {
                $scope.fator_ponderacao = mixResult.result;
            };
            DemandaService.getValorFatorPonderacao(callback);
        };

        $(document).ready(function () {
            function limparValorFator(fieldAtividade, fieldFacim) {
                fieldAtividade.closest('tr').find('input:text').eq(0).val('');
                fieldAtividade.closest('tr').find('input:text').eq(1).val('');
                fieldAtividade.closest('tr').find('input:text').eq(0).attr('disabled', true);
                fieldAtividade.closest('tr').find('input:text').eq(1).attr('disabled', true);
                fieldFacim.attr('disabled', true);
                fieldFacim.val('');
            }

            $('body').on('change', '.vl_complexidade, .vl_impacto, .vl_criticidade, .list_atividade', function () {
                if ($scope.fator_ponderacao === undefined) {
                    $scope.getValorFatorPonderacao();
                }
                var strComplexidade = $(this).closest('tr').find('select[name*="vl_complexidade"]').val(),
                    strImpacto = $(this).closest('tr').find('select[name*="vl_impacto"]').val(),
                    strCriticidade = $(this).closest('tr').find('select[name*="vl_criticidade"]').val(),
                    strVlrGrau = strComplexidade + strImpacto + strCriticidade,
                    fieldFacim = $(this).closest('tr').find('select[name*="vl_facim"]'),
                    fieldFator = $(this).closest('tr').find('select[name*="vl_fator_ponderacao"]');

                if ($(this).hasClass('list_atividade')) {
                    $(this).closest('tr').find('select[name*="vl_complexidade"]').val('');
                    $(this).closest('tr').find('select[name*="vl_impacto"]').val('');
                    $(this).closest('tr').find('select[name*="vl_criticidade"]').val('');
                    limparValorFator($(this), fieldFacim);
                    return false;
                }
                if (strVlrGrau.length === 3) {
                    $(this).closest('tr').find('input:text').eq(0).val($scope.fator_ponderacao[strVlrGrau]);
                    fieldFacim.attr('disabled', false);
                    fieldFator.attr('disabled', false);
                    fieldFacim.trigger('change');
                } else {
                    limparValorFator($(this), fieldFacim);
                }
            }).on('change', '.vl_facim', function () {
                var fieldFacim = $(this).closest('tr').find('select[name*="vl_facim"]'),
                    strFieldComplexidade = $(this).closest('tr').find('select[name*="vl_complexidade"]').val(),
                    strFieldImpacto = $(this).closest('tr').find('select[name*="vl_impacto"]').val(),
                    strFieldCriticidade = $(this).closest('tr').find('select[name*="vl_criticidade"]').val();

                if (fieldFacim.val() !== '' && strFieldComplexidade !== '' && strFieldImpacto !== '' && strFieldCriticidade !== '') {
                    var fieldQma = $(this).closest('tr').find('input:text').eq(1);
                    var intIdDemanda = $('input:hidden[name="id_demanda"]:last').val();

                    var callback = function (mixResult) {
                        fieldQma.val(mixResult.result);
                    };
                    if ($(this).closest('tr').find('select[name*="id_atividade"]').length !== 0) {
                        intIdAtividade = $(this).closest('tr').find('select[name*="id_atividade"]').val();
                    } else {
                        intIdAtividade = $(this).closest('tr').find('input:hidden[name*="id_atividade"]').val();
                    }
                    RestClient.runService(
                        'OrdemServico\\Service\\DemandaFile',
                        'calcularValorMathAction',
                        [{
                            id_atividade: intIdAtividade,
                            vl_fator_ponderacao: $(this).closest('tr').find('input:text').eq(0).val(),
                            vl_facim: fieldFacim.val()
                        }],
                        'WS_RSRC_SERVICE_DEMANDA_VALOR_MATH',
                        callback
                    );
                } else {
                    $(this).closest('tr').find('input:text').eq(1).val('');
                }
            });
        });

        angular.extend($scope, $controller('AbstractCoreController', {$scope: $scope}));

    }]);
