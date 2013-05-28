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

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
UserxtdHelper::_('include.core');


$app = JFactory::getApplication() ;
if( JVERSION >= 3){
	JHtml::_('formbehavior.chosen', 'select');
	
	if($app->isSite()){
		UserxtdHelper::_('include.fixBootstrapToJoomla');
	}
}else{
	// UserxtdHelper::_('include.bootstrap');
	// UserxtdHelper::_('include.fixBootstrapToJoomla');
}



// Init some API objects
// ================================================================================
$date 	= JFactory::getDate( 'now' , JFactory::getConfig()->get('offset') ) ;
$doc 	= JFactory::getDocument() ;
$uri 	= JFactory::getURI() ;
$user	= JFactory::getUser() ;



// For Site
// ================================================================================
if($app->isSite()) {
	UserxtdHelper::_('include.isis');
}



// Edit setting
// ================================================================================
$tabs = count( $this->fields ) > 1 ? true : false;

if($app->isAdmin()) {
	$span_left 	= 8 ;
	$span_right = 4 ;
	
	$width_left = 60 ;
	$width_right= 40 ;
}else{
	$span_left 	= 12 ;
	$span_right = 12 ;
	
	$width_left = 100 ;
	$width_right= 100 ;
}

?>
<script type="text/javascript">
	<?php if( $app->isSite() ): ?>
	WindWalker.fixToolbar(0, 300) ;
	<?php endif; ?>
	
	Joomla.submitbutton = function(task)
	{
		if (task == 'user.cancel' || document.formvalidator.isValid(document.id('user-form'))) {
			Joomla.submitform(task, document.getElementById('user-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
	
	window.addEvent('domready', function(){
		$$('#toolbar-apply a').addClass('btn btn-primary');
	});
</script>

<form action="<?php echo JRoute::_( JFactory::getURI()->toString() ); ?>" method="post"
	name="adminForm" id="user-form" class="profile-edit form-validate form-horizontal" enctype="multipart/form-data">
	
	<div id="member-profile">
		<?php foreach ($this->form->getFieldsets() as $group => $fieldset):// Iterate through the form fieldsets and display each one.?>
			<?php $fields = $this->form->getFieldset($group);?>
			<?php if (count($fields)):?>
			<fieldset>
				<?php if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.?>
				<legend><?php echo JText::_($fieldset->label); ?></legend>
				<?php endif;?>
				
				<dl>
				<?php foreach ($fields as $field):// Iterate through the fields in the set and display them.?>
					<?php if ($field->hidden):// If the field is hidden, just display the input.?>
						<dd class="control-group">
							<div class="controls">
								<?php echo $field->input;?>
							</div>
						</dd>
					<?php else:?>
						<div class="">
							<dt class="">
								<?php echo $field->label; ?>
								<?php if (!$field->required && $field->type != 'Spacer') : ?>
								<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
								<?php endif; ?>
							</dt>
							<dd class="">
								<?php echo $field->input; ?>
							</dd>
						</div>
					<?php endif;?>
				<?php endforeach;?>
				</dl>
			</fieldset>
			<?php endif;?>
		<?php endforeach;?>
		
		
		
		<?php if( JVERSION < 3 ): ?>
		<div class="form-actions">
			<a type="submit" class="btn btn-primary" onclick="Joomla.submitbutton('user.save')">
				<?php echo JText::_('JTOOLBAR_SAVE');?>
			</a>
			
			<a class="btn button" href="#" title="<?php echo JText::_('JCANCEL');?>" onclick="Joomla.submitbutton('user.cancel')">
				<?php echo JText::_('JCANCEL');?>
			</a>
		</div>
		<?php endif; ?>	
	</div>
	
	<!-- Hidden Inputs -->
	<div id="hidden-inputs">
		<input type="hidden" name="return" value="<?php echo JRequest::getVar('return') ; ?>" />
		<input type="hidden" name="jform[id]" value="<?php echo $this->state->get('user.id');?>" />
		<input type="hidden" name="option" value="com_userxtd" />
		<input type="hidden" name="task" value="user.save" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<div class="clr"></div>
</form>