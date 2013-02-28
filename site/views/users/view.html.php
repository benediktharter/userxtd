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

include_once AKPATH_COMPONENT.'/viewlist.php' ;

/**
 * View class for a list of Userxtd.
 */
class UserxtdViewUsers extends AKViewList
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected 	$text_prefix = 'COM_USERXTD';
	protected 	$items;
	protected 	$pagination;
	protected 	$state;
	
	public		$option 	= 'com_userxtd' ;
	public		$list_name 	= 'users' ;
	public		$item_name 	= 'user' ;
	public		$sort_fields ;
	
	public		$lead_items ;
	public		$intro_items ;
	public		$link_items ;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$app = JFactory::getApplication() ;
		
		$this->state		= $this->get('State');
		$this->params		= $this->state->get('params');
		$this->category		= $this->get('Category');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->filter		= $this->get('Filter');

		
		
		// Check for errors.
		// =====================================================================================
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		
		
		// Set Data
		// =====================================================================================
		foreach( $this->items as &$item ):
			$item->link = JRoute::_("index.php?option=com_userxtd&view=user&id={$item->a_id}&alias={$item->a_alias}&catid={$item->a_catid}");
			
			
			// Publish Date
			// =====================================================================================
			$pup = JFactory::getDate( $item->a_publish_up , JFactory::getConfig()->get('offset') )->toUnix(true) ;
			$pdw = JFactory::getDate( $item->a_publish_down , JFactory::getConfig()->get('offset') )->toUnix(true) ;
			$now = JFactory::getDate( 'now' , JFactory::getConfig()->get('offset') )->toUnix(true) ;
			$null= JFactory::getDate( '0000-00-00 00:00:00' , JFactory::getConfig()->get('offset') )->toUnix(true) ;
			
			if( ($now < $pup && $pup != $null)  || ( $now > $pdw && $pdw != $null ) ) {
				$item->a_published = 0 ;
			}
			
			if($item->a_modified == '0000-00-00 00:00:00') {
				$item->a_modified = '' ;
			}
			
			
			// Plugins
			// =====================================================================================
			$item->event = new stdClass();

			$dispatcher = JDispatcher::getInstance();
			$item->text = $item->a_introtext ;
			$results = $dispatcher->trigger('onContentPrepare', array ('com_userxtd.user', &$item, &$this->params, 0));

			$results = $dispatcher->trigger('onContentAfterTitle', array('com_userxtd.user', &$item, &$item->params, 0));
			$item->event->afterDisplayTitle = trim(implode("\n", $results));

			$results = $dispatcher->trigger('onContentBeforeDisplay', array('com_userxtd.user', &$item, &$item->params, 0));
			$item->event->beforeDisplayContent = trim(implode("\n", $results));

			$results = $dispatcher->trigger('onContentAfterDisplay', array('com_userxtd.user', &$item, &$item->params, 0));
			$item->event->afterDisplayContent = trim(implode("\n", $results));
		
		endforeach;
		
		
		
		// Params
		// =====================================================================================
		$registry = new JRegistry ;
		$registry->loadString($this->category->params) ;
		$this->category->params = $registry ;
		
		
		
		// Count Leading, Items & Links Number
		// =====================================================================================
		$numLeading	= $this->params->def('num_leading_articles', $this->state->get('list.num_leading'));
		$numIntro	= $this->params->def('num_intro_articles', $this->state->get('list.num_intro'));
		$numLinks	= $this->params->def('num_links', $this->state->get('list.num_links'));
		
		
		// For blog layouts, preprocess the breakdown of leading, intro and linked articles.
		// This makes it much easier for the designer to just interrogate the arrays.
		$max = count($this->items);

		// The first group is the leading articles.
		$limit = $numLeading;
		for ($i = 0; $i < $limit && $i < $max; $i++) {
			$this->lead_items[$i] = &$this->items[$i];
		}

		// The second group is the intro articles.
		$limit = $numLeading + $numIntro;
		// Order articles across, then down (or single column mode)
		for ($i = $numLeading; $i < $limit && $i < $max; $i++) {
			$this->intro_items[$i] = &$this->items[$i];
		}

		$this->columns = max(1, $this->params->def('num_columns', 2));
		$order = $this->params->def('multi_column_order', 1);

		$limit = $numLeading + $numIntro + $numLinks;
		// The remainder are the links.
		for ($i = $numLeading + $numIntro; $i < $limit && $i < $max;$i++)
		{
				$this->link_items[$i] = &$this->items[$i];
		}
		
		
		parent::display($tpl);
	}
	
}