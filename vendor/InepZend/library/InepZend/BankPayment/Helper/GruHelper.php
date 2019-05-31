<?php

namespace InepZend\BankPayment\Helper;

use InepZend\BankPayment\Helper\AbstractHelper;
use InepZend\View\Helper\BarcodeHelper;
use InepZend\Util\Format;
use InepZend\Util\Date;
use InepZend\Util\ArrayCollection;

/**
 * @package InepZend
 * @subpackage BankPayment
 */
class GruHelper extends AbstractHelper
{

    public function render($arrParam = null)
    {
        if (empty($arrParam))
            $arrParam = $this->arrParam;
        $arrParamDefaultValue = array(
            'coRecolhimento' => '',
            'nuReferencia' => Format::clearCpfCnpj(@$arrParam['nuCpfCnpj']),
            'dsCompetencia' => '',
            'dtVencimento' => date('d/m/Y'),
            'noContribuinte' => '',
            'nuCpfCnpj' => '',
            'noUnidade' => 'INST. NACIONAL DE EST. E PESQUISAS EDUCACIONAIS',
            'ugGestao' => '',
            'vlPrincipal' => '0,00',
            'vlDesconto' => '0,00',
            'vlDeducao' => '0,00',
            'vlMulta' => '0,00',
            'vlJuros' => '0,00',
            'vlAcrescimo' => '0,00',
            'nuCodigoBarra' => '',
        );
        ArrayCollection::setDefaultParam($arrParam, $arrParamDefaultValue);
        $arrParam['vlTotal'] = (float) @$arrParam['vlPrincipal'] - (float) @$arrParam['vlDesconto'] - (float) @$arrParam['vlDeducao'] + (float) @$arrParam['vlMulta'] + (float) @$arrParam['vlJuros'] + (float) @$arrParam['vlAcrescimo'];
        $strResult = '<style type="text/css">
        table tbody tr td {
            border: 1px solid #000000;
            font: "Open Sans", Helvetica, Arial, sans-serif;
            font-size: 12px;
            padding: 2px 5px 2px 10px;
        }
        .right {
            text-align: right;
        }
    </style>';
        $strGru = '<div>
    <table>
        <tbody>
        <tr>
            <td rowspan="4" align="center">
                <table>
                    <tr>
                        <td style="border: 0px">
                            <img
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAD4AAAA+CAIAAAD8oz8TAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAABreSURBVGhD7ZoJOJTr28BfJftSCKW0qKSEGTNjza4SScpaRNn3nVBkO9mNYWxjGzP2ncieJPs6GGMspYjqaCURvlfNWTpH2/mf6/9d33V9v+u9XPO+zPP83nvu53nu5x3A2v9Z/l/9f4N/X/3d3PDiwhvKyW98AC89J1BO/iX+ZfX3C69GGw3ITQ5v5sYpl9bW3sw9Hm25Pt6o++blU8qlf4P/SH156T3l1SdWVlbHutBDFYrECjlCjfnMRMOzmbtTYw0DdbZDlQqDlUpj7aErHz9S/voTS+strFJOfpL/SP1xp+dYR+jMw6aFd7+urq5Nj98jVGkNV50BD0Ll+b47mp05O7vLVYk12iM1qsPVaoRKrScjZeAb38+/np1sGe+OfdTq8PHjyufWfpZ/rv7uza/DtRdHq8QJVfqkRsuJjrDJRquRWt2hat3x+pMd5fqd+N0DstzdKbs6buu3Fmn2VWoO1+o1Fpn1N4WQ7zsMVF0k35EcqdF89etjSos/yT9XB/NhsEp/olZxqFprtE6vu0TDxk8uCgnvrzQm3lFqrzjZYcVVeJS33ZCzCKvSkotryDFtL9Fpwibcxtj0lp0g1+k+uSs7XK0zO15JafEn+efqY53I8Xq9oSrt8bpT7aUGCl7Sm42gvCaC+i6wnhJlAvZQjuReu9i9hDNsTREHS3B+uk5nyjLUszA3MtF6tZnmnQUaRRl6feU6/Q0+b9++ozT6M/yo+urKyvPxvCekUvB4Si6ZHMwZb7CITTjr5i/zvF7FIUCW2gTKbCZC7SbmHnyi57bsyBW2U+eh5nX7Z9IY2s6y5GBUs5MzpC+Ln7E/ZuEF68Fj6jISJbyV3KJPYuNO2yW5zY0WPSYWPB4uej6KX139oez/UXVwZiDdsydXQPpvnyfc1hip1clKU2M1E5V3kPIOk+M1OcZgBqG3hTGYiuh7yHSidhZK7NkcKGdTvm9lDuhR395wk68s/drNm9eOOpzmchG/4auSHHZWy0+K3kRU2lmc2xmGjZUj1WiRKyHkJpuVlS9moa/x41FfHmkLH61RnahVItUbDVTqIbxlaWxhLLZwOj0h1nNH6E0hzNZQSRvJuHgISYdN/aIIgFK0Ld63tgpMZjJ1n+a4g4OWo1xv+Wooex5nMT2qfkPSLVKJ2kp0k6c4tRP8sItYX5niaK3qSGvwysclSq/f5EfVPy4vjbbdItUZjtafe9p4uiJfh8McwmgOYbCDsRgJM10RVnSWSEErN+bpDaI4cxF7aUKOA1EK6+rvgaU3VL0aXM03uIuw7rFRtj6eUHtvuRN+UhB3eToXOL0TjOaaGLOHeFmq6mSj4UhLANgXpddv8hPDdKIzgnjnQkeJvk+A2C1nOMtVCIO9KIMDjNlEmMUQgoyQ6CnUaS6ADalvP3UZAsTJA+GKVkX71xbALoAnhQzdStxNeVeKEp1TUdCL/gp2HpL81giaGxJMVtD1dpzhPtGqFfjzYIAo/X2PH1J/8/LJ7Hhd3x2Lc95istaCvBqCQft4xE8e2mwuusUSutkCynwZ6npT8n7u8a6AnRhRPuAXafpYMe5YUb8KdjDq4LHyFhjS3n7XYXttplhxsirUSXyTKZTJEc5kA92qK0jnhqBzhHM6w4RdET2VV6dHyl4+Iy8vfyfjv6X+/u3M7Gg+qTWEXG8+dVfPM+LkZnPoJksYz2WhcCFeT6G9p80FlDykNb1kIlGqd/Fa9WmCpDPMAc7cFsWHnXKknHPVnXLOhZWdzqyDEke2juI3Dymz3E042JSrm48+IeEmzWqx7s1iLMxyVYTRFspgCtnigvCPVSHXXhioNSE1+00Ppcy/mqTY/I1vqc+/fjJSozJZK12BPxmFVOG7Jk7rAGe0hrA5Ic44H99nCg8PkixNVG7O1GvOuViRrNKVyZgdJ3QhywuaWMIf28IYMQCP7aYNJfIgO3mRlWqZ/ukJ8B4cfVWKHDr0pNI1eU4rOI2FKPPFY+waAqxGwgxOMFo70aPO4t23Dci1GmM1UuRq5Xcv/5H66toqqS1qtOqcZqAEkzWU1hFOYw2jskMAtmKAg/gWN9H9bsLq/seqUyHNGcfu5PNeyXPem9B8LJ4sFEPIuT/KG9qT1/b4QHhPWiNZMqH/IIq0P7FDJ8enrGBvadLB0wGHjnge3h4EZXSEAkaQTTrCVLZw4JrEVjtYY4HSwzplYs05UmvEN4qz7+T6r5ONzaUXmZylAUcxFhfIbq9jCE9+3Vt8nt47UW47S0w5m3W5enVYG/A7FDNimUJI4vHdaQ3DfOH1Fri4C5jr5hnOWineFulI/sia2OqhUym9jLeI4inp1Xl7CfrMRB22VjuOtBvcPtF7jEL3S3kf2u0lyHBLLCRGhVRvSawzmBmvp3hsxHfU52Z7a7LVrJB8gYE8OGuuGiPONh1OwmlO0klOshbHiAX7xA2WloTtAkm4rSEDVR3D+yNaDNO8vfK0jbGm8sm3JJNj1NJDjXIcvfK1LTJcecPulbUQ90UN8MQX56L2mpwV8FY+glPY13x8Z98pLsJFjj6zrSVunEVhhwilR3oq1Gcft1A8NuI76hOkjG4MJ1Gas/UU9yPbbXOBzC/SGV400r4bp/4wR7XyEXg5B+jmeUlhSCcwXYjYBr983cvZLtui7hnlDGvnP+JCjQBRz4CIGdaYTl38db/889JxlQpJ3cppwyqZYZpFBwGUPBAhyxhwfK+LuMxl+AU1iJfy4eITu7oldgzHc4z2h1M8NuKr6qurH2cf3h1ocB64o0iyYo+W4tPE86cPcs6+pgYXyPU3gj9fA9haCSBo0Dyr3SG/zTFbWyktGgh7KpXY8/LN27W1RWhCF4AcB1BjQPQkEPlMPDnNPVfDIqvRJb8T+GX4RtGZXWgIEK0AIJWASCUAfVyiQMinfleRJk+vPkdglEh3tfXT0fLlpUWK05dsrP7+7dTD/pSBmouESu2GfP3iNPjAFTY7eUHgljx7jKQWXiC1iXNykmaaTC2XiLyUTRRDd+mmOGrjbwKRs0D0+LboQVzrSGbH+FF0J3i6rr5+TABRz0+mI02xpkeiOy0LBqUTUkyyDzCGS6mkC0bX7SA9ov84D0x5sRL12U2CeZkNhctw54Zrdchtt8D9LsXsT2ys/ny8ZLxanFgh9bTpjCdS+ZC1uEUQ7+BldpcTR4Ao+fUIhcjvQMJDCwUZotrNsjpM8OWeBVqbkSPrfqAlcpQ9ogsIHaBav/LJO2aCOrwfCBkCwsddCy5dTs90ye+mjuiLLYOPjNKuvf30Ma4BI57bCGe2O/juoHIRozGCWIRITFXJPLkn/3y8iGL2JzZWBzddpDbUQJX2UImaYYQUYIfgVxXAWLM91GJzPHkEQMkCMfLbYuG22doHUL1qKT3qGB9VbAiAnP4twGCGgPcAxpsSclokya6UgL43fAg9iEhKMsA6yyd08aMIHsXGa3PA2kdgeRkgXmcjnOJ0i9pN7QgHJ2JqFzHDsBOlqUotNQFfbmgpbKwOAm4fJ1ucY2NO8NhJbHGCyZ49cmP3TowzO+kcu/Xpo+DwOhp/1DDHWS550L+0xyXvCi+6CkA9+t310zEORI4A4WTwo+CK7Gwjgxu5RYXUXqaYVtdsfa/CtnM4ojrW/+UksLoKkPy2DShy3Qzj2eKO2Hx9fRlhNRSC2MmIeJ6YnJmmOH3JV9VBHpLuOQXL0ZtAmCwhTA6w3QbC7FpHw8J5Jk9zGKseg2MEzmUG7I0eFIhodMkyYANHZMQIEEb6FO91dSok+VRGr3khgRlJAAfr6fQu47yePTF9dLH9TlkGgsi6Q6h+2dTY6SebxkNZ+2R33ArbSe8Ko/KRpHeF03qLM4GVqZGwot/lla/su7+lHledzWMOofdAgG2BDdE4w+mMRQ5aQiNvcQ8ocMUZ7FDL8LUsGPIvaXHE67PGdSAwfe63CfzoHjDXwZBThw9g7g/PPp3iiu5dHwMRw+ufQPQjJnS/bYa+Z2GjV/mQbEpEp99WghQXNpiH0R1Gay5K4yuxfvhI0LvAmY2FNZF2FJu/8VX1j8vLWXh7Nl1BRltRBkcYWNyCRRJYZtCYQdnNj91G7R65yGCOd6YPHdgT2uaQZ7Y/Mh/dSAILH+2MdiDqc8JM7I3pPRLXTRM1+Ke8n9iOfuCeZ7gn9D5rGOF8RmC3IfMDJG9R6kmIFYzOSpTOAwGqf+pOeKs5JCz58tL71xSnL/mq+ngvnnBbT9JLksYSSu+GANtitIHSO8PBMSThiKhOk2zB8/jnnxVAdRa1jhik+p5KDxZMINqXEA6CUY8Go/7JHgw/cgKI+dMAQE4dT443zXDG3xtGxPc55xk1p3PW4qW78FJavpJU7mLg5oPBBQ7Gi94CqnNDmlylT3wQ+RPD9NfH9Y8aTz+ulyvEyfBcE6NyQIDZstkGusUJzmwFC/RVbsk1rElTxOWL7IprhaM7DoSX+xVfoIoYAMJHf891ygEOgPU8+Xwz4NQ+4V2oKxiVK4bu4Eb3xOdKVmPlClM0bDyVr7hK0pqI0LkjtniL0zjC2a0RmRiF8SrJyQbZ5+MFFLM/sbH62xcDY23eA3c0JuoNinAa5/2OHzOCGyD2ax/nU7kqougIiw9XSYlSbinmlMFGKaYSk+oIWhhXvUyv9SXp89T++YgcUUzuNC4gMEb0gVM7+NvT2BCDVAvkHYIWfuhoUlpjCUdDhnpJqi7fFWFzJ8ld4LbDHbHfAiZsJAhuIPEp50brdMltQT+xJIEsLi5OkYqH6y4/azYaumPkZaEczc19i4tbTluE2hW+z0RE97p0eyBbWgJ8J6pTKr5dOLo5oEBXDRsKRE4D0U8+JzdTWM/doYm1xdcCcQQgfEY2NT646JxoTKNkXNsOVG9cskJHAFNDlqp/iByDCUTADnbWXJxN96icrRT/Zbiqn0Jbsf5wN/YvTzZ/56vqnxnsr0tLVL2XrbbbUkRM84i5wpHttnAGayi1uaiow5F2U44+eybdAg/6kOHaLuLByHuWGZesc212xd8FIp6Ayz4QMSWZQjbPJ/HHVF3JcnbK1N4fUX27jbgTOXwyK7jAcXuP0fbqdDFldwkqd3E2exjEAkrtJb7ZS5zOHiZtfgzuplzV1kRR+RvfUZ969myfsZSEswS7PYLqmhiLuzijA5zZRITGBibsdrhdb/skkmmUzCCTgGINJqql9fiW9ijG/+KCP2+fZ66J81dND1VJ8zPBmzhmaqkk+rgXtuvhe1lCiHJJKe4lh2RNhDs0ue/hZQwCFRnMIIwWEGpPccb1LTYMnMrorkBs0gMoHhvxHfUXjx6c85QE9y9M5iL0rgg6ZzizmQizqQi1A+J04MFuDc6nZfRri0B/z1b5VBQskXgB2382td81/4E0OvUq5rpmuv/VZG+5OIxN9r2LGQT1tD6xJLJoYppfsQBrLGKnm+QDpR19hWIeIScYTEQYbEUZ7WB04GJkK0pnBuV2g/d0lFI8NuJ7UR/AFCSrsYFbdwsI7Q1xOjc4OFGC97DJGm4WsqdXketFN83aMrA2D1Q3spjgTLZFNkkkks5mkE4l9yXWk4Fbo2FVIzpYglLasGwyGQjuuIq3iyvdSRcpDkTLMwVJ10rtak8TQLjL0llCwZ31Ft/1Zxv0NqKHnIVSE09Md4d94yHet9Tfv3vRXnpB30NkmxWEwU4ULCoYHWH07uvqgLu4RxQvQYlzcWoTWDyNTtDtiRaVSeb3KRQxzrbdm5zLg2k9gAZLA+Lu2N7dSa08mOJL2U4V9w8vTgNjE1v2xyIApDx1mEyO/N570XxCtgh6a1GwZTpPMXD5YzYUOmAn6BF0OBOjNPf8IcXmb3xLfeHN9KMe5FV/fVZw324BYbCCMl8UYjIWprsiLKghkOC4fVh/+8orYOk1lXKqIBChsL5piJc6Hnsg9/rO0pDDETlSv+SdDc87nhd+tDWA8zkB7AtYWwHAT6mme+uWMBkgSi7k1MH+X3hN3CRorNbXbDA62/QEGW1EwQWExVzMJs5+ZuYfqVNYfp/TWCoZrA/u1beaQnguQqEnjnhKctfZbSPas699AAIqd617J8hvCpVRMhDFIPi6lbc98GYh3zd69bSD/MCy2X/bgOpWogrHRDTLu+nNn2/gejkvEKlgrXG035VT21aY1kp0y00JcHSCxRKLsTCTt8SNrCiKwFfYQH11dfXvjxAWFxbulAYWpZ8qzzSwPHNU1OhQtRXHVBBz/QgrECMLhMmeMITiJPeNqTEP+nLeyRAqSz0+1FW+vLLW19FQh0VU4iH3fXkIqqzg9nkCyTI/u3n5IyCVJXRSG9ppxbbnuhCdA5zaXWyTFYzBEc5nJxdZnvx87gWlb5DVlU9WX7CB+srKSmUPeWl5mXL+G1O9kZNNhmO12ioux3a5CXaYszdFsR2Lh8oZwDNl9pHPsg8Fcafj1KRRGLbQdv3wG+OEuqXl1YfDbbHxF7lD7h6Jzg9J0ekO3tWjwUlU45qJY2rpY1Z3FnxgyCnmeojKEbHrhpRbrHJossXII7CM+4Ol5Y93ekdBK8r5b/yh/mFp+eHMi9GZOfC1b/14SOPo5+ufWVn5+Lg7glR9frpWSt9dUsLxQI8eR6TivmQ5PpImW74Hh0b4AenrsmwB9UAMuD19eDAY19t9Hyy1JwZbzoaEAKhpIGZuS/hD3QAttSg+jBtn9/ntE9rsqed2NZ/mOhPAx3gVkY5CvGjQeNHtT+nyN0LvjvrWj4EvOkanPiz98RD4D3XwtmZfvTuL7QlsmgyoH2FEDrZOPKf87hN5pTgxN5+gWLOuYs0I5OG+C9v7tbfneHPoeu62doNxuEpTWcNY3PUCUPapyTp0QU2YlpG1D/O5bcM0Ie3usW43kry53YK2mEpuNhBhsIcqBh2Mv849oM1OUuG4Hrk3KUmpKNNIxsMjCYem9PeJlvFnTFGDAXUjgU2PMA++iP1fE6Zh7AVNDJkRRQTiHh/GEJ/8SvneeWz21T5UF+BYR2Uen4APfNpqmBfJIR94iN5NdJO9hN5NaWmn4zS2MFrbY9fCpQKTfMGSPa57du3jQnovGO9Jp/iw+9jjPOaCDJePsZiJ0LiLAY7ijCZCckH88TFcxRjB3obIQw4hgHvjjqju3klKyKZevD6ctG7CGE2kjRn9y3euG+Q68sEjqsSn64Ve4ow4dvT52/WkV8gYAhJfyMRHs19L2+FQdLfjwf3aGxBT2BZrODiwAG9Jeif4NnsIh/XRXYaHLYNduMIfxN4fXX45l9pCZonsckv45ZK7CNtVAXZrsKwVo/cQY7AXpfaWAOzF+D2V6u5m6qDqWbxydsbUA4nvBDCD8+8X38y/l8UNA+smD0Ef5IO/zpIbqINTjHnZCFXSDFgAKmITHHKyn7+aF00ZkcOnF5XwROQcFwjFCAc0dLTmjZWrW/rAthoLsVwWojUS0Qzii0096Oi/Lx/DXR4Ir5GSa9RUrpGSz7wGa8w57HCLPxLNbxiwh8YYAu4Y6exFqZzg/J6Qstpc39tTh8Ox15JUkLkSCAxub9wA+ckz9VwSVeIMGEHwp3kZCbSi6P3GRurgYvR+UTV77EhKpVvaOb8stUv46vz+V2YZmJgimchsCVQW7GqajeSNGBf0dYgrfKs5P5MTdIuLuD7y0Kkk9K7ETsHEosvOjt06rE+qgD4DxiuWdrzoao74fumkDLvAfRxGCCYbKL/lMTUniJCV1omERqnYWKdU3YRsweAsRRtcRH7HuErOCADGLmacKmlWPZe48H6DundjdZC5t4sXcI2XU51tsUYimPyLuIKszueBt8sM462cc41T8w/7psgro2+yeqJhgcjrRdjS1oq+ZtczaVG7YhvFMRkWjjY9FqyvnwAER0Z3a2P51CS+uCqF1KSxHvenTx6lNVR4pmVqRKIVo0J8ci9E4eEZZYLOuEvmOVUpLVNSeBKYq+sZmzR7Mpv08t0CxelLvqoO8vztkm5O+2HMnbQ8/qh8OURSRfC9X2OaHgnENAfknSmp2JVbuFsn7YZKUrwevsLr7kt8Y0Z6tsLdAtGB4iPExPP9lrpEd90BC61h9IXRsiOthYJFBccL7mFQ7bPauV0aGXHH4rNKKneXlHDdxCrrx7m5lxID66c4E8bX8zv24ad4k16+nafY/I1vqYO8Xlh1Lus0TrbDZAvIYWINk2yd8it8SgdFfFM0op3C8pTsU/Qyiw9cwZjbZlpwIevPxPqfC/UxjfFxzSsNqeqOaRgLujPsW1zmkOipEx6gFBIIjUo5iU+IzpPMKd57Pt3PAX/FONF8hwdWPabNIq/ODmt8KLkSQM9sjn9sUUZeWNg43p/5jvpnopoe8keVqmNDy/MYbmaqIlC5XD71gFkxq1OSUoirTfJFz1RV8AYUUqIj8OIRBbJOyWdDSlSvoPUcM86dinZ3SdO6htcIyZELSkakFArKJqLSyyHgKJKPDaZxL9lkg+N2SzdOckkph6fg9rvnGbLFEKNbvvo9zO/8kDrIvYcLuhlVV5Mss8oFErH77VL1hZEpVG6VgEXhZjvcQe8w0dBIyfi4M2ivkDJ1P9yp4tpDziiFzGLe6ExhVC7CNfuie6GRR8oZF5z+/hC8kN8tWqdMwCoH8KhlD7ljlWqUUXAQX3TQHnfVFJfd/vCLpfBr/Kg6yMKHVVTz41OY3KtpdtgcvvSs/f45qibxRkcDogDncsC2hMY2jcEpUy8p90oG9mxigiry1hl06Clk8OkYpEZSpnJc5VaXDMA6a7N9FuBeS+tbeynRxinjEl9MiVZmoBnO3gwXGv9gfGHjh+kb8BPqn3n8cvmXu5M6qWk60XbxJZIZ2bzZhftckjSUEsOAsBGWX5rGZ14vLq29ml8jTs9PvV8jPHk3N782/2FtdPolc9B9IHwQiCYD6GkO9IOC8n2ZhQdOJoYJJvZGNBAf//pD/xrwOz+t/pkX79awXU+NMu9qxd3UwVzzKzivnRMEJLzmQQ/Mg+KfePXi2fL7hZfPZz+fLnxY5kGDS/IskPAUSP6VNunR+bgAl9z8gr6xuXc/9M36X/iH6r9DnF1Btz2zLmo/Gt/FFDdhUjL88bdKY+bp0/n5d9PTlEfMYOVkVjrCFDfGnzhoVErGdEwRZ34uzH/hP1X/nTcLy+SZufeLHyjn6/+StjQ3N/fhwx9XFpeWRmfAFeaH0/mb/Gvq/33+X/2/z9ra/wDM1gI6hxsIEgAAAABJRU5ErkJggg=="/>
                        </td>
                        <td style="border: 0px" align="center">
                            MINIST&Eacute;RIO DA FAZENDA<br/>
                            SECRETARIA DO TESOURO NACIONAL<br/>
                            Guia do Recolhimento da Uni&atilde;o - GRU
                        </td>
                    </tr>
                </table>
            </td>
            <td>C&oacute;digo de Recolhimento</td>
            <td class="right">' . @$arrParam['coRecolhimento'] . '</td>
        </tr>
        <tr>
            <td>N&uacute;mero de Refer&ecirc;ncia</td>
            <td class="right">' . @$arrParam['nuReferencia'] . '</td>
        </tr>
        <tr>
            <td>Compet&ecirc;ncia</td>
            <td>' . @$arrParam['dsCompetencia'] . '</td>
        </tr>
        <tr>
            <td>Vencimento</td>
            <td class="right">' . Date::convertDate(@$arrParam['dtVencimento'], 'd/m/Y') . '</td>
        </tr>
        <tr>
            <td>
                Nome do Contribuinte / Recolhedor:<br/>
                ' . @$arrParam['noContribuinte'] . '
            </td>
            <td>CNPJ ou CPF do Contribuinte</td>
            <td class="right">' . Format::formatCpfCnpj(@$arrParam['nuCpfCnpj']) . '</td>
        </tr>
        <tr>
            <td>
                Nome da Unidade Favorecida:<br/>
                ' . @$arrParam['noUnidade'] . '
            </td>
            <td>UG / Gest&atilde;o</td>
            <td class="right">' . @$arrParam['ugGestao'] . '</td>
        </tr>
        <tr>
            <td rowspan="4">
                Instru&ccedil;&otilde;es: As informa&ccedil;&otilde;es inseridas nessa guia s&atilde;o de exclusiva responsabilidade do contribuinte,
                que dever&aacute;, em caso de d&uacute;vidas, consultar a Unidade Favorecida dos recursos.<br/>
                <strong>Senhor caixa: Favor n&atilde;o receber ap&oacute;s o vencimento</strong>
            </td>
            <td>(=) Valor do Principal</td>
            <td class="right">' . Format::floatToMoney((float) @$arrParam['vlPrincipal']) . '</td>
        </tr>
        <tr>
            <td>(-) Desconto/Abatimento</td>
            <td class="right">' . Format::floatToMoney((float) @$arrParam['vlDesconto']) . '</td>
        </tr>
        <tr>
            <td>(-) Outras dedu&ccedil;&otilde;es</td>
            <td class="right">' . Format::floatToMoney((float) @$arrParam['vlDeducao']) . '</td>
        </tr>
        <tr>
            <td>(+) Mora / Multa</td>
            <td class="right">' . Format::floatToMoney((float) @$arrParam['vlMulta']) . '</td>
        </tr>
        <tr>
            <td rowspan="3" align="center">
                GRU SIMPLES<br/>
                Pagamento exclusivo no Banco do Brasil S.A.<br/>
            </td>
            <td>(+) Juros / Encargos</td>
            <td class="right">' . Format::floatToMoney((float) @$arrParam['vlJuros']) . '</td>
        </tr>
        <tr>
            <td>(+) Outros Acr&eacute;scimos</td>
            <td class="right">' . Format::floatToMoney((float) @$arrParam['vlAcrescimo']) . '</td>
        </tr>
        <tr>
            <td>(=) Valor Total</td>
            <td class="right">' . Format::floatToMoney(@$arrParam['vlTotal']) . '</td>
        </tr>
        </tbody>
    </table>
    <strong>' . $this->formatCodigoBarra(@$arrParam['nuCodigoBarra']) . '</strong>
    <br />
    ' . (new BarcodeHelper())->render(@$arrParam['nuCodigoBarra'], array('drawText' => false), array(), 'code25interleaved', 'image', true) . '</div>';
        $strResult .= $strGru . '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAu4AAAAYCAYAAAClSXjnAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAALqSURBVHhe7d3PK2xhHMfxz0wps1KzVRQbWQjJYhaywIqVlZI1JQsLhViNXxuTnRLNSslGfpSSqdlOZOFHI1KyEyVJodx7n+c8up0G9y5m7sx036/Nefp+nz/g0+l7vifw4xcBAAAAKGhB9wQAAABQwAjuAAAAQBEguAMAAABFgOAOAAAAFIGM4P78/Kx0Oq2XlxdXAQAAAJBvvq0yDw8P6u/vVzAY1P39vWKxmGpra133c+/v7zo9PdXFxYXq6+tVVVXlOgAAAACyxffG/fj4WOXl5VpdXdXIyIii0ai+2xa5s7Oj5uZmNTQ0aGVlRU9PT64DAAAAIJt8wb2mpkbn5+eKx+MqKyuzYzOBQMB1f7u+vlZfX586Ozt1d3dnQ/vW1pbq6urcDQAAAADZlPEDppubG83MzGhtbU1vb2/a3t5WS0uL60qLi4saHR3V4+OjfQ4PDyscDrsuAAAAgFz48s+pR0dHmpub097enqamptTY2GjHZ5LJpLq6uuwYDW/YAQAAgH/jy+D+YXd3VwsLC9rf31dlZaVmZ2fV3d3tun+nqanJnaSDgwN3ov6Buoe6h7qHuoe6h7qHuoe6h7rnf6p/G9xNaJ+entbl5aXdNmNm26+urjQ+Pq62tjZ3CwAAAECuffoDppOTE/X29mpyctKeE4mEPQ8MDNj1j+3t7erp6bEfsgIAAADIPV9wf319tfPsY2NjdmtMKpWyH6ZWV1fbvnllb2bczejMxsaG3dtuZt3Nh6oAAAAAcscX3E1oNysgNzc31dHRofX1dZWWlmashBwaGtLh4aFaW1s1MTFhP1JdWlqyP3ACAAAAkH2+Gff5+Xnd3t7at+xmvv3s7MzuaK+oqHA3Mi0vL9u7JSUlGhwcVCQScR0AAAAA2eIL7mZ+3expT6fTdgzGzLGHQiHXBQAAAJAvf1wHCQAAACD/Pt0qAwAAAKCwENwBAACAIkBwBwAAAIoAwR0AAAAoAgR3AAAAoOBJPwFYImV1+Iov/gAAAABJRU5ErkJggg=="/>' . $strGru;
        return $strResult;
    }

