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
<div class="rb-left">&nbsp;</div>
<?php if (($jamenu = $this->loadMenu())) $jamenu->genMenu (); ?>
<!-- jdoc:include type="menu" level="0" / -->
<div class="rb-right">&nbsp;</div>

<?php if ($this->hasSubmenu() && ($jamenu = $this->loadMenu())) : ?>
<div id="ja-subnav" class="clearfix">
<?php $jamenu->genMenu (1); ?>
<!-- jdoc:include type="menu" level="1" / -->
</div>
<?php endif;?>

<ul class="no-display">
    <li><a href="<?php echo $this->getCurrentURL();?>#ja-content" title="<?php echo JText::_("SKIP_TO_CONTENT");?>"><?php echo JText::_("SKIP_TO_CONTENT");?></a></li>
</ul>
