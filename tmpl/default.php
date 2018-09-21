<?php
/**
 * Mailerlite
 * 
 * @version 	1.0	
 * @author		SmokerMan
 * @copyright	© 2018 All rights reserved. 
 * @license 	GNU/GPL v.3 or later.
 */

// No direct access.
defined('_JEXEC') or die('(@)|(@)');

?>
<form class="mailerlite-form" action="<?php echo JRoute::_('index.php?option=com_ajax&module=mailerlite&format=json')?>">
	<span class="name">
		<input type="text" name="data[name]" placeholder="<?php echo JText::_('MOD_MAILERLITE_NAME'); ?>" />
	</span>
	<span class="email">
		<input type="email" required="required" name="data[email]" placeholder="<?php echo JText::_('MOD_MAILERLITE_EMAIL'); ?>" value="test@test.ru" />
	</span>
		
	<button class="button" type="submit">
		<span>Подписаться</span>
	</button>
	<input type="hidden" name="data[module_id]" value="<?php echo $module->id; ?>" />
	<?php echo JHtml::_('form.token'); ?>
</form>
