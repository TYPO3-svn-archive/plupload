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

class ux_TYPO3_tcefile extends TYPO3_tcefile {
	/**
	 * Handles the actual process from within the ajaxExec function
	 * therefore, it does exactly the same as the real typo3/tce_file.php
	 * but without calling the "finish" method, thus makes it simpler to deal with the
	 * actual return value
	 *
	 *
	 * @param string $params 	always empty.
	 * @param string $ajaxObj	The Ajax object used to return content and set content types
	 * @return void
	 */
	public function processAjaxRequest(array $params, TYPO3AJAX $ajaxObj) {
		parent::processAjaxRequest($params, $ajaxObj);
		$uploaderType = t3lib_div::_GP('uploaderType');

		if ($uploaderType === 'plupload') {
			$ajaxObj->setContent(NULL);
			$ajaxObj->addContent('result', $this->fileData);
			$ajaxObj->addContent('success', !empty($this->fileData));
		}
	}
}
