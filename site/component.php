<?php
/**
 * Part of Component Userxtd files.
 *
 * @copyright   Copyright (C) 2014 Asikart. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Userxtd Component
 *
 * @since 1.0
 */
final class UserxtdComponent extends \Userxtd\Component\UserxtdComponent
{
	/**
	 * Default task name.
	 *
	 * @var string
	 */
	protected $defaultController = 'users.display';

	/**
	 * Prepare hook of this component.
	 *
	 * Do some customize initialise through extending this method.
	 *
	 * @return void
	 */
	protected function prepare()
	{
		parent::prepare();

		\Windwalker\Helper\LanguageHelper::loadLanguage('com_users', 'site');
		\Windwalker\Helper\LanguageHelper::loadLanguage('com_users', 'admin');

		// Load admin language
		$lang = JFactory::getLanguage();
		$lang->load('', JPATH_ADMINISTRATOR);

		$asset = $this->container->get('helper.asset');
		$asset->addCss('userxtd-component.css')
			->addCss('main.css');
	}
}
