<?php
/**
 * @package Joomly Contactus for Joomla! 2.5 - 3.x
 * @version 3.15
 * @author Artem Yegorov
 * @copyright (C) 2016- Artem Yegorov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class ContactusModelAdd extends JModelLegacy
{	
	
	function sendMessage($data){
		
		$params = $this->getParams($data['module_id']);
		
		$mailer = JFactory::getMailer();
		
		if (!empty($data["email"]))
		{
			$mailer->addReplyTo($data["email"]);
		}
		
		$config = JFactory::getConfig();
		$sender = array( 
		    $config->get( 'mailfrom' ),
		    $config->get( 'fromname' ) 
		);
		 
		$mailer->setSender($sender);

		$mail = $this->getRecipient($params->admin_mail);
		$mailer->addRecipient($mail);
		
		$subject = $this->getSubject($data["title"]);
		$mailer->setSubject($subject);
		
		$body = $this->getBody($data);
		$mailer->setBody($body);
		
		$mailer->IsHTML(true);
		$mailer->Send();
	
	}
	
	function getParams($module_id){
		$query = $this->_db->getQuery(true);
		if ($module_id > 0)
		{	
			$query->select('params')
			->from('#__modules')
			->where("module='mod_contactus' AND id={$module_id}");
		} else {
			$query->select('params')
			->from('#__modules')
			->where('module="mod_contactus"');
		}	
		$this->_db->setQuery($query);
		$array =  $this->_db->loadAssoc();
		$parameters =  json_decode($array['params']); 
		return $parameters;
	}

	function getRecipient($admin_mail){
		$mail = explode(",",$admin_mail);
		if (empty($mail[0])){
			$config = JFactory::getConfig();
			$mail = $config->get('mailfrom');
		}

		return $mail;
	}
	
	function getSubject($title){
		$subject = $title;
		if ($subject == null){
			$subject = JText::_('COM_CONTACTUS_NEW_FEEDBACK');
		}
		return $subject;
	}
	
	function getBody($data){

		if (isset($data["created_at"])){ 
			$body = '<br><b>'.JText::_('COM_CONTACTUS_CREATED_AT').'</b>: '.$data["created_at"];
		}	
		if (!empty($data["name"])){ 
			$body = $body.'<br><b>'.JText::_('COM_CONTACTUS_NAME').'</b>: '.$data["name"];
		}
		if (!empty($data["email"])){ 
			$body = $body.'<br><b>'.JText::_('COM_CONTACTUS_EMAIL').'</b>: '.$data["email"];
		}
		if (!empty($data["phone"])){ 
			$body = $body.'<br><b>'.JText::_('COM_CONTACTUS_PHONE').'</b>: '.$data["phone"];
		}
		if (!empty($data["subject"])){ 
			$body = $body.'<br><b>'.JText::_('COM_CONTACTUS_SUBJECT').'</b>: '.$data["subject"];
		}
		if (!empty($data["message"])){ 
			$body = $body.'<br><b>'.JText::_('COM_CONTACTUS_MESSAGE').'</b>: '.$data["message"];
		}
		if (isset($data['page'])){ 
			$body = $body.'<br><b>'.JText::_('COM_CONTACTUS_PAGE').'</b>: '.$data['page'];
		}
		if (isset($data['ip'])){ 
			$body = $body.'<br><b>'.JText::_('COM_CONTACTUS_IP').'</b>: '.$data['ip'];
		}

		return $body;
	}
}
