<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

// Module extension that has the purpose of a hook here to use the PlUploader:
$TBE_MODULES_EXT['xMOD_alt_clickmenu']['extendCMclasses'][] = array(
	'path' => PATH_tx_plupload . 'Classes/Hooks/ClickMenuHook.php',
	'name' => 'tx_plupload_ClickMenuHook',
);

// Modifications to the user settings module, allowing the accordant user
// to select one of the different upload possibilities:
$TYPO3_USER_SETTINGS['columns']['enableFlashUploader']['type'] = 'select';
$TYPO3_USER_SETTINGS['columns']['enableFlashUploader']['items'] = array(
	0 => 'LLL:EXT:plupload/Resources/Private/Language/locallang.xml:enableFlashUploader.disable',
	1 => 'LLL:EXT:plupload/Resources/Private/Language/locallang.xml:enableFlashUploader.flash',
	2 => 'LLL:EXT:plupload/Resources/Private/Language/locallang.xml:enableFlashUploader.plupload',
);
$TYPO3_USER_SETTINGS['columns']['enableFlashUploader']['label'] = 'LLL:EXT:plupload/Resources/Private/Language/locallang.xml:enableFlashUploader_label';
?>