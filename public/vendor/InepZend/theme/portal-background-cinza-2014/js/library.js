/*************** AUMENTAR E DIMINUIR FONTES *********************/
function aplicar_resize_fontes() {
    jQuery("#aumentarFonte").click(function() {
        jQuery("#contentContainer h1").animate({
            fontSize: "28px"
        }, {
            queue: false,
            duration: 1000
        })
        jQuery(".caixaVazada h2, #contentContainer h2").animate({
            fontSize: "24px"
        }, {
            queue: false,
            duration: 1000
        })
        jQuery("#tituloInternas h3, #contentContainer h3").animate({
            fontSize: "22px"
        }, {
            queue: false,
            duration: 1000
        })
        jQuery("#tituloInternas h4, #contentContainer h4").animate({
            fontSize: "20px"
        }, {
            queue: false,
            duration: 1000
        })
        jQuery("#tituloInternas h5 #contentContainer h5").animate({
            fontSize: "18px"
        }, {
            queue: false,
            duration: 1000
        })

        jQuery(".classForm * , #loginContainer * , .breadcrumb *").animate({
            fontSize: "120%"
        }, {
            queue: false,
            duration: 1000
        })
        jQuery(".flexigrid *, #contentContainer div, #contentContainer p, #contentContainer span, #contentContainer a, #contentContainer li").animate({
            fontSize: "110%"
        }, {
            queue: false,
            duration: 1000
        })

    });
    jQuery("#diminuirFonte").click(function() {
        jQuery("#contentContainer h1").animate({
            fontSize: "24px"
        }, {
            queue: false,
            duration: 1000
        })
        jQuery(".caixaVazada h2, #contentContainer h2").animate({
            fontSize: "20px"
        }, {
            queue: false,
            duration: 1000
        })
        jQuery("#tituloInternas h3, #contentContainer h3").animate({
            fontSize: "18px"
        }, {
            queue: false,
            duration: 1000
        })
        jQuery("#tituloInternas h4, #contentContainer h4").animate({
            fontSize: "16px"
        }, {
            queue: false,
            duration: 1000
        })
        jQuery("#tituloInternas h5 #contentContainer h5").animate({
            fontSize: "14px"
        }, {
            queue: false,
            duration: 1000
        })
        jQuery("#tituloInternas h3").animate({
            fontSize: "20px"
        }, {
            queue: false,
            duration: 1000
        })

        jQuery(".classForm * , #loginContainer * , .breadcrumb *").animate({
            fontSize: "100%"
        }, {
            queue: false,
            duration: 1000
        })
        jQuery(".flexigrid *, #contentContainer div, #contentContainer p, #contentContainer span, #contentContainer a, #contentContainer li").animate({
            fontSize: "100%"
        }, {
            queue: false,
            duration: 1000
        })
    });
}

$(document).ready(function() {
    include_once('/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js' + strGlobalSufixJsGzip);
    $("#inepZendMenuColapse .menuList li ul").parent().accordion({
        collapsible: true,
        active: false,
        icons: false,
        heightStyle: "content",
    });
    aplicar_resize_fontes();
    $('#inepZendMenuColapse').show();
    $('.menuVerticalSize a[href$="' + location.href +'"]').closest('.ui-accordion').find('a:first').trigger('click');
});