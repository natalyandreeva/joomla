<?php
/**
 * @package Joomly Contactus for Joomla! 2.5 - 3.x
 * @version 3.15
 * @author Artem Yegorov
 * @copyright (C) 2016- Artem Yegorov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/
defined('_JEXEC') or die;

class ContactusController extends JControllerLegacy
{

	public function display($cachable = false, $urlparams = false)
	{

		$document	= JFactory::getDocument();
		$vName   = $this->input->getCmd('view', 'add');
		$vFormat = $document->getType();
		$view = $this->getView($vName, $vFormat);
		$model = $this->getModel($vName);
		$view->setModel($model, true);
		$extension = 'com_contactus';
		$base_dir = JPATH_BASE."/components/com_contactus";
		$language_tag = 'ru-RU';
		JFactory::getLanguage()->load($extension, $base_dir,  $language_tag, true);	
		$view->display();
		
	}
}