    private function getCheckDigit($strNuCodigoBarra = null)
    {
        $intMultiplicador = 2;
        $intDigito = 0;
        for ($intContador = strlen($strNuCodigoBarra) - 1; $intContador >= 0; $intContador--) {
            $intDigito = $intDigito + $intMultiplicador * (int) $strNuCodigoBarra{$intContador};
            $intMultiplicador = $intMultiplicador + 1;
            if ($intMultiplicador == 10)
                $intMultiplicador = 2;
        }
        $intResto = $intDigito % 11;
        if (($intResto == 0) || ($intResto == 1))
            $intDigitoVerificador = 0;
        elseif ($intResto == 10)
            $intDigitoVerificador = 1;
        else
            $intDigitoVerificador = 11 - ($intDigito % 11);
        return $intDigitoVerificador;
    }

    private function formatCodigoBarra($strNuCodigoBarra = null)
    {
        $strNuCodigoBarraFormated = '';
        for ($intCount = 0; $intCount <= 3; ++$intCount) {
            $strNuCodigoBarraBloco = substr($strNuCodigoBarra, $intCount * 11, 11);
            $strNuCodigoBarraFormated .= $strNuCodigoBarraBloco . '-' . $this->getCheckDigit($strNuCodigoBarraBloco) . ' ';
        }
        return trim($strNuCodigoBarraFormated);
    }

}
