<?php
/**
 * @package		Asikart.Plugin
 * @subpackage	system.plg_userxtd
 * @copyright	Copyright (C) 2012 Asikart.com, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

function userInfo($context, $article, $params)
{
	// Detect Context
	if( $context != 'com_content.article' ) return ;
	
	include_once JPATH_ADMINISTRATOR.'/components/com_userxtd/includes/core.php' ;
	$ux 	= plgSystemUserxtd::getInstance();
	$param 	= $ux->params ;
	$app 	= JFactory::getApplication() ;
	
	// init params
	$image_field 	= $param->get('UserInfo_ImageField', 'BASIC_AVATAR');
	$title_field 	= $param->get('UserInfo_TitleField', 'name');
	$about_field 	= $param->get('UserInfo_AboutField', 'BASIC_ABOUT');
	$website_field 	= $param->get('UserInfo_WebiteField', 'BASIC_WEBSITE');
	$width 			= $param->get('UserInfo_ImageWidth', 150);
	$height 		= $param->get('UserInfo_ImageHeight', 150);
	$crop 			= $param->get('UserInfo_ImageCrop', 1);
	
	
	// handle params
	$user 	= UXFactory::getUser($article->created_by);
	$image 	= $user->get($image_field) ;
	$image 	= AKHelper::_('thumb.resize', $image, $width, $height, $crop) ;
	
	$link	= JRoute::_('index.php?option=com_userxtd&view=user&id='.$user->get('id'));
	$link 	= JHtml::link($link, JText::_('COM_USERXTD_USER_INFO_MORE'));
	
	
	// Get Template override
	$tpl 	= $app->getTemplate();
	$file 	= JPATH_THEMES."/{$tpl}/html/plg_userxtd/content/userInfo.php" ;
	
	if(!JFile::exists($file)) {
		$file = dirname(__FILE__).'/tmpl/userInfo.php' ;
	}
	
	
	// Start capturing output into a buffer
	ob_start();
	// Include the requested template filename in the local scope
	include $file;

	// Done with the requested template; get the buffer and clear it.
	$html = ob_get_contents();
	ob_end_clean();
	
	return $html;
}