<?php
/**
 * Part of joomla330 project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Userxtd\Content;

use Windwalker\DI\Container;
use Windwalker\Helper\LanguageHelper;
use Windwalker\Helper\PathHelper;
use Windwalker\Image\Thumb;
use Windwalker\System\ExtensionHelper;

/**
 * Class UserInfo
 *
 * @since 1.0
 */
class UserInfo
{
	/**
	 * createInfoBox
	 *
	 * @param Container  $container
	 * @param \stdClass  $article
	 * @param mixed      $params
	 *
	 * @return  string
	 */
	public static function createInfoBox(Container $container, $article, $params = null)
	{
		// Include Component Core
		$param = ExtensionHelper::getParams('com_userxtd');
		$doc   = \JFactory::getDocument();
		$app   = $container->get('app');

		LanguageHelper::loadLanguage('com_userxtd', 'admin');

		// init params
		$image_field 	= $param->get('UserInfo_ImageField', 'BASIC_AVATAR');
		$title_field 	= $param->get('UserInfo_TitleField', 'name');
		$about_field 	= $param->get('UserInfo_AboutField', 'BASIC_ABOUT');
		$website_field 	= $param->get('UserInfo_WebiteField', 'BASIC_WEBSITE');
		$width 			= $param->get('UserInfo_ImageWidth', 150);
		$height 		= $param->get('UserInfo_ImageHeight', 150);
		$crop 			= $param->get('UserInfo_ImageCrop', 1);
		$include_css	= $param->get('UserInfo_IncludeCSS_Article', 1);

		// Include CSS
		if($include_css)
		{
			$doc->addStyleSheet('components/com_userxtd/includes/css/userxtd-userinfo.css');
		}

		// handle params
		$user 	= \UXFactory::getUser($article->created_by);
		$image 	= $user->get($image_field);

		$thumb = new Thumb(null, 'com_userxtd');

		$image 	= $thumb->resize($image, $width, $height, $crop) ;

		$link	= \JRoute::_('index.php?option=com_userxtd&view=user&id=' . $user->get('id'));
		$link 	= \JHtml::link($link, \JText::_('COM_USERXTD_USER_INFO_MORE'));

		$website_link = $user->get($website_field) ;
		$website_link = $website_link ? \JHtml::link($website_link, \JText::_('COM_USERXTD_USER_INFO_WEBSITE')) : null;


		// Get Template override
		$tpl 	= $app->getTemplate();
		$file 	= JPATH_THEMES . "/{$tpl}/html/plg_userxtd/content/userInfo.php" ;

		if(!\JFile::exists($file))
		{
			$file = PathHelper::getSite('plg_system_userxtd') . '/lib/content/tmpl/userInfo.php' ;
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
}
 