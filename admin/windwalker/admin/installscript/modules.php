<?php
/**
 * @package     Windwalker.Framework
 * @subpackage  Install.Script
 *
 * @copyright   Copyright (C) 2012 Asikart. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Generated by AKHelper - http://asikart.com
 */

// no direct access
defined('_JEXEC') or die;

// Install modules
// ========================================================================
$modules     = $manifest->modules ;

if(!empty($modules)){
    foreach( (array)$modules as $module ):
        
        if(!trim($module)) continue ;
        
        $module = is_array($module) ? $module : array($module) ;
        
        // Install per module
        foreach( $module as $var ):
            $install_path = $path.'/../modules/'.$var ;
            
            // Do install
            $installer = new JInstaller();
            if($result[] = $installer->install($install_path)){
                $status = $tick ;
            }else{
                $status = $cross ;
            }
            
            // Set success table
            $grid->addRow(array( 'class' => 'row'.($i % 2) )) ;
            $grid->setRowCell('num', ++$i , $td_class);
            $grid->setRowCell('type', JText::_('COM_INSTALLER_TYPE_MODULE') , $td_class);
            $grid->setRowCell('name', JText::_(strtoupper($var)) , array());
            $grid->setRowCell('version', $installer->manifest->version , $td_class);
            $grid->setRowCell('state', $status , $td_class);
            $grid->setRowCell('info', JText::_($installer->manifest->description), array());
            
        endforeach;
        
    endforeach;
}
