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

// Include the syndicate functions only once
require_once(dirname(__FILE__).DS.'helper.php');

@$args['pts_direction'] = $params->get('pts_direction');
@$args['pts_speed'] = $params->get('pts_speed');
@$args['pts_timeout'] = $params->get('pts_timeout');
@$args['pts_name'] = $params->get('pts_name');

for($i=1; $i<=8; $i++)
{
	$pts_title = "pts_title" . $i;
	$pts_link = "pts_link" . $i;
	$pts_imge = "pts_imge" . $i;
	$pts_desc = "pts_desc" . $i;
	
	$args[$pts_title] = $params->get($pts_title);
	$args[$pts_link] = $params->get($pts_link);
	$args[$pts_imge] = $params->get($pts_imge);
	$args[$pts_desc] = $params->get($pts_desc);
}
$items = modPTS::getInformation($args);
modPTS::loadScripts($params);
require JModuleHelper::getLayoutPath('mod_photo_text_slider', $params->get('layout', 'default'));
?>