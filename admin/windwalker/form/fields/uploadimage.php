<?php
/**
 * @package     Windwalker.Framework
 * @subpackage  class
 *
 * @copyright   Copyright (C) 2012 Asikart. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Generated by AKHelper - http://asikart.com
 */

// no direct access
defined('_JEXEC') or die;


/**
 * Upload Image
 */
class JFormFieldUploadimage extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	public $type = 'Uploadimage';
	
	 /**
     * Method to get the field input markup for the file field.
     * Field attributes allow specification of a maximum file size and a string
     * of accepted file extensions.
     *
     * @return  string  The field input markup.
     *
     * @since   11.1
     *
     * @note    The field does not include an upload mechanism.
     * @see     JFormFieldMedia
     */
    protected function getInput()
    {
        // Initialize some field attributes.
        $accept = $this->element['accept'] ? ' accept="' . (string) $this->element['accept'] . '"' : '';
        $size 	= $this->element['size'] ? ' size="' . (int) $this->element['size'] . '"' : '';
        $class 	= $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';
        $disabled = ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$readonly = (string) $this->element['readonly'] ;
		$value	= $this->value ;
		
        // Initialize JavaScript field attributes.
        $onchange = $this->element['onchange'] ? ' onchange="' . (string) $this->element['onchange'] . '"' : '';
		
		if($readonly != 'false' && $readonly) {
			return JHtml::image($this->value, $this->name);
		}else{
			return '<input type="file" name="' . $this->name . '" id="' . $this->id . '"' . ' value=""' . $accept . $disabled . $class . $size
				. $onchange . ' />';
		}
		
    }
	
	
	/*
	 * function showImage
	 * @param 
	 */
	
	public static function showImage($value)
	{
		return JHtml::image( $value, 'image' );
	}
}