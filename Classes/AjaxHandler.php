<?php
/**
 * Created by JetBrains PhpStorm.
 * User: olly
 * Date: 11.03.11
 * Time: 11:49
 * To change this template use File | Settings | File Templates.
 */

require_once PATH_typo3 . 'classes/class.typo3_tcefile.php';

class tx_plupload_AjaxHandler extends TYPO3_tcefile {
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
		$this->init();
		$this->main();
		$errors = $this->fileProcessor->getErrorMessages();

		if (count($errors)) {
			$ajaxObj->setError(implode(',', $errors));
		} else {
			$ajaxObj->addContent('result', $this->fileData);
			$ajaxObj->addContent('success', !empty($this->fileData));
			$ajaxObj->setContentFormat('json');
		}
	}
}
