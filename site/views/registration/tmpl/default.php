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

JHtml::_('behavior.framework', true);
JHtml::_('behavior.formvalidation');
UserxtdHelper::_('include.bootstrap', true, true);
$doc = JFactory::getDocument();

// Set Script
//$doc->addScript( 	 JURI::root().'/components/com_userxtd/includes/js/formcheck/lang/en.js' );
//$doc->addScript( 	 JURI::root().'/components/com_userxtd/includes/js/formcheck/formcheck.js' );
//$doc->addStylesheet( JURI::root().'/components/com_userxtd/includes/js/formcheck/theme/classic/formcheck.css' ) ;

// Create shortcuts to some parameters.
$params		= $this->params;
$user		= JFactory::getUser();
$uri 		= JFactory::getURI() ;

$fieldsets = $this->form->getFieldsets();

//JText::script('COM_USERXTD_SCRIPT_TEST') ;
?>

<script type="text/javascript">
	// jQuery('.dropdown-toggle').dropdown();
</script>

<script type="text/javascript">
	
	window.addEvent('domready', function(){
		var v = document.formvalidator ;
		var validate = v.validate ;
		v.parentValidate = validate ;
		v.scroll = 0 ;
		v.validate = function(el) {
			var result = this.parentValidate(el) ;
			if( result == false){
				if(this.scroll == 0) {
					var sc = new Fx.Scroll(document).toElement(el);
					this.scroll = 1 ;
				}
			}
			
			return result;
		}	
		
		
		$('adminForm').addEvent('submit', function(e){
			if( !v.isValid($('adminForm')) ) {
				v.scroll = 0 ;
				e.stop();
			}
		});
	});
	
</script>

<form action="<?php echo JRoute::_('index.php?option=com_userxtd&view=registration'); ?>" method="post"
		name="adminForm" id="adminForm" class="form-horizontal" enctype="multipart/form-data">

	<div id="userxtd-wrap" class="container-fluid registration<?php echo $this->get('pageclass_sfx');?>">
		<div id="userxtd-wrap-inner">
			
			<div class="registration">
				<div class="registration-inner row-fluid">
				
				
				
				<?php foreach( $fieldsets as $fieldset ): ?>
					
					<fieldset>
						<legend>
							<?php echo JText::_($fieldset->label); ?>
						</legend>
					
						<?php
							$fields = $this->form->getFieldset($fieldset->name) ;
						?>
						
						<?php foreach( $fields as $field ): ?>
						<div class="control-group">
							<div class="control-label">
								<?php echo $field->label; ?>
							</div>
							<div class="controls">
								<?php echo $field->input; ?>
							</div>
						</div>
						<?php endforeach; ?>	
					</fieldset>
					
				<?php endforeach; ?>
				
				
				
				</div>
			</div>
			
		</div>
	</div>
	
	<div class="form-actions">
		<button type="submit" class="btn btn-primary validate">
			<?php echo JText::_('JREGISTER');?>
		</button>
		
		<a class="btn" href="<?php echo JRoute::_('');?>" title="<?php echo JText::_('JCANCEL');?>">
			<?php echo JText::_('JCANCEL');?>
		</a>
		
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="return" value="<?php echo base64_encode($uri->toString()); ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>		
