function AsyncMessage() {
	
	var self = this;
	self.booDebug = false;

	self.add = function(strText, strTitle) {
		if (self.booDebug) {
			console.log(strTitle);
			console.log(strText);
		}
		$.gritter.add({
			'text': strText,
			'title': strTitle
		});
		return this;
	};
	
	self.addSuccess = function(strText) {
		return self.add(strText, 'SUCESSO');
	};
	
	self.addError = function(strText) {
		return self.add(strText, 'ERRO');
	};
	
	self.addWarning = function(strText) {
		return self.add(strText, 'AVISO');
	};
	
	self.addNotice = function(strText) {
		return self.add(strText, 'NOTA');
	};
	
	self.addValidate = function(strText) {
		return self.add(strText, 'VALIDAÇÃO');
	};
	
}