<?php
/**
 * Part of joomla330 project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Class UserxtdControllerUserEditSave
 *
 * @since 1.0
 */
class UserxtdControllerUserEditEdit extends \Windwalker\Controller\Edit\EditController
{
	/**
	 * redirectToItem
	 *
	 * @param null   $recordId
	 * @param string $urlVar
	 * @param null   $msg
	 * @param string $type
	 *
	 * @return  void
	 */
	public function redirectToItem($recordId = null, $urlVar = 'id', $msg = null, $type = 'message')
	{
		$this->redirect(
			\Windwalker\Router\Route::_('com_userxtd.user_layout', array('id' => $recordId, 'layout' => 'edit'))
		);
	}
}
 