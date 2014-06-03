<?php
/**
 * Part of Component Userxtd files.
 *
 * @copyright   Copyright (C) 2014 Asikart. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Userxtd\Router\Route;
use Joomla\Registry\Registry;
use Windwalker\Data\Data;
use Windwalker\Helper\DateHelper;
use Windwalker\View\Html\ItemHtmlView;

// No direct access
defined('_JEXEC') or die;

/**
 * Userxtd Users view
 *
 * @since 1.0
 */
class UserxtdViewRegistrationHtml extends ItemHtmlView
{
	/**
	 * The component prefix.
	 *
	 * @var  string
	 */
	protected $prefix = 'userxtd';

	/**
	 * The component option name.
	 *
	 * @var string
	 */
	protected $option = 'com_userxtd';

	/**
	 * The text prefix for translate.
	 *
	 * @var  string
	 */
	protected $textPrefix = 'COM_USERXTD';

	/**
	 * The item name.
	 *
	 * @var  string
	 */
	protected $name = 'registration';

	/**
	 * The item name.
	 *
	 * @var  string
	 */
	protected $viewItem = 'registration';

	/**
	 * The list name.
	 *
	 * @var  string
	 */
	protected $viewList = 'registrations';

	/**
	 * prepareRender
	 *
	 * @return  void
	 */
	protected function prepareRender()
	{
		parent::prepareRender();
	}

	/**
	 * Prepare data hook.
	 *
	 * @return  void
	 */
	protected function prepareData()
	{
		$app  = JFactory::getApplication();
		$data = $this->getData();
		$data->form = $this->get('Form');
		$user = $this->container->get('user');

		$data->params = JComponentHelper::getParams('com_users');

		if(!$data->params->get('allowUserRegistration', 1))
		{
			$app->redirect(JRoute::_('index.php?option=com_users&view=login'));

			return;
		}

		$data->canDo = UserxtdHelper::getActions();
	}
}
