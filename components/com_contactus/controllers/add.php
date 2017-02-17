<?php
/**
 * @package Joomly Contactus for Joomla! 2.5 - 3.x
 * @version 3.15
 * @author Artem Yegorov
 * @copyright (C) 2016- Artem Yegorov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

class ContactusControllerAdd extends ContactusController
{
	
	public function save()
	{	
		$url = JFactory::getURI();
		$app    = JFactory::getApplication();
		$input  = $app->input;
		$method = $input->getMethod();
		
		$data = array();
		$data = $app->input->post->getArray($_POST);

		$mod = 	($data['module_id']!==null) ? $data['module_id'] : 0;
		
		JTable::addIncludePath(JPATH_COMPONENT.'/tables/');
		$row = JTable::getInstance('contactus', 'Table');
		$data["created_at"] = date('Y-m-d H:i:s');

		if (!$row->bind($data)){
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}
		
		if (!$row->store()){
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$model= $this->getModel('add');
		$model->sendMessage($data);

		$app->setUserState( "contactus.module.id", $mod );
		$app->setUserState( "contactus.message.flag", 1 );

		$app-> redirect($url);
		
	}
}
