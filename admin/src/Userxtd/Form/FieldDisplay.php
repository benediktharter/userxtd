<?php
/**
 * Part of joomla330 project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Userxtd\Form;

/**
 * Class FieldDisplay
 *
 * @since 1.0
 */
class FieldDisplay
{
	/**
	 * showImage
	 *
	 * @param mixed $value
	 *
	 * @return  string
	 */
	public static function showImage($value)
	{
		if($value)
		{
			$thumb = new \Windwalker\Image\Thumb(null, 'com_userxtd');

			$value = $thumb->resize($value, 300, 300, \JImage::CROP_RESIZE);

			return \JHtml::image($value, 'UserXTD image');
		}

		return '';
	}
}
 