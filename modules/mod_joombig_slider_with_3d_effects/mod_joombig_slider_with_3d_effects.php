<?php

/*------------------------------------------------------------------------
# "Joombig slider with 3d effects" Module
# Copyright (C) 2013 All rights reserved by joombig.com
# License: GNU General Public License version 2 or later; see LICENSE.txt
# Author: joombig.com
# Website: http://www.joombig.com
-------------------------------------------------------------------------*/

//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// Path assignments
$mosConfig_absolute_path = JPATH_SITE;
$mosConfig_live_site = JURI :: base();
if(substr($mosConfig_live_site, -1)=="/") { $mosConfig_live_site = substr($mosConfig_live_site, 0, -1); }

// get parameters from the module's configuration

$borderWidth = $params->get('borderWidth','0');

$tabNumber = 10;
$enable_jQuery = $params->get('enable_jQuery',1);
$modulewidth = $params->get('modulewidth','990');
$moduleheight = $params->get('moduleheight','504');

$imageWidth = $params->get('imageWidth','360');
$imageHeight = $params->get('imageHeight','360');
$autoplay = $params->get('autoplay',1);
$animationspeed = $params->get('animationspeed','3500');

$title_size = $params->get('title_size','40');
$des_size = $params->get('des_size','20');
$show_button = $params->get('show_button','1');


for ($loop = 1; $loop <= 10; $loop += 1) {
$title[$loop] = $params->get('title'.$loop,'joombig');
}

for ($loop = 1; $loop <= 10; $loop += 1) {
$readmorelink[$loop] = $params->get('readmorelink'.$loop,'http://joombig.com');
}

for ($loop = 1; $loop <= 10; $loop += 1) {
$readmoretext[$loop] = $params->get('readmoretext'.$loop,'Read more');
}

for ($loop = 1; $loop <= 10; $loop += 1) {
$info[$loop] = $params->get('info'.$loop,'banner images slider joombig.com.');
}

for ($loop = 1; $loop <= 10; $loop += 1) {
$image[$loop] = $params->get('image'.$loop,'image'.$loop.'joombig.jpg');
}

$imageBackground1 = $params->get('imageBackground1','E3D8FF');
$imageBackground2 = $params->get('imageBackground2','EBBBBC');
$imageBackground3 = $params->get('imageBackground3','EED9C0');
$imageBackground4 = $params->get('imageBackground4','DFEBB1');
$imageBackground5 = $params->get('imageBackground5','C1E6E5');

$imageBackground6 = $params->get('imageBackground6','E3D8FF');
$imageBackground7 = $params->get('imageBackground7','EBBBBC');
$imageBackground8 = $params->get('imageBackground8','EED9C0');
$imageBackground9 = $params->get('imageBackground9','DFEBB1');
$imageBackground10 = $params->get('imageBackground10','C1E6E5');

$screen_width1			= $params->get('screen_width1', 0);
$modulewidth1			= $params->get('modulewidth1', 0);
$moduleheight1			= $params->get('moduleheight1', 0);
$imageWidth1			= $params->get('imageWidth1', 0);
$imageHeight1			= $params->get('imageHeight1', 0);

$screen_width2			= $params->get('screen_width2', 0);
$modulewidth2			= $params->get('modulewidth2', 0);
$moduleheight2			= $params->get('moduleheight2', 0);
$imageWidth2			= $params->get('imageWidth2', 0);
$imageHeight2			= $params->get('imageHeight2', 0);

$screen_width3			= $params->get('screen_width3', 0);
$modulewidth3			= $params->get('modulewidth3', 0);
$moduleheight3			= $params->get('moduleheight3', 0);
$imageWidth3			= $params->get('imageWidth3', 0);
$imageHeight3			= $params->get('imageHeight3', 0);

$screen_width4			= $params->get('screen_width4', 0);
$modulewidth4			= $params->get('modulewidth4', 0);
$moduleheight4			= $params->get('moduleheight4', 0);
$imageWidth4			= $params->get('imageWidth4', 0);
$imageHeight4			= $params->get('imageHeight4', 0);

$screen_width5			= $params->get('screen_width5', 0);
$modulewidth5			= $params->get('modulewidth5', 0);
$moduleheight5			= $params->get('moduleheight5', 0);
$imageWidth5			= $params->get('imageWidth5', 0);
$imageHeight5			= $params->get('imageHeight5', 0);

// get the document object
$doc = JFactory::getDocument();

require(JModuleHelper::getLayoutPath('mod_joombig_slider_with_3d_effects'));