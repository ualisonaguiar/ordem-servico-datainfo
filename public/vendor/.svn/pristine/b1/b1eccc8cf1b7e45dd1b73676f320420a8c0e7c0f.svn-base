/**
 * Responsavel pelo menu administrative responsible
 */
function getIndexMenuCookie()
{
    var strIndexMenuCookie = getCookie('indexMenu');
    if (empty(strIndexMenuCookie))
        strIndexMenuCookie = '';
    return strIndexMenuCookie;
}

function setIndexMenuCookie(strIndexMenuCookie)
{
    return setCookie('indexMenu', strIndexMenuCookie);
}

function clearIndexMenuCookie()
{
    return setIndexMenuCookie('');
}

function getIndexMenu(element)
{
    if (empty(element))
        return;
    var strIndexMenu = '';
    var intMaxLoop = 0;
    while (((element.parent().prop('tagName') == 'UL') || (element.parent().prop('tagName') == 'LI')) && (intMaxLoop <= 10)) {
        if (element.prop('tagName') == 'A') {
            var arrIndexMenu = explode('<', element.html());
            strIndexMenu += jQuery.trim(arrIndexMenu[0]);
            if ((strIndexMenu === '') || (strIndexMenu == '<')) {
                strIndexMenu = '';
                arrIndexMenu = explode('>', element.html());
                arrIndexMenu = explode('<', arrIndexMenu[2]);
                strIndexMenu += jQuery.trim(arrIndexMenu[0]);
            }
        }
        if ((element.prop('tagName') == 'UL') || (element.prop('tagName') == 'LI'))
            strIndexMenu += '-' + element.index();
        element = element.parent();
        ++intMaxLoop;
    }
    return '[' + strIndexMenu + ']';
}

var booGlobalEditMenu = false;
function editMenu()
{
    if (booGlobalEditMenu)
        return;
//    clearIndexMenuCookie();
    var strIndexMenuCookie = getIndexMenuCookie();
    $('#menu-administrative-responsible li ul').each(function () {
        var strIndexMenu = getIndexMenu($(this).parent().children('a'));
        var strClass = 'up';
        if (strIndexMenuCookie.indexOf(strIndexMenu) == -1) {
            $(this).addClass('hide');
            strClass = 'down';
        }
        $(this).parent().children('a').append('<i class="fa fa-angle-' + strClass + ' pull-right"></i>');
    });
    editClickMenu();
    if ($('#menu-administrative-responsible .active').length > 1) {
        var arrElementActive = $('#menu-administrative-responsible .active'),
                intCountActive = arrElementActive.length - 1;
        arrElementActive.each(function (intPosicao) {
            if (intPosicao < intCountActive)
                $(this).removeClass('active');
        });
    }
    booGlobalEditMenu = true;
}

function editClickMenu()
{
    $('#menu-administrative-responsible a').on('click', function (event) {
        var elementList = $(this).parent().children('ul');
        if (elementList.length) {
            var strIndexMenu = getIndexMenu($(this));
            var strIndexMenuCookie = getIndexMenuCookie();
            if (elementList.hasClass('hide')) {
                $(this).children('i:last').removeClass('fa-angle-down').addClass('fa-angle-up');
                elementList.removeClass('hide');
                strIndexMenuCookie += strIndexMenu;
            } else {
                $(this).children('i:last').removeClass('fa-angle-up').addClass('fa-angle-down');
                elementList.addClass('hide');
                strIndexMenuCookie = replaceAll(strIndexMenuCookie, strIndexMenu, '');
            }
            setIndexMenuCookie(strIndexMenuCookie);
        } else 
        	angular.element(this).scope().clickMenu(event);
    });
}

function scriptMenuBootstap()
{
	editMenu();
    $('#inepZendMenuBootstrapMenu').show();
    $('#inepZendMenuBootstrapBreadcrumbs').show();
    $('.menu-personalizado ul').addClass('dropdown-menu');
    $('.menu-personalizado li').each(function () {
        if ($(this).children('ul').length) {
            $(this).addClass('dropdown');
            $(this).children('a').attr('data-toggle', 'dropdown').addClass('dropdown-toggle');
            if (!$(this).parent('ul').hasClass('dropdown-menu'))
                $(this).children('a').html($(this).children('a').html() + '<b class="caret"></b>');
        }
    });
    $('ul.dropdown-menu').each(function () {
        if ($(this).children('li').children('ul').length) {
            $(this).children('li').children('a').removeClass('dropdown-toggle');
            $(this).children('li').find('ul').parent().addClass('dropdown-submenu');
        }
    });
    if ($('.menu-personalizado').hasClass('hide'))
        $('.menu-personalizado').removeClass('hide');
}

$(document).ready(function () {
	scriptMenuBootstap();
});

function enableMenuReponsible()
{
    $('#contentContainer #contentApplication').removeClass('col-md-12 col-md-offset-0').addClass('col-md-10 col-md-offset-2');
    $('#menu-administrative-responsible').removeClass('hidden');
    $('#menu-administrative-responsible').removeAttr('style');
    setCookie('menu-toggle-responsible-not-fix', true, undefined, '/');
}

function disableMenuReponsible()
{
    $('#contentContainer #contentApplication').removeClass('col-md-10 col-md-offset-2').addClass('col-md-12 col-md-offset-0');
    $('#menu-administrative-responsible').addClass('hidden');
    $('#menu-administrative-responsible').attr('style', 'display: none; visibility: hidden');
    setCookie('menu-toggle-responsible-not-fix', false, undefined, '/');
}

function addIcoMenuBar()
{
    if (($('#userAuthenticated').length) && ($('body #btn-menu-administrative-responsible').length)) {
        $('.navbar-header a').attr('style', 'padding-left: 40px;');
        $('.navbar-header button:first').after('<a class="navbar-brand open-menu-administrative-responsible-not-fix pull-left" style="cursor: pointer;"><i class="fa fa-bars" style="color: white"></i></a>');
    }
}

function scriptMenuNotFix(booClick)
{
	if (booClick !== false) {
		$('body').on('click', '.open-menu-administrative-responsible-not-fix, #btn-menu-administrative-responsible', function () {
	        if ($('#contentContainer #contentApplication').hasClass('col-md-12 col-md-offset-0')) {
	            enableMenuReponsible();
	        } else {
	            if ($('#contentContainer').hasClass('container-menu-responsible')) {
	                enableMenuReponsible();
	                $('#contentContainer').removeClass('container-menu-responsible');
	                return false;
	            }
	            disableMenuReponsible();
	        }
	    });
	}
    if ($('#userAuthenticated').length) {
        $('#menu-administrative-responsible').attr('style', 'display: none; visibility: hidden');
        $('#contentContainer .content').removeClass('col-md-10 col-md-offset-2').addClass('col-md-12 col-md-offset-0');
        if ((booClick !== false) && (getCookie('menu-toggle-responsible-not-fix') == "true"))
            $('.open-menu-administrative-responsible-not-fix').trigger('click');
    }
}