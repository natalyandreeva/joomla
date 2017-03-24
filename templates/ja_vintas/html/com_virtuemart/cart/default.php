<?php
/**
 *
 * Layout for the shopping cart
 *
 * @package    VirtueMart
 * @subpackage Cart
 * @author Max Milbers
 *
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: cart.php 2551 2010-09-30 18:52:40Z milbo $
 */

// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');

JHtml::_ ('behavior.formvalidation');



if ($_GET['mode'] == 'step1') {
?>	

<script type="text/javascript" src="/templates/ja_vintas/js/recalculate_cart.js"></script>

<div class="cart-view-step1">
	<div>
		<div class="width100 floatleft">
			<h1><?php echo JText::_ ('COM_VIRTUEMART_CART_TITLE'); ?></h1>
		</div>
		<?php if (VmConfig::get ('oncheckout_show_steps', 1) && $this->checkout_task === 'confirm') {
		vmdebug ('checkout_task', $this->checkout_task);
		echo '<div class="checkoutStep" id="checkoutStep4">' . JText::_ ('COM_VIRTUEMART_USER_FORM_CART_STEP4') . '</div>';
	} ?>
		<!--div class="width50 floatleft right">
			<?php // Continue Shopping Button
			if ($this->continue_link_html != '') {
				echo $this->continue_link_html;
			} ?>
		</div-->
		<div class="clear"></div>
	</div>
<table
	class="cart-summary"
	cellspacing="0"
	cellpadding="0"
	border="0"
	width="100%">
<tr>
	<th align="center" colspan="2"><?php echo JText::_ ('COM_VIRTUEMART_PRODUCTDETAILS_PRODUCT') ?></th>
	<th
		align="center"
		width="90px"><?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_PRICE_FORPACK') ?></th>
	<th
		align="right"
		width="120px"><?php echo JText::_ ('COM_VIRTUEMART_QUANTITY') ?></th>

	<th align="right" width="80px"><?php echo JText::_ ('COM_VIRTUEMART_COST') ?></th>
</tr>



<?php
$i = 1;
// 		vmdebug('$this->cart->products',$this->cart->products);
foreach ($this->cart->products as $pkey => $prow) {
	?>
<tr valign="top" class="sectiontableentry<?php echo $i ?>">
	<td align="center">
		<?php if ($prow->virtuemart_media_id) { ?>
		<span class="cart-images">
						 <?php
			if (!empty($prow->images[0]->file_url)) { ?>
				<img class="cart-image" border="0"  src="<?php echo $prow->images[0]->file_url ?>">
				<?php
				//echo $result->image->displayMediaThumb ('', FALSE);
			} else {
			?>
			<img  src="components/com_virtuemart/assets/images/vmgeneral/noimage.gif" >
			<?php } ?>
						</span>
		<?php } ?></td>
		<td><?php  echo JHTML::link ($prow->url, $prow->product_name) ?></td>

	</td>
	<td align="center">
		<?php
		// 					vmdebug('$this->cart->pricesUnformatted[$pkey]',$this->cart->pricesUnformatted[$pkey]['priceBeforeTax']);
		echo $this->currencyDisplay->createPriceDiv('basePrice','', $this->cart->pricesUnformatted[$pkey],false);
		// 					echo $prow->salesPrice ;
		?>
	</td>
	<td align="right">
	   <div>
		<form action="<?php echo JRoute::_ ('index.php?mode=step1'); ?>" method="post" class="inline" id="updatecart_form<?php echo $pkey ?>" rel="<?php echo $pkey; ?>">
			<input type="hidden" name="option" value="com_virtuemart"/>
			<span class="quantity-controls">
		        <input type="button" class="quantity-controls quantity-minus" onclick="decrease_qty(<?php echo $pkey ?>);">
		    </span>
			<input type="text" title="<?php echo  JText::_ ('COM_VIRTUEMART_CART_UPDATE') ?>" id="quantity" class="inputbox" size="3" maxlength="4" name="quantity[<?php echo $pkey; ?>]" value="<?php echo $prow->quantity ?>"/>
			<span class="quantity-controls">
		        <input type="button" class="quantity-controls quantity-plus" onclick="increase_qty(<?php echo $pkey ?>);">
		    </span>

			<input type="hidden" name="view" value="cart"/>
			<input type="hidden" name="task" value="updatecart"/>
			<input type="hidden" name="price" id="price" value="<?php echo $prow->prices['salesPrice']?>" />
			<input type="hidden" name="cart_virtuemart_product_id" value="<?php echo $prow->cart_item_id  ?>"/>
			
			<span class="quantity-box"><input type="submit" class="vmicon vm2-add_quantity_cart" name="update" title="<?php echo  JText::_ ('COM_VIRTUEMART_CART_UPDATE') ?>" align="middle" value=" "/></span>
			
		</form>
		</div>
		<div class="cart-delete">
		<a class="cart-delete-btn" title="<?php echo JText::_ ('COM_VIRTUEMART_CART_DELETE') ?>" align="middle" href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=cart&task=delete&cart_virtuemart_product_id=' . $prow->cart_item_id . '&mode=step1') ?>"><span><?php echo JText::_ ('COM_VIRTUEMART_CART_DELETE') ?></span> </a></div>
	</td>

	<?php if (VmConfig::get ('show_tax')) { ?>
	<td align="right"><?php echo "<span class='priceColor2'>" . $this->currencyDisplay->createPriceDiv ('taxAmount', '', $this->cart->pricesUnformatted[$pkey], FALSE, FALSE, $prow->quantity) . "</span>" ?></td>
	<?php } ?>
	<td colspan="1" align="right">
		<?php
		if (VmConfig::get ('checkout_show_origprice', 1) && !empty($this->cart->pricesUnformatted[$pkey]['basePriceWithTax']) && $this->cart->pricesUnformatted[$pkey]['basePriceWithTax'] != $this->cart->pricesUnformatted[$pkey]['salesPrice']) {
			echo '<span class="line-through">' . $this->currencyDisplay->createPriceDiv ('basePriceWithTax', '', $this->cart->pricesUnformatted[$pkey], TRUE, FALSE, $prow->quantity) . '</span><br />';
		}?>
		<div id="pricediv-<?php echo $pkey ?>">
		<?php echo $this->currencyDisplay->createPriceDiv ('salesPrice', '', $this->cart->pricesUnformatted[$pkey], FALSE, FALSE, $prow->quantity) ?>
		</div>
		</td>
</tr>
<?php	
}
?>
</table> 
<div class="cart-totalcost"><div class="lbl-totalcost"><?php echo JText::_ ('COM_VIRTUEMART_ORDER_PRINT_PRODUCT_PRICES_TOTAL'); ?></div>
	<?php echo $this->currencyDisplay->createPriceDiv ('salesPrice', '', $this->cart->pricesUnformatted, FALSE) ?>
</div>
<div class="checkout-button-top">

			<a href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=cart') ?>" class="vm-button-correct" title="<?php echo JText::_ ('COM_VIRTUEMART_CHECKOUT_TITLE'); ?>"><span>
			<?php echo JText::_ ('COM_VIRTUEMART_CHECKOUT_TITLE'); ?>	
			</span> </a>		</div>
</div>
<?php
} else { ?>

<div class="vm-cart-header-container">
	<div class="width50 floatleft vm-cart-header">
		<h1><?php echo vmText::_ ('COM_VIRTUEMART_CART_TITLE'); ?></h1>
		<div class="payments-signin-button" ></div>
	</div>
	<?php if (VmConfig::get ('oncheckout_show_steps', 1) && $this->checkout_task === 'confirm') {
		echo '<div class="checkoutStep" id="checkoutStep4">' . vmText::_ ('COM_VIRTUEMART_USER_FORM_CART_STEP4') . '</div>';
	} ?>
	<div class="width50 floatleft right vm-continue-shopping">
		<?php // Continue Shopping Button
		if (!empty($this->continue_link_html)) {
			echo $this->continue_link_html;
		} ?>
	</div>
	<div class="clear"></div>
</div>
<div class="horizontal-separator-yellow"></div>

<div id="cart-view" class="cart-view">


	<?php
	$uri = vmURI::getCleanUrl();
	$uri = str_replace(array('?tmpl=component','&tmpl=component'),'',$uri);
	echo shopFunctionsF::getLoginForm ($this->cart, FALSE,$uri);

	// This displays the form to change the current shopper
	if ($this->allowChangeShopper){
		echo $this->loadTemplate ('shopperform');
	}


	$taskRoute = '';
	?><form method="post" id="checkoutForm" name="checkoutForm" action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=cart' . $taskRoute, $this->useXHTML, $this->useSSL); ?>">
		<?php
		if(VmConfig::get('multixcart')=='byselection'){
			if (!class_exists('ShopFunctions')) require(VMPATH_ADMIN . DS . 'helpers' . DS . 'shopfunctions.php');
			echo shopFunctions::renderVendorFullVendorList($this->cart->vendorId);
			?><input type="submit" name="updatecart" title="<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>" value="<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>" class="button"  style="margin-left: 10px;"/><?php
		}
		echo $this->loadTemplate ('address');
		// This displays the pricelist MUST be done with tables, because it is also used for the emails
		echo $this->loadTemplate ('pricelist');

		if (!empty($this->checkoutAdvertise)) {
			?> <div id="checkout-advertise-box"> <?php
			foreach ($this->checkoutAdvertise as $checkoutAdvertise) {
				?>
				<div class="checkout-advertise">
					<?php echo $checkoutAdvertise; ?>
				</div>
			<?php
			}
			?></div><?php
		}

		echo $this->loadTemplate ('cartfields');

		?> <div class="checkout-button-top"> <?php
			echo $this->checkout_link_html;
			?></div>

		<?php // Continue and Checkout Button END ?>
		<input type='hidden' name='order_language' value='<?php echo $this->order_language; ?>'/>
		<input type='hidden' name='task' value='updatecart'/>
		<input type='hidden' name='option' value='com_virtuemart'/>
		<input type='hidden' name='view' value='cart'/>
	</form>


<?php

if(VmConfig::get('oncheckout_ajax',false)){
	vmJsApi::addJScript('updDynamicListeners',"
if (typeof Virtuemart.containerSelector === 'undefined') Virtuemart.containerSelector = '#cart-view';
if (typeof Virtuemart.container === 'undefined') Virtuemart.container = jQuery(Virtuemart.containerSelector);

jQuery(document).ready(function() {
	if (Virtuemart.container)
		Virtuemart.updDynFormListeners();
}); ");
}


vmJsApi::addJScript('vm.checkoutFormSubmit',"
Virtuemart.bCheckoutButton = function(e) {
	e.preventDefault();
	jQuery(this).vm2front('startVmLoading');
	jQuery(this).attr('disabled', 'true');
	jQuery(this).removeClass( 'vm-button-correct' );
	jQuery(this).addClass( 'vm-button' );
	jQuery(this).fadeIn( 400 );
	var name = jQuery(this).attr('name');
	var div = '<input name=\"'+name+'\" value=\"1\" type=\"hidden\">';

	jQuery('#checkoutForm').append(div);
	//Virtuemart.updForm();
	jQuery('#checkoutForm').submit();
}
jQuery(document).ready(function($) {
	jQuery(this).vm2front('stopVmLoading');
	var el = jQuery('#checkoutFormSubmit');
	el.unbind('click dblclick');
	el.on('click dblclick',Virtuemart.bCheckoutButton);
});
	");

if( !VmConfig::get('oncheckout_ajax',false)) {
	vmJsApi::addJScript('vm.STisBT',"
		jQuery(document).ready(function($) {

			if ( $('#STsameAsBTjs').is(':checked') ) {
				$('#output-shipto-display').hide();
			} else {
				$('#output-shipto-display').show();
			}
			$('#STsameAsBTjs').click(function(event) {
				if($(this).is(':checked')){
					$('#STsameAsBT').val('1') ;
					$('#output-shipto-display').hide();
				} else {
					$('#STsameAsBT').val('0') ;
					$('#output-shipto-display').show();
				}
				var form = jQuery('#checkoutFormSubmit');
				form.submit();
			});
		});
	");
}

$this->addCheckRequiredJs();
?><div style="display:none;" id="cart-js">
<?php echo vmJsApi::writeJS(); ?>
</div>
</div>
<?php } ?>