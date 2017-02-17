<?php
/**
 * @package Joomly Contactus for Joomla! 2.5 - 3.x
 * @version 3.15
 * @author Artem Yegorov
 * @copyright (C) 2016- Artem Yegorov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die;

class ModContactusHelper
{
	public static function getFields($id)
	{
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('params')
			->from('#__modules')
			->where('module="mod_contactus"');
			$db->setQuery($query);
			$array =  $db->loadAssoc();
			$fields =  json_decode($array['params']); 

			return $fields;
	}
}