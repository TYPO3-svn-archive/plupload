Ext.onReady(function() {
	Ext.iterate(TYPO3.tx_plupload.LLL.fileUpload, function(key, value) {
		TYPO3.LLL.fileUpload[key] = value;
	});
	Ext.iterate(TYPO3.tx_plupload.configuration, function(key, value) {
		TYPO3.configuration[key] = value;
	});
});
