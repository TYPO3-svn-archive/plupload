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
 
abstract class tx_plupload_AbstractHook {
	const DIR_JavaScript = 'Resources/Public/JavaScript/';
	const DIR_StyleSheet = 'Resources/Public/StyleSheet/';
	const DIR_PlUpload = 'Resources/Public/External/plupload/';
	const DIR_Language = 'Resources/Private/Language/';

	/**
	 * @var string
	 */
	protected $relativePath;

	/**
	 * @return language
	 */
	protected function getLanguageManager() {
		return $GLOBALS['LANG'];
	}

	/**
	 * @return t3lib_beUserAuth
	 */
	protected function getBackendUser() {
		return $GLOBALS['BE_USER'];
	}

	/**
	 * @return mixed
	 */
	protected function getCurrentBackendModule() {
		$currentBackendModule = NULL;

		if (isset($GLOBALS['SOBE'])) {
			$currentBackendModule = $GLOBALS['SOBE'];
		}

		return $currentBackendModule;
	}

	/**
	 * @return string
	 */
	protected function getRelativePath($directory = '', $backPath = '') {
		if (!isset($this->relativePath)) {
			$this->relativePath = t3lib_extMgm::extRelPath('plupload');
		}

		return $backPath . $this->relativePath . $directory;
	}
}
