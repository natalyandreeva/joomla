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
<p style="display: inline-block; width: 80%; margin: auto;">Владелец интернет-магазина Kiseya.by - закрытое акционерное общество «КиС» (210026, Беларусь, г.Витебск, ул.Советская, 10-А, оф.5  УНП 300299762 Зарегистрировано Витебским областным исполнительным комитетом 08.06.2000г) Дата регистрации интернет-магазина в Торговом реестре 19.11.2012г. за №148521.  Регулирующий орган – Управление торговли и услуг Витебского городского исполнительного комитета, г.Витебск, ул.Замковая, 4, тел. 37-29-63.</p>
<div class="ja-copyright">
       <jdoc:include type="modules" name="footer" />
</div>

<?php if($this->countModules('footnav')) : ?>
<div class="ja-footnav">
    <jdoc:include type="modules" name="footnav" />
</div>
<?php endif; ?>


<?php
$t3_logo = $this->getParam ('setting_t3logo', 't3-logo-light', 't3-logo-dark');
if ($t3_logo != 'none') : ?>
<div id="ja-poweredby" class="<?php echo $t3_logo ?>">
    <a href="http://t3.joomlart.com" title="Powered By T3 Framework" target="_blank">Powered By T3 Framework</a>
</div>
<?php endif; ?>
<?php if($this->countModules('social')) : ?>
	<div id="ja-social">
		<jdoc:include type="modules" name="social" />
	</div>
<?php endif; ?>