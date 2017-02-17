<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
if (!isset($this->error)) {
	$this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	$this->debug = false;
}

defined( '_JEXEC' ) or die( 'Restricted access' );

//get language and direction
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<title><?php echo $this->error->getCode(); ?> - <?php echo $this->title; ?></title>
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/ja_vintas/css/error.css" type="text/css" />
</head>
<body>
	
	<div class="error wrap" >
		<div id="outline" class="main clearfix">
			<div id="errorboxoutline">
				<div id="errorboxheader"><?php echo $this->error->getCode(); ?></div>
				<div id="errorboxbody">
					<p class="error_mess"><span><?php echo $this->error->getMessage(); ?></span></p>
					<div id="techinfo">
						<a href="<?php echo $this->baseurl; ?>/index.php" >Go home </a>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
