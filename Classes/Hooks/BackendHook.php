<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Oliver Hader <oliver@typo3.org>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

class tx_plupload_BackendHook extends tx_plupload_AbstractHook implements t3lib_Singleton {
	/**
	 * @var t3lib_PageRenderer
	 */
	protected $pageRenderer;

	/**
	 * Initializes this object.
	 */
	public function __construct() {
		$this->getLanguageManager()->includeLLFile('EXT:plupload/' . self::DIR_Language . 'locallang.xml');
	}

	/**
	 * @param array $configuration
	 * @param TYPO3backend $parent
	 * @return void
	 */
	public function constructPostProcess(array $configuration, TYPO3backend $parent) {
		$parent->addJavascriptFile($this->getRelativePath(self::DIR_JavaScript) . 'helper.js');
		$parent->addJavascriptFile($this->getRelativePath(self::DIR_PlUpload) . 'js/plupload.full.min.js');
		$parent->addJavascriptFile($this->getRelativePath(self::DIR_JavaScript) . 'ext.ux.plupload.js');
		$parent->addJavascriptFile($this->getRelativePath(self::DIR_JavaScript) . 'PluploadWindow.js');
		$parent->addJavascript($this->getJavaScriptCode());
	}

	/**
	 * @return string
	 */
	protected function getJavaScriptCode() {
		$structure = array(
			'LLL' => array(
				'fileUpload' => $this->getJavaScriptLabels(),
			),
			'configuration' => array(
				'FileUpload' => array(
					'maxFileSize' => t3lib_div::getMaxUploadFileSize(),
				),
			),
		);

		$javaScriptCode = 'TYPO3.tx_plupload = ' . json_encode($structure) . ';';
		return $javaScriptCode;
	}


	/**
	 * @return array
	 */
	protected function getJavaScriptLabels() {
		$javaScriptLabels = array();

		$labelNames = array(
			'buttonStartUpload',
			'progressText',
			'infoFileQueueEmpty',
			'infoFileQueued',
			'infoFileFinished',
			'infoFileUploading',
		);

		foreach ($labelNames as $labelName) {
			$javaScriptLabels[$labelName] = $this->getLanguageManager()->getLL('fileUpload_' . $labelName);
		}

		return $javaScriptLabels;
	}

	/**
	 * @return t3lib_PageRenderer
	 */
	protected function getPageRenderer() {
		if (!isset($this->pageRenderer)) {
			$this->pageRenderer = $GLOBALS['TBE_TEMPLATE']->getPageRenderer();
		}

		return $this->pageRenderer;
	}
}
