var arrGlobalLocationHref = [];
function WindowUtil(http, location, q, window, compile) {

	var self = this;
	self.booDebug = false;
	self.scope = undefined;
	self.http = http;
	self.location = location;
	self.q = q;
	self.window = window;
	self.compile = compile;

	self.init = function(scope) {
		if (!empty(self.scope))
			return this;
		self.scope = scope;
		if ((!empty(self.scope)) && (!empty(self.q))) {
			self.scope.q = self.q;
			self.scope.canceller = self.q.defer();
		}
		return this;
	};

	self.locationHref = function(strUrl, element) {
		if ((empty(strUrl)) || (empty(self.scope)) || (empty(self.http)) || (empty(self.location)) || (empty(self.q)) || (empty(self.window)) || (empty(self.compile))) {
			if (self.booDebug)
				console.log('Parâmetros obrigatórios não informados.');
			return false;
		}
		if ((strGlobalBasePath !== '') && (strUrl.substr(0, 1) == '/') && (strUrl.indexOf(strGlobalBasePath) == -1))
			strUrl = strGlobalBasePath + strUrl;
		if (self.booDebug) {
			console.log(strUrl);
			console.log(element);
		}
		if (!empty(arrGlobalLocationHref[strUrl]))
	        if ((new Date().getTime() - arrGlobalLocationHref[strUrl]) < 1000)
	            return false;
		arrGlobalLocationHref[strUrl] = new Date().getTime();
		if (document.all) {
			self.window.location.href = strUrl;
			return true;
		}
		var strUrlLocal = replaceAll(replaceAll(strUrl, 'http://', ''), 'https://', '');
		var intPos = strUrlLocal.indexOf('/');
		strUrlLocal = (intPos == -1) ? '/' : strUrlLocal.substr(intPos);
		var locationConfig = function() {
			self.location.absUrl(strUrl);
			self.location.path(strUrlLocal);
			self.location.url(strUrlLocal);
			self.location.replace();
		};
		locationConfig();
		var successCallback = function(response) {
			locationConfig();
			self.scope.canceller.resolve();
			self.scope.canceller = self.scope.q.defer();
			var mixData = response.data;
			var intStatus = response.status;
			if (self.booDebug) {
				console.log(mixData);
				console.log(intStatus);
			}
			var bodyCallback = function() {
				if (isObject(mixData))
					return;
				var intPos = mixData.toLowerCase().indexOf('<body');
				var strBody = mixData.substr(intPos);
				intPos = strBody.toLowerCase().indexOf('>');
				strBody = strBody.substr(0, intPos + 1);
				var strBodyAttribute = trim(replaceAll(replaceAll(strBody, '<body', ''), '>', ''));
				var strBodyClass;
				if (strBodyAttribute.indexOf('class') != -1) {
					intPos = strBodyAttribute.toLowerCase().indexOf('class=') + 6;
					strBodyClass = trim(replaceAll(strBodyAttribute.substr(intPos), '"', ''));
				}
				if (self.booDebug) {
					console.log(strBody);
					console.log(strBodyAttribute);
					console.log(strBodyClass);
				}
				if (!empty(strBodyClass))
					$('body').removeClass().addClass(strBodyClass);
			};
			var titleCallback = function() {
				if (isObject(mixData))
					return;
				var intPosInit = mixData.toLowerCase().indexOf('<title>') + 7;
				var intPosFinal = mixData.toLowerCase().indexOf('</title>');
				var strTitle = mixData.substr(intPosInit, intPosFinal - intPosInit);
				if (self.booDebug)
					console.log(strTitle);
				document.title = strTitle;
			};
			var navbarCallback = function() {
				if (isObject(mixData))
					return;
				var strNavbar = $('nav.navbar.navbar-default.navbar-fixed-top', $(mixData)).html();
				if (self.booDebug)
					console.log(strNavbar);
				$('nav.navbar.navbar-default.navbar-fixed-top').html(strNavbar);
				scriptContrast();
			};
			var logoCallback = function() {
				if (isObject(mixData))
					return;
				var strFaixaLogo = $('.faixa-logo', $(mixData)).html();
				if (self.booDebug)
					console.log(strFaixaLogo);
				$('.faixa-logo').html(strFaixaLogo);
			};
			var menuCallback = function() {
				if (isObject(mixData))
					return;
				var strMenu = $('#menu-administrative-responsible', $(mixData)).html();
				if (self.booDebug)
					console.log(strMenu);
				if (empty(strMenu)) {
					$('#menu-administrative-responsible').html('');
					$('#menu-administrative-responsible').hide();
					$('#menu-administrative-responsible').addClass('hidden');
					$('#contentApplication').attr('class', 'col-sm-9 col-sm-offset-3 content col-md-12 col-md-offset-0');
					$('body>div.row>div.container-fluid').removeClass('container-fluid').addClass('container');
				} else {
					if ($('#menu-administrative-responsible').html() === '') {
						$('#menu-administrative-responsible').html(strMenu);
						$('#contentApplication').attr('class', 'col-sm-9 col-sm-offset-3 content col-md-10 col-md-offset-2');
						$('#menu-administrative-responsible').show();
						$('#menu-administrative-responsible').removeClass('hidden');
						booGlobalEditMenu = false;
						scriptMenuBootstap();
						if ((existFunction('disableMenuReponsible')) && (intGlobalMenuFix === 0))
							disableMenuReponsible();
						$('body>div.row>div.container').removeClass('container').addClass('container-fluid');
					} else if (!empty(element)) {
						$('#menu-administrative-responsible .active').removeClass('active');
						element.parentNode.setAttribute('class', 'active');
					}
				}
			};
			var breadcrumbCallback = function() {
				var strBreadcrumb = $('.breadcrumb', $(mixData)).html();
				if (self.booDebug)
					console.log(strBreadcrumb);
				if (!isObject(mixData)) {
					if (empty(strBreadcrumb)) {
						$('.breadcrumb').hide();
						strBreadcrumb = '';
					} else
						$('.breadcrumb').show();
					$('.breadcrumb').html(strBreadcrumb);
				} else {
					$('.breadcrumb').hide();
					$('.breadcrumb').html('');
				}
			};
			var messageCallback = function() {
				var strMessage = $('.showMessage-fluid', $(mixData)).html();
				if (self.booDebug)
					console.log(strMessage);
				if (!isObject(mixData)) {
					if (empty(strMessage))
						strMessage = '';
					$('.showMessage-fluid').html(strMessage);
				} else
					$('.showMessage-fluid').html('');
			};
			var contentCallback = function() {
				var strContent = $('.panel-content', $(mixData)).html();
				if (self.booDebug)
					console.log(strContent);
				if (!isObject(mixData)) {
					var arrScript = $('script', $(strContent)).get();
					for (var intCount = 0; intCount < arrScript.length; ++intCount) {
						var scriptElement = arrScript[intCount];
						if (scriptElement.getAttribute('data-angular-controller') != 'true')
							continue;
						var strSource = replaceAll(scriptElement.getAttribute('src'), strGlobalBasePath, '');
						if (!empty(strSource))
							strSource = 'include_once("' + strSource + '");';
						else {
							strSource = scriptElement.innerHTML;
							if (strSource.indexOf('include') !== 0)
								strSource = undefined;
						}
						if (!empty(strSource))
							eval(strSource);
					}
					try {
						$('input:hidden[id*="filter_criteria"]').val('');
						$('.panel-content').html(self.compile(strContent)(self.scope));
						closeDialog(undefined, true);
					} catch (exception) {
						if (self.booDebug)
							console.log(exception);
						$('.panel-content').html(strContent);
					}
				} else
					$('.panel-content').html(JSON.stringify(mixData));
			};
			booGlobalCheckAlterSessionId = false;
			bodyCallback();
			titleCallback();
			navbarCallback();
			logoCallback();
			menuCallback();
			breadcrumbCallback();
			messageCallback();
			contentCallback();
            if (!empty(formValidate))
                formValidate();
			return true;
		};
		var errorCallback = function(response) {
			if (self.booDebug) {
				console.log('Ocorreu um erro durante a operação!');
				console.log(response);
			}
		};
		var mixResult = self.http({
			'method': 'GET',
			'url': strUrl,
			'timeout': self.scope.canceller.promise
		}).then(successCallback, errorCallback);
		if (self.booDebug)
	    	console.log(mixResult);
		return mixResult;
	};

}