<?php
/*
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
// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' ); 

?>
	<div class="clearfix">
	
	<?php if($this->countModules('top_menu')) : ?>
		<jdoc:include type="modules" name="top_menu" />
	<?php endif; ?>
	
	
	<?php if($this->countModules('login')) : ?>
	<div id="ja-login">
		<jdoc:include type="modules" name="login" />
	</div>
	<?php endif; ?>
	
	</div>
	
