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
vmJsApi::js ('facebox');
vmJsApi::js ('vmprices');
vmJsApi::css ('facebox');
JHtml::_ ('behavior.formvalidation');
$document = JFactory::getDocument ();
$document->addScriptDeclaration ("

//<![CDATA[
	jQuery(document).ready(function($) {
		$('div#full-tos').hide();
		$('a#terms-of-service').click(function(event) {
			event.preventDefault();
			$.facebox( { div: '#full-tos' }, 'my-groovy-style');
		});
	});

//]]>
");
$document->addScriptDeclaration ("

//<![CDATA[
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
		});
	});

//]]>

");
$document->addStyleDeclaration ('#facebox .content {display: block !important; height: 480px !important; overflow: auto; width: 560px !important; }');

//vmdebug('car7t pricesUnformatted',$this->cart->pricesUnformatted);
//vmdebug('cart cart',$this->cart->pricesUnformatted );

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
	<th align="left"><?php echo JText::_ ('COM_VIRTUEMART_PRODUCTDETAILS_PRODUCT') ?></th>
	<th
		align="center"
		width="100px"><?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_PRICE_FORPACK') ?></th>
	<th
		align="right"
		width="140px"><?php echo JText::_ ('COM_VIRTUEMART_QUANTITY') ?></th>

	<th align="right" width="115px"><?php echo JText::_ ('COM_VIRTUEMART_COST') ?></th>
</tr>



<?php
$i = 1;
// 		vmdebug('$this->cart->products',$this->cart->products);
foreach ($this->cart->products as $pkey => $prow) {
	?>
<tr valign="top" class="sectiontableentry<?php echo $i ?>">
	<td align="left">
		<?php if ($prow->virtuemart_media_id) { ?>
		<span class="cart-images">
						 <?php
			if (!empty($prow->image)) {
				echo $prow->image->displayMediaThumb ('', FALSE);
			}
			?>
						</span>
		<?php } ?>
		<?php  echo JHTML::link ($prow->url, $prow->product_name) . $prow->customfields; ?>

	</td>
	<td align="center">
		<?php
		// 					vmdebug('$this->cart->pricesUnformatted[$pkey]',$this->cart->pricesUnformatted[$pkey]['priceBeforeTax']);
		echo $this->currencyDisplay->createPriceDiv('basePrice','', $this->cart->pricesUnformatted[$pkey],false);
		// 					echo $prow->salesPrice ;
		?>
	</td>
	<td class="vm-cart-item-quantity" ><?php

				if ($prow->step_order_level)
					$step=$prow->step_order_level;
				else
					$step=1;
				if($step==0)
					$step=1;
				?>
		   <input type="text"
				   onblur="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED',true)?>');"
				   onclick="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED',true)?>');"
				   onchange="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED',true)?>');"
				   onsubmit="Virtuemart.checkQuantity(this,<?php echo $step?>,'<?php echo vmText::_ ('COM_VIRTUEMART_WRONG_AMOUNT_ADDED',true)?>');"
				   title="<?php echo  vmText::_('COM_VIRTUEMART_CART_UPDATE') ?>" class="quantity-input js-recalculate" size="3" maxlength="4" name="quantity[<?php echo $pkey; ?>]" value="<?php echo $prow->quantity ?>" />

			<button type="submit" class="vmicon vm2-add_quantity_cart" name="updatecart.<?php echo $pkey ?>" title="<?php echo  vmText::_ ('COM_VIRTUEMART_CART_UPDATE') ?>" ></button>

			<button type="submit" class="vmicon vm2-remove_from_cart" name="delete.<?php echo $pkey ?>" title="<?php echo vmText::_ ('COM_VIRTUEMART_CART_DELETE') ?>" ></button>
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
} else {
?>
<div class="cart-view">
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



	<?php echo shopFunctionsF::getLoginForm ($this->cart, FALSE);

	// This displays the pricelist MUST be done with tables, because it is also used for the emails
	echo $this->loadTemplate ('pricelist');
	if ($this->checkout_task) {
		$taskRoute = '&task=' . $this->checkout_task;
	}
	else {
		$taskRoute = '';
	}


	// added in 2.0.8
	?>
	<div id="checkout-advertise-box">
		<?php
		if (!empty($this->checkoutAdvertise)) {
			foreach ($this->checkoutAdvertise as $checkoutAdvertise) {
				?>
				<div class="checkout-advertise">
					<?php echo $checkoutAdvertise; ?>
				</div>
				<?php
			}
		}
		?>
	</div>

	<form method="post" id="checkoutForm" name="checkoutForm" action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=cart' . $taskRoute, $this->useXHTML, $this->useSSL); ?>">

		<?php // Leave A Comment Field ?>
		<div class="customer-comment marginbottom15">
			<span class="comment"><?php echo JText::_ ('COM_VIRTUEMART_COMMENT_CART'); ?></span><br/>
			<textarea class="customer-comment" name="customer_comment" cols="60" rows="1"><?php echo $this->cart->customer_comment; ?></textarea>
		</div>
		<?php // Leave A Comment Field END ?>



		<?php // Continue and Checkout Button ?>
		<div class="checkout-button-top">

			<?php // Terms Of Service Checkbox
			if (!class_exists ('VirtueMartModelUserfields')) {
				require(JPATH_VM_ADMINISTRATOR . DS . 'models' . DS . 'userfields.php');
			}
			$userFieldsModel = VmModel::getModel ('userfields');
			if ($userFieldsModel->getIfRequired ('agreed')) {
				?>
				<label for="tosAccepted">
					<?php
					if (!class_exists ('VmHtml')) {
						require(JPATH_VM_ADMINISTRATOR . DS . 'helpers' . DS . 'html.php');
					}
					echo VmHtml::checkbox ('tosAccepted', $this->cart->tosAccepted, 1, 0, 'class="terms-of-service"');

					if (VmConfig::get ('oncheckout_show_legal_info', 1)) {
						?>
						<div class="terms-of-service">

							<a href="<?php JRoute::_ ('index.php?option=com_virtuemart&view=vendor&layout=tos&virtuemart_vendor_id=1') ?>" class="terms-of-service" id="terms-of-service" rel="facebox"
							   target="_blank">
								<span class="vmicon vm2-termsofservice-icon"></span>
								<?php echo JText::_ ('COM_VIRTUEMART_CART_TOS_READ_AND_ACCEPTED'); ?>
							</a>

							<div id="full-tos">
								<h2><?php echo JText::_ ('COM_VIRTUEMART_CART_TOS'); ?></h2>
								<?php echo $this->cart->vendor->vendor_terms_of_service; ?>
							</div>

						</div>
						<?php
					} // VmConfig::get('oncheckout_show_legal_info',1)
					//echo '<span class="tos">'. JText::_('COM_VIRTUEMART_CART_TOS_READ_AND_ACCEPTED').'</span>';
					?>
				</label>
				<?php
			}
			echo $this->checkout_link_html;
			?>
		</div>
		<?php // Continue and Checkout Button END ?>
		<input type='hidden' id='STsameAsBT' name='STsameAsBT' value='<?php echo $this->cart->STsameAsBT; ?>'/>
		<input type='hidden' name='task' value='<?php echo $this->checkout_task; ?>'/>
		<input type='hidden' name='option' value='com_virtuemart'/>
		<input type='hidden' name='view' value='cart'/>
	</form>
</div>
<?php } ?>
