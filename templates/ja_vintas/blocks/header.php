<?php
/**
 * ------------------------------------------------------------------------
 * JA Vintas Template
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - Copyrighted Commercial Software
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites:  http://www.joomlart.com -  http://www.joomlancers.com
 * This file may not be redistributed in whole or significant part.
 * ------------------------------------------------------------------------
 */

// No direct access
defined('_JEXEC') or die;
?>
<script>
    jQuery('head').append('<meta name="viewport" content="width=1400">')
</script>
<?php
$app = JFactory::getApplication();
$siteName = $app->getCfg('sitename');
if ($this->getParam('logoType', 'image')=='image'): ?>
<h1 class="logo">
    <a href="<?php JURI::base(true) ?>" title="<?php echo $siteName; ?>"><span><?php echo $siteName; ?></span></a>
</h1>
<?php else:
$logoText = (trim($this->getParam('logoText'))=='') ? $siteName : JText::_(trim($this->getParam('logoText')));
$sloganText = JText::_(trim($this->getParam('sloganText'))); ?>
<div class="logo-text">
    <h1><a href="<?php JURI::base(true) ?>" title="<?php echo $siteName; ?>"><span><?php echo $logoText; ?></span></a></h1>
    <p class="site-slogan"><?php echo $sloganText;?></p>
</div>
<?php endif; ?>


<?php if ($this->countModules('hotline') || $this->countModules('vm-cart')): ?>
<div id="ja-header-info">
	<?php if ($this->countModules('hotline')): ?>
	<div id="ja-hotline">
		<jdoc:include type="modules" name="hotline" style="raw" />
	</div>
	<?php endif; ?>
	
	<?php if ($this->countModules('vm-cart')): ?>
	<div id="ja-cart">
		<jdoc:include type="modules" name="vm-cart" style="raw" />
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>
