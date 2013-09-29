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

include_once AKPATH_COMPONENT.'/modellist.php' ;

/**
 * Methods supporting a list of Userxtd records.
 */
class UserxtdModelProfiles extends AKModelList
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected 	$text_prefix = 'COM_USERXTD';

	public 		$component = 'userxtd' ;
	public 		$item_name = 'profile' ;
	public 		$list_name = 'profiles' ;

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    1.6
     */
    public function __construct($config = array())
    {
		// Set query tables
		// ========================================================================
		$config['tables'] = array(
			'a' => '#__userxtd_profiles',
			'b' => '#__userxtd_fields',
			'c' => '#__categories',
			'd' => '#__users',
		);

		// Set filter fields
		// ========================================================================
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'filter_order_Dir', 'filter_order'
            );

            $config['filter_fields'] = UserxtdHelper::_('db.mergeFilterFields', $config['filter_fields'] , $config['tables'] );
        }

		// Other settings
		// ========================================================================
		$config['fulltext_search'] 	= false ;
		$config['core_sidebar'] 	= false ;
		$this->config = $config ;

        parent::__construct($config);
    }

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState('d.id', $direction);
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 * @return	string		A store id.
	 * @since	1.6
	 */
	protected function getStoreId($id = '')
	{
		return parent::getStoreId($id);
	}

	/**
	 * Method to get list page filter form.
	 *
	 * @return	object		JForm object.
	 * @since	2.5
	 */
	public function getFilter()
	{
		$filter = parent::getFilter();

		return $filter ;
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	protected function getListQuery()
	{
		// Get some data
		// ========================================================================

		// Create a new query object.
		$db		= $this->getDbo();
		$q		= $db->getQuery(true);
		$order 	= $this->getState('list.ordering' , 'a.id');
		$dir	= $this->getState('list.direction', 'asc');

		// Filter and Search
		$filter = $this->getState('filter',array()) ;
		$search = $this->getState('search') ;
		$layout = JRequest::getVar('layout') ;
		$avoid	= JRequest::getVar('avoid') ;
		$show_root = JRequest::getVar('show_root') ;

		// Search
		// ========================================================================
		if(!empty($search['index'])){

			if($this->getState( 'search.fulltext' )){

				$fields = $this->getFullSearchFields();

				foreach( $fields as &$field ):
					$field = "{$field} LIKE '%{$search['index']}%'" ;
				endforeach;

				if(count($fields))
				$q->where( "( ".implode(' OR ', $fields )." )" );

			}else{

				$q->where("{$search['field']} LIKE '%{$search['index']}%'");

			}

		}

		// Filter
		// ========================================================================
		foreach($filter as $k => $v ){
			if($v !== '' && $v != '*'){
				$q->where("{$k}='{$v}'") ;
			}
		}


		// Build query
		// ========================================================================

		// get select columns
		$select = UserxtdHelper::_( 'db.getSelectList', $this->config['tables'] );

		//build query
		$q->select($select)
			->from('#__userxtd_profiles AS a')
			->leftJoin('#__userxtd_fields 	AS b ON a.key = b.name')
			->leftJoin('#__categories 	AS c ON b.catid = c.id')
			->leftJoin('#__users 		AS d ON a.user_id = d.id')
			//->leftJoin('#__languages 	AS e ON a.language = e.lang_code')
			//->where("")
			->order( "{$order} {$dir}" )
            ;
        
		return $q;
	}
}


