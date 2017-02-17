<?php
/*------------------------------------------------------------------------
# "Joombig slider with 3d effects" Module
# Copyright (C) 2013 All rights reserved by joombig.com
# License: GNU General Public License version 2 or later; see LICENSE.txt
# Author: joombig.com
# Website: http://www.joombig.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die('Restricted access'); // no direct access 
?>
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_with_3d_effects/tmpl/fonts.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_with_3d_effects/tmpl/mod_joombig_layout.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_with_3d_effects/tmpl/style.css" />
<style>
	.slider_with_3d_effect_container{
		width: <?php echo $modulewidth;?>px;
		height: <?php echo $moduleheight;?>px;
	}
	.jms-slideshow {
		height: <?php echo ($moduleheight);?>px;
	}
	.step {	
		width: <?php echo ($modulewidth);?>px;
		height: <?php echo ($moduleheight);?>px;
	}
	.jms-wrapper {
		height: <?php echo ($moduleheight);?>px;
	}
	.jms-content{
		margin: 0px <?php echo ($imageWidth+10);?>px 0px 0px;
	}
	.step h3{
		font-size: <?php echo $title_size;?>px;
		line-height: <?php echo $title_size;?>px;
	}
	.step p {
		font-size: <?php echo $des_size;?>px;
		line-height: <?php echo $des_size;?>px;
	}
	.color-1 {
		background-color: <?php echo $imageBackground1;?>;
	}
	.color-2 {
		background-color: <?php echo $imageBackground2;?>;
	}
	.color-3 {
		background-color: <?php echo $imageBackground3;?>;
	}
	.color-4 {
		background-color: <?php echo $imageBackground4;?>;
	}
	.color-5 {
		background-color: <?php echo $imageBackground5;?>;
	}
	.color-6 {
		background-color: <?php echo $imageBackground6;?>;
	}
	.color-7 {
		background-color: <?php echo $imageBackground7;?>;
	}
	.color-8 {
		background-color: <?php echo $imageBackground8;?>;
	}
	.color-9 {
		background-color: <?php echo $imageBackground9;?>;
	}
	.color-10 {
		background-color: <?php echo $imageBackground10;?>;
	}
	@media screen and (max-width: <?php echo $screen_width1;?>px) {
		.slider_with_3d_effect_container{
			width: <?php echo $modulewidth1;?>px;
			height: <?php echo $moduleheight1;?>px;
			margin:0 auto;
		}
		.jms-slideshow {
			height: <?php echo ($moduleheight1-24);?>px;
		}
		.step {	
			width: <?php echo ($modulewidth1-40);?>px;
			height: <?php echo ($moduleheight1-60);?>px;
		}
		.jms-wrapper {
			height: <?php echo ($moduleheight1-44);?>px;
		}
		.jms-content{
			margin: 0px <?php echo ($imageWidth1+10);?>px 0px 0px;
		}
	}
	@media screen and (max-width: <?php echo $screen_width2;?>px) {
		.slider_with_3d_effect_container{
			width: <?php echo $modulewidth2;?>px;
			height: <?php echo $moduleheight2;?>px;
			margin:0 auto;
		}
		.jms-slideshow {
			height: <?php echo ($moduleheight2-24);?>px;
		}
		.step {	
			width: <?php echo ($modulewidth2-40);?>px;
			height: <?php echo ($moduleheight2-60);?>px;
		}
		.jms-wrapper {
			height: <?php echo ($moduleheight2-44);?>px;
		}
		.jms-content{
			margin: 0px <?php echo ($imageWidth2+10);?>px 0px 0px;
		}
	}
	@media screen and (max-width: <?php echo $screen_width3;?>px) {
		.slider_with_3d_effect_container{
			width: <?php echo $modulewidth3;?>px;
			height: <?php echo $moduleheight3;?>px;
			margin:0 auto;
		}
		.jms-slideshow {
			height: <?php echo ($moduleheight3-24);?>px;
		}
		.step {	
			width: <?php echo ($modulewidth3-40);?>px;
			height: <?php echo ($moduleheight3-60);?>px;
		}
		.jms-wrapper {
			height: <?php echo ($moduleheight3-44);?>px;
		}
		.jms-content{
			margin: 0px <?php echo ($imageWidth3+10);?>px 0px 0px;
		}
	}
	@media screen and (max-width: <?php echo $screen_width4;?>px) {
		.slider_with_3d_effect_container{
			width: <?php echo $modulewidth4;?>px;
			height: <?php echo $moduleheight4;?>px;
			margin:0 auto;
		}
		.jms-slideshow {
			height: <?php echo ($moduleheight4-24);?>px;
		}
		.step {	
			width: <?php echo ($modulewidth4-40);?>px;
			height: <?php echo ($moduleheight4-60);?>px;
		}
		.jms-wrapper {
			height: <?php echo ($moduleheight4-44);?>px;
		}
		.jms-content{
			margin: 0px <?php echo ($imageWidth4+10);?>px 0px 0px;
		}
	}
	@media screen and (max-width: <?php echo $screen_width5;?>px) {
		.slider_with_3d_effect_container{
			width: <?php echo $modulewidth5;?>px;
			height: <?php echo $moduleheight5;?>px;
			margin:0 auto;
		}
		.jms-slideshow {
			height: <?php echo ($moduleheight5-24);?>px;
		}
		.step {	
			width: <?php echo ($modulewidth5-40);?>px;
			height: <?php echo ($moduleheight5-60);?>px;
		}
		.jms-wrapper {
			height: <?php echo ($moduleheight5-44);?>px;
		}
		.jms-content{
			margin: 0px <?php echo ($imageWidth5+10);?>px 0px 0px;
		}
	}
</style>
<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="<?php //echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_with_3d_effects/tmpl/style_ie.css" />
<![endif]-->
<script>
jQuery.noConflict(); 
</script>
<?php if($enable_jQuery == 1){?>
	<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_with_3d_effects/js/jquery.min.js"></script>
<?php }?>
<!-- jmpress plugin -->
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_with_3d_effects/js/jmpress.min.js"></script>
<script>
	var  call_modulewidth, call_moduleheight, call_autoplay, call_animationspeed;
	call_modulewidth = <?php echo $modulewidth;?>;
	call_moduleheight = <?php echo $moduleheight;?>;
	call_autoplay = <?php echo $autoplay;?>;
	call_animationspeed = <?php echo $animationspeed;?>;
	if ((screen.width <= <?php echo $screen_width1;?>)&&(screen.width > <?php echo $screen_width2;?>)){
		call_modulewidth = <?php echo $modulewidth1;?>;
		call_moduleheight = <?php echo $moduleheight1;?>;
	}
	if ((screen.width <= <?php echo $screen_width2;?>)&&(screen.width > <?php echo $screen_width3;?>)){
		call_modulewidth = <?php echo $modulewidth2;?>;
		call_moduleheight = <?php echo $moduleheight2;?>;
	}
	if ((screen.width <= <?php echo $screen_width3;?>)&&(screen.width > <?php echo $screen_width4;?>)){
		call_modulewidth = <?php echo $modulewidth3;?>;
		call_moduleheight = <?php echo $moduleheight3;?>;
	}
	if ((screen.width <= <?php echo $screen_width4;?>)&&(screen.width > <?php echo $screen_width5;?>)){
		call_modulewidth = <?php echo $modulewidth4;?>;
		call_moduleheight = <?php echo $moduleheight4;?>;
	}
	if (screen.width <= <?php echo $screen_width5;?>){
		call_modulewidth = <?php echo $modulewidth5;?>;
		call_moduleheight = <?php echo $moduleheight5;?>;
	}
</script>
<!-- jmslideshow plugin : extends the jmpress plugin -->
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_joombig_slider_with_3d_effects/js/jquery.jmslideshow.js"></script>

<div class="slider_with_3d_effect_container">
			<div id="jms-slideshow" class="jms-slideshow">
			<?php for ($loop = 1; $loop <= $tabNumber; $loop += 1) { 
				if ($image[$loop] != 'image'.$loop.'joombig.jpg')
				{
					if ($loop == 1)
					{?>
						<div class="step" data-color="color-<?php echo $loop; ?>">
					<?php
					}
					if ($loop == 2)
					{?>
						<div class="step" data-color="color-<?php echo $loop; ?>" data-y="500">
					<?php
					}
					if ($loop == 3)
					{?>
						<div class="step" data-color="color-<?php echo $loop; ?>" data-x="2000" data-z="3000" data-rotate="170">
					<?php
					}
					if ($loop == 4)
					{?>
						<div class="step" data-color="color-<?php echo $loop; ?>" data-x="3000">
					<?php
					}
					if ($loop == 5)
					{?>
						<div class="step" data-color="color-<?php echo $loop; ?>" data-x="4500" data-z="1000" data-rotate-y="45">
					<?php
					}
					
					if ($loop == 6)
					{?>
						<div class="step" data-color="color-<?php echo $loop; ?>" data-scale="0.1">
					<?php
					}
					if ($loop == 7)
					{?>
						<div class="step" data-color="color-<?php echo $loop; ?>" data-y="500" data-rotate-x="30" data-scale="0.2">
					<?php
					}
					if ($loop == 8)
					{?>
						<div class="step" data-color="color-<?php echo $loop; ?>" data-x="2000" data-z="3000" data-rotate="170" data-scale="0.1">
					<?php
					}
					if ($loop == 9)
					{?>
						<div class="step" data-color="color-<?php echo $loop; ?>" data-x="3000" data-scale="0.1">
					<?php
					}
					if ($loop == 10)
					{?>
						<div class="step" data-color="color-<?php echo $loop; ?>" data-x="4500" data-z="1000" data-rotate-y="45" data-scale="0.1">
					<?php
					}
					?>
							<img src="<?php echo $image[$loop];?>" height="<?php echo $imageHeight; ?>" width="<?php echo $imageWidth; ?>"/>
							<div class="jms-content">
								<?php if($show_button==1){?>
									<div class="joombig_readmore_button">
										<a class="jms-link" href="<?php echo $readmorelink[$loop]; ?>"><?php echo $readmoretext[$loop]; ?></a>
									</div>
								<?php }?>
							</div>
						</div>
				<?php
				}
			} 
			?>
			</div>
</div>