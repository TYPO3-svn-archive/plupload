<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

define('PATH_tx_plupload', t3lib_extMgm::extPath('plupload'));

// XLCASS to modify the AJAX response:
#$TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['typo3/classes/class.typo3_tcefile.php'] =
#	PATH_tx_plupload . 'Classes/XClass/TYPO3_tcefile.php';

// Hooks to use the PlUploader if enables in the user settings:
$TYPO3_CONF_VARS['SC_OPTIONS']['typo3/backend.php']['constructPostProcess'][] =
	'EXT:plupload/Classes/Hooks/BackendHook.php:tx_plupload_BackendHook->constructPostProcess';
$TYPO3_CONF_VARS['SC_OPTIONS']['typo3/template.php']['preStartPageHook'][] =
	'EXT:plupload/Classes/Hooks/TemplateHook.php:tx_plupload_TemplateHook->preStartPageHook';

// Defines the AJAX endpoint handler:
$TYPO3_CONF_VARS['BE']['AJAX']['tx_plupload_AjaxHandler::process']
	= 'EXT:plupload/Classes/AjaxHandler.php:tx_plupload_AjaxHandler->processAjaxRequest';
?>