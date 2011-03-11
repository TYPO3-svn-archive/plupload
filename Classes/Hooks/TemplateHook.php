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
 
class tx_plupload_TemplateHook extends tx_plupload_AbstractHook implements t3lib_Singleton {
	/**
	 * @param array $configuration
	 * @param template $parent
	 * @return void
	 */
	public function preStartPageHook(array $configuration, template $parent) {
		if ($this->isExecutionRequired($parent)) {
			$parent->JScodeArray['flashUploader'] = '
				Ext.onReady(function() {
					// monitor the button
					$("button-upload").observe("click", function(event) {
						event.stop();
						top.TYPO3.configuration.FileUpload.targetDirectory = "' . $this->getCurrentBackendModule()->id . '";
						// set window object to reload on finish.
						top.TYPO3.PluploadWindow.reloadWindow = window;
						top.TYPO3.PluploadWindow.show();
					});
				});
			';
		}
	}

	/**
	 * Determines whether an execution of this hook is required.
	 *
	 * @param template $parent
	 * @return boolean
	 */
	protected function isExecutionRequired(template $parent) {
		$currentBackendModule = $this->getCurrentBackendModule();

		return (
			is_null($currentBackendModule) === FALSE && $currentBackendModule instanceof SC_file_list
			&& $this->getBackendUser()->uc['enableFlashUploader'] == 2
			&& isset($parent->JScodeArray['flashUploader'])
		);
	}
}
