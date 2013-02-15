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


include_once AKPATH_COMPONENT.'/controllerform.php' ;

/**
 * Profile controller class.
 */
class UserxtdControllerProfile extends AKControllerForm
{
	
	public $view_list = 'profiles' ;
	public $view_item = 'profile' ;
	public $component = 'userxtd';

	
	/**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     JController
     * @since   11.1
     */
	
    function __construct() {
		
		$this->allow_url_params = array(
			'return'
		);
		
		$this->redirect_tasks = array(
			'save', 'cancel', 'publish', 'unpublish', 'delete'
		);
		
        parent::__construct();
    }

	
	
	/**
     * Function that allows child controller access to model data
     * after the data has been saved.
     *
     * @param   JModel  &$model     The data model object.
     * @param   array   $validData  The validated data.
     *
     * @return  void 
     *
     * @since   11.1
     */
	
	protected function postSaveHook( &$model, $validData = array())
    {
		
    }
	
}