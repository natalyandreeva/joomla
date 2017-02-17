<?php
/*
 * @package Joomla 1.5/1.6/1.7/2.5/3.0
 * @copyright Copyright (C) 2012. All rights reserved.
 *
 * @Module Callback aKernel
 * @copyright Copyright (C) A.Kernel www.akernel.ru
 */

 // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$path = JURI::root().'modules/mod_callback/';
$use_jquery = $params->get('use_jquery', 1);
$show_time = $params->get('show_time', 1);
$doc = JFactory::getDocument ();
if ($use_jquery == 1)
{
	$doc->addScript ( $path.'jquery-1.4.2.min.js' );
	$doc->addScriptDeclaration ( 'jQuery.noConflict();' );
}
$doc->addStyleSheet ( $path.'tmpl/style.css' );


?>
<!-- validate-->
    <script language="javascript" type="text/javascript">
    	function getClientWidth()
		{
			return document.compatMode=='CSS1Compat' && document.documentElement.clientWidth;
		}

		function getClientHeight()
		{
			return document.compatMode=='CSS1Compat' && document.documentElement.clientHeight;
		}

		var top_block = Math.round((getClientHeight() - 330) / 2);
		var left_block = Math.round((getClientWidth() - 288) / 2);
		
    	jQuery(function(){
    		jQuery("#form_vopros").animate({ marginLeft: left_block, marginTop: top_block}, 0 );
    		//jQuery("#form_border").animate({ opacity: 0}, 0 );
    		
    		jQuery("#close_callback").click(function(){
				jQuery("#form_vopros").hide( 0, function(){
						jQuery("#form_border").animate({
						opacity: 1.0
						}, 0, function(){
							jQuery("#form_border").animate({
							opacity: 0.0, marginLeft: 19, marginTop: 19, width: "29px", height: "33px"
							}, 500, function() { jQuery("#layer_form").hide() } );
						} );
					}
				);
			});
			
			jQuery("#show_callback").click(function(){
				jQuery("#layer_form").show();
				jQuery("#form_border").animate({
					opacity: 1.0, marginLeft: left_block+19, marginTop: top_block+19, width: "249px", height: "290px"
					}, 500, function(){
						jQuery("#form_border").animate({
						opacity: 0.0
						}, 0, function(){
							jQuery("#form_vopros").show();
						} );
					}
				);
			});
		});
        function checkForm()
        {
        	var form = document.feedback_form;

           if (form.name.value == "")
           {
                 alert( '<?php echo JText::_('modcallback_enter_your_name') ?>' );
                 form.name.focus();
                 return false;
           }
           if (form.phone.value == "")
           {
                 alert( '<?php echo JText::_('modcallback_enter_your_phone') ?>' );
                 form.phone.focus();
                 return false;
           }
           return true;
        }
        </script>
     <!-- end validate-->
<?php
    if($form_send == 1)
        echo "<script>alert('".$send_code."');</script>";
?>
<div id="form_vopros1"><a id="show_callback" href="javascript:void(0)" title="<?php echo JText::_('modcallback_open') ?>"><?php echo JText::_('modcallback_title') ?></a></div>
<div id="layer_form">
	<div id="form_border"></div>
	<div id="form_vopros">
	    <div id="bg_top"></div>
	    <div id="bg_left"></div>
	    <div id="form_cb">
	    	<div id="form_close"><a id="close_callback" href="javascript:void(0)" title="<?php echo JText::_('modcallback_close') ?>"><img src="<?php echo $path;?>images/close.gif" border="0" width="15" height="15" alt="<?php echo JText::_('modcallback_close') ?>" /></a></div>
	        <form action="<?php echo JRoute::_( '', true, $params->get('usesecure')); ?>" method="post" name="feedback_form" class="form_items">
	    		<input type="hidden" name="form_send" value="1" />
	            <div class="field_input">
	            	<span><?php echo JText::_('modcallback_name') ?></span>
	            	<div class="input_fon"><input type="text" name="name" class="input_cb" /></div>
	            </div>
	            <div class="field_input">
	            	<span><?php echo JText::_('modcallback_phone') ?></span>
	            	<div class="input_fon"><input type="text" name="phone" class="input_cb" /></div>
	            </div>
	            <?php if ($show_time) { ?>
	            <div class="field_input">
	            	<span><?php echo JText::_('modcallback_time') ?></span>
	            	<div class="input_fon"><input type="text" name="time" class="input_cb" /></div>
	            </div>
	            <?php } else { ?>
	            	<input type="hidden" name="time" value="" />
	            <?php } ?>
	            <?php if ($show_kcaptcha) { ?>
	            <div class="field_kcaptcha">
	            	<span><?php echo JText::_('modcallback_enter_kcaptcha') ?></span>
	            	<div><img src="<?php echo $path;?>image.php" /></div>
	            	<div class="input_kcaptcha"><input type="text" name="kcaptcha_code" class="input_cb_kcaptcha" /></div>
	            </div>
	            <div class="clr"></div>
	            <?php } else { ?>
	            	<input type="hidden" name="kcaptcha_code" value="" />
	            <?php } ?>
	            <input type="hidden" name="title_cb" value="<?php echo addslashes($doc->getTitle());?>" />
	            <div id="field_submit">
	            	<input type="image" src="<?php echo $path;?>images/send.gif" alt="<?php echo JText::_('modcallback_send') ?>" height="31" width="123" onclick="return checkForm()" />
	            </div>
	    	</form>
<?php 
echo modCallbackHelper::end();