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
defined ( '_JEXEC' ) or die ( '(@)|(@)' );
class modMailerliteHelper {
	public static function getAjax() {
		$valid = JSession::checkToken ( 'post' );
		if (! $valid) {
			die ( json_encode ( array (
					'error' => JText::_ ( 'JINVALID_TOKEN_NOTICE' ) 
			) ) );
		}
		$errors = array ();
		$app = JFactory::getApplication ();
		$data = $app->input->get ( 'data', null, 'array' );
		
		$db = JFactory::getDbo ();
		$query = $db->getQuery ( true );
		$query->select ( 'params' );
		$query->from ( '#__modules' );
		$query->where ( 'id = ' . $data ['module_id'] );
		$db->setQuery ( $query );
		$params = $db->loadResult ();
		$params = json_decode ( $params );
		
		if (empty ( $params->key )) {
			$errors [] = JText::_ ( 'MOD_MAILERLITE_KEY_NOT_SET' );
		}
		if (empty ( $params->group_id )) {
			$errors [] = JText::_ ( 'MOD_MAILERLITE_GROUP_ID_NOT_SET' );
		}
		if (empty ( $data ['email'] )) {
			$errors [] = JText::_ ( 'MOD_MAILERLITE_EMAIL_NOT_SET' );
		}
		
		if (! empty ( $errors )) {
			die ( json_encode ( array (
					'error' => implode ( '<br>', $errors ) 
			) ) );
		}
		
		require_once JPATH_LIBRARIES . '/mailerlite/vendor/autoload.php';
		$groupsApi = (new \MailerLiteApi\MailerLite ( $params->key ))->groups ();
		
		$subscriber = array ();
		$subscriber ['email'] = $data ['email'];
		if (! empty ( $data ['name'] )) {
			$subscriber ['fields'] ['name'] = $data ['name'];
		}
		$addedSubscriber = $groupsApi->addSubscriber ( $params->group_id, $subscriber );
		if (! empty ( $addedSubscriber->error )) {
			$errors [] = $addedSubscriber->error->message;
		}
		
		if (! empty ( $errors )) {
			die ( json_encode ( array (
					'error' => implode ( '<br>', $errors ) 
			) ) );
		} else {
			die ( json_encode ( array (
					'success' => JText::_ ( 'MOD_MAILERLITE_SUCCESS_ADD' ) 
			) ) );
		}
	}
}
