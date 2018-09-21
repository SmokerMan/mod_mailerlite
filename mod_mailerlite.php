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

// Include the helper functions only once
require_once dirname(__FILE__).'/helper.php';

// $list = modMailerliteHelper::getList($params);
$doc = JFactory::getDocument();
$doc->addScript('modules/mod_mailerlite/assets/script.js');
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_mailerlite', $params->get('layout', 'default'));

