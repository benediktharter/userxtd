<?php
/**
 * @package		Asikart.Plugin
 * @subpackage	system.plg_userxtd
 * @copyright	Copyright (C) 2012 Asikart.com, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

?>
<!-- UserXTD Information Box -->
<div class="ux-user-info-warp well">
	<div class="ux-user-inner row-fluid">
		<div class="ux-user-right span3">
			<img src="<?php echo $image; ?>" alt="<?php echo $user->get($title_field); ?>" />
		</div>
		<div class="ux-user-left span8">
			<h2><?php echo $user->get($title_field); ?></h2>
			<div class="ux-user-about">
				<?php echo $user->get($about_field); ?>
			</div>
		</div>
		<div class="pull-right">
			<?php echo $link; ?>
		</div>
	</div>
</div>