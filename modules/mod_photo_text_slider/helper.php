<?php
/**
 * Photo text slider
 *
 * @package Photo text slider
 * @subpackage Photo text slider
 * @version   1.0 March, 2012
 * @author    Gopi.R
 * @copyright Copyright (C) 2010 - 2012 www.gopiplus.com, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */

// no direct access
defined('_JEXEC') or die;

class modPTS
{
	public function loadScripts(&$params)
	{
		$doc = &JFactory::getDocument();
		$doc->addScript(JURI::Root(true).'/modules/mod_photo_text_slider/script/jquery-1.3.2.min.js');
		$doc->addScript(JURI::Root(true).'/modules/mod_photo_text_slider/script/jquery.cycle.all.min.js');
		$doc->addStyleSheet(JURI::Root(true).'/modules/mod_photo_text_slider/script/mod_photo_text_slider.css');
	}
	
	public function getInformation($args)
	{
		$items	= array();
		$j = 0;
		for($i=1; $i<=8; $i++)
		{
			$pts_title = "pts_title" . $i;
			$pts_link = "pts_link" . $i;
			$pts_imge = "pts_imge" . $i;
			$pts_desc = "pts_desc" . $i;
			
			if($args[$pts_title] <> "")
			{
				$items[$j] = new stdClass;
				$items[$j]->pts_title	= $args[$pts_title];
				$items[$j]->pts_link	= $args[$pts_link];
				$items[$j]->pts_imge	= $args[$pts_imge];
				$items[$j]->pts_desc	= $args[$pts_desc];
				$j = $j+1;
			}
		}
		return $items;
    }	
}
?>