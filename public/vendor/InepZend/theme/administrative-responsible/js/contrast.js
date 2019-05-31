function scriptContrast()
{
    if (getCookie('contrast_theme') === 'true')
        $('body').addClass('contrast');
    $('a.contrast').on('click', function (element) {
        element.preventDefault();
        $('body').toggleClass('contrast');
        ($('body').hasClass('contrast')) ? setCookie('contrast_theme', true, undefined, '/') : setCookie('contrast_theme', false, undefined, '/');
    });
}

$(document).ready(function () {
	scriptContrast();
});