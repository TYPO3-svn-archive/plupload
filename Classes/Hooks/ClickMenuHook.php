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

class tx_plupload_ClickMenuHook extends tx_plupload_AbstractHook implements t3lib_Singleton {
	/**
	 * @param clickMenu $parent
	 * @param array $menuItems
	 * @param string $path
	 * @return array
	 */
	public function main(clickMenu $parent, array $menuItems, $path) {
		if (!$parent->isDBmenu && $this->getBackendUser()->uc['enableFlashUploader'] == 2) {
			$type = 'upload';
			$image = 'upload.gif';

			$editOnClick = 'top.TYPO3.configuration.FileUpload.targetDirectory = "' . $path . '"; top.TYPO3.PluploadWindow.reloadWindow = top.content.list_frame; top.TYPO3.PluploadWindow.show();';
			$menuItems['upload'] = $parent->linkItem(
				$parent->label($type),
				$parent->excludeIcon('<img' . t3lib_iconWorks::skinImg($parent->PH_backPath, 'gfx/' . $image, 'width="12" height="12"') . ' alt="" />'),
				$editOnClick . 'return hideCM();'
			);
		}

		return $menuItems;
	}
}
