<?php
/**
 * @package Joomly Contactus for Joomla! 2.5 - 3.x
 * @version 3.15
 * @author Artem Yegorov
 * @copyright (C) 2016- Artem Yegorov
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die;

require_once __DIR__ . '/helper.php';

$app  = JFactory::getApplication();
$fields = ModContactusHelper::getFields($module->id);
$contactus_params = new StdClass();
$layout = "form";	
$alert_headline_text = (!empty($fields->title_name)) ?  $fields->title_name : JText::_('MOD_CONTACTUS_TITLE_NAME_MODULE');
$alert_message_text = (!empty($fields->alertmessage)) ? $fields->alertmessage : JText::_('MOD_CONTACTUS_ALERT');
$alert_message_color = (isset($fields->color) ? $fields->color : "#21ad33");
if ($module->id == $app->getUserState('contactus.module.id'))
{
	$data = $app->getUserState('contactus.add.form.data', array());
	$app->setUserState('contactus.add.form.data', array());
	$sending_flag =  $app->getUserState('contactus.message.flag');
	$app->setUserState('contactus.module.id', "");
	$app->setUserState('contactus.message.flag', "");
} else 
{
	$sending_flag = 0;
}

$doc = JFactory::getDocument();
$doc->addStyleSheet( 'modules/mod_contactus/css/form.css' );
if ((!empty($fields->yandex_metrika_id)) || (!empty($fields->google_analytics_category)))
{
	$contactus_params->yandex_metrika_id = $fields->yandex_metrika_id; 
	$contactus_params->yandex_metrika_goal = $fields->yandex_metrika_goal;
	$contactus_params->google_analytics_category = $fields->google_analytics_category; 
	$contactus_params->google_analytics_action = $fields->google_analytics_action;
	$contactus_params->google_analytics_label = $fields->google_analytics_label;
	$contactus_params->google_analytics_value =  $fields->google_analytics_value;
}
require JModuleHelper::getLayoutPath('mod_contactus', $layout);
