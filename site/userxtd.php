<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_userxtd
 *
 * @copyright   Copyright (C) 2012 Asikart. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Generated by AKHelper - http://asikart.com
 */

// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_userxtd')) {
	//return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// include helper
include_once JPATH_COMPONENT_ADMINISTRATOR.'/includes/init.php' ;

// Include dependancies
jimport('joomla.application.component.controller');

$controller	= JControllerLegacy::getInstance('Userxtd');
$controller->execute( JFactory::getApplication()->input->get('task') );
$controller->redirect();
