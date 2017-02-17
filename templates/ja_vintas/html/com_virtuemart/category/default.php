<?php
/**
*
* Show the products in a category
*
* @package	VirtueMart
* @subpackage
* @author RolandD
* @author Max Milbers
* @todo add pagination
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 6053 2012-06-05 12:36:21Z Milbo $
*/

//vmdebug('$this->category',$this->category);
vmdebug('$this->category '.$this->category->category_name);
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
JHTML::_( 'behavior.modal' );
/* javascript for list Slide
  Only here for the order list
  can be changed by the template maker
*/
$js = "
jQuery(document).ready(function () {
	jQuery('.orderlistcontainer').hover(
		function() { jQuery(this).find('.orderlist').stop().show()},
		function() { jQuery(this).find('.orderlist').stop().hide()}
	)
});
";

$document = JFactory::getDocument();
$document->addScriptDeclaration($js);
$user=&JFactory::getUser();
$db=JFactory::getDBO();

/*$edit_link = '';
if(!class_exists('Permissions')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'permissions.php');
if (Permissions::getInstance()->check("admin,storeadmin")) {
	$edit_link = '<a href="'.JURI::root().'index.php?option=com_virtuemart&tmpl=component&view=category&task=edit&virtuemart_category_id='.$this->category->virtuemart_category_id.'">
		'.JHTML::_('image', 'images/M_images/edit.png', JText::_('COM_VIRTUEMART_PRODUCT_FORM_EDIT_PRODUCT'), array('width' => 16, 'height' => 16, 'border' => 0)).'</a>';
}

echo $edit_link; */
?>

<table width="100%"><tr><td colspan="2"><h1 class="category-name"><?php echo $this->category->category_name; ?></h1>
	</td></tr><tr><td valign="top"><?php if($this->category->images[0]->file_url_thumb!='') { ?><a class="modal" href="<?php echo $this->category->images[0]->file_url ?>"><img class="browseProductImage" border="0" width="100px" src="<?php echo $this->category->images[0]->file_url_thumb ?>"></a><?php } ?></td><td valign="top"><?php if($this->category->category_description!='') echo $this->category->category_description; ?></td>
	</tr></table>
<?php
/* Show child categories */

if ( VmConfig::get('showCategory',1) and empty($this->keyword)) {
	if ($this->category->haschildren) { ?>

		<div class="category-view">

		<?php // Start the Output
						
		if(!empty($this->category->children)) {
		foreach ( $this->category->children as $category ) {

			// Category Link
			$caturl = JRoute::_ ( 'index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $category->virtuemart_category_id );
			
			$query="SELECT category_parent_id FROM #__virtuemart_category_categories WHERE category_child_id=".$this->category->virtuemart_category_id;
 		   $db->setQuery($query);
	 	   $vpr=$db->loadResult();
		   if($vpr!=0) {
			$query="SELECT MIN(#__virtuemart_product_prices.product_price) FROM #__virtuemart_product_categories,#__virtuemart_product_prices,#__virtuemart_products WHERE #__virtuemart_product_categories.virtuemart_category_id=".$category->virtuemart_category_id." and #__virtuemart_product_categories.virtuemart_product_id=#__virtuemart_product_prices.virtuemart_product_price_id and #__virtuemart_products.virtuemart_product_id=#__virtuemart_product_prices.virtuemart_product_price_id and #__virtuemart_products.published=1";
			$db->setQuery($query);
			$min=$db->loadResult();
			//$query="SELECT MAX(#__virtuemart_product_prices.product_price) FROM #__virtuemart_product_categories,#__virtuemart_product_prices WHERE #__virtuemart_product_categories.virtuemart_category_id=".$category->virtuemart_category_id." and #__virtuemart_product_categories.virtuemart_product_id=#__virtuemart_product_prices.virtuemart_product_price_id";
			//$db->setQuery($query);
			//$max=$db->loadResult();
			}
			if($min>0) {
				// Show Category ?>
				<div class="category" width="100%">
					<div class="spacer">
					<table width="100%"><tr><td colspan="2" align="middle"><h2>
							<a href="<?php echo $caturl ?>" title="<?php echo $category->category_name ?>">
							<?php echo $category->category_name ?>														
							</a>
						</h2><hr /></td></tr><tr><td valign="top" width="20%"><?php if($vpr!=0) if($category->images[0]->file_url_thumb!='') { ?><a class="modal" href="<?php echo $category->images[0]->file_url?>"><img class="browseProductImage" border="0" width="100px" src="<?php echo $category->images[0]->file_url_thumb ?>"></a><?php } else { ?><img class="browseProductImage" border="0" width="90px" height="90px" src="images/stories/virtuemart/no.jpg"><?php } ?></td><td valign="top"><?php if($vpr!=0) if($category->category_description!='') echo shopFunctionsF::limitStringByWord ($category->category_description,200,' ...'); else echo "<font color=\"#ccc\">Описание товара временно отсутствует.</font>"; ?>
						<?php 	
						if($vpr!=0) {						
						//echo "<div class=\"product-price\"><div class=\"PricebasePrice\"><span class=\"PricebasePrice\"><font color=\"000\">Цена от: </font>".number_format($min,0,'',' ')." руб.</span></div></div>"; 
						}
						?>
						</td>
					</tr><tr><td colspan="2" align="right"><?php echo "<form style=\"float:right\" method=\"get\" action=\"".$caturl."\"><button>Подробнее...</button></form>"; ?></td></tr></table>
					</div>
				</div>
				<div class="horizontal-separator"></div>
			<?php }}} ?>
</div>
<?php }} ?>

<div class="browse-view">
    <?php
if (!empty($this->keyword)) {
	?>
	<h3><?php echo $this->keyword; ?></h3>
	<?php
} ?>
 		<?php if ($this->search !==null ) { ?>
		    <form action="<?php echo JRoute::_('index.php?option=com_virtuemart&view=category&limitstart=0&virtuemart_category_id='.$this->category->virtuemart_category_id ); ?>" method="get">

		    <!--BEGIN Search Box -->
				<div class="virtuemart_search">
		    	<div class="choose-product-type">
						<?php echo $this->searchcustom ?>
					</div>

			    <?php echo $this->searchcustomvalues ?>
			    <input name="keyword" class="inputbox" type="text" size="20" value="<?php echo $this->keyword ?>" />
			    <input type="submit" value="<?php echo JText::_('COM_VIRTUEMART_SEARCH') ?>" class="button" onclick="this.form.keyword.focus();"/>
		    </div>
				    <input type="hidden" name="search" value="true" />
				    <input type="hidden" name="view" value="category" />

		    </form>
		<!-- End Search Box -->
		<?php } ?>

<?php // Show child categories
if (!empty($this->products)) {
?>
			<div class="orderby-displaynumber">
				
				<div class="pagination">
					<?php echo $this->vmPagination->getPagesLinks(); ?>
					<span style="float:right"><?php echo $this->vmPagination->getPagesCounter(); ?></span>
				</div>

			</div> <!-- end of orderby-displaynumber -->

<div class="row" style="float:left;width:650px"><table width="100%" border="0">
<?php
foreach ( $this->products as $product ) { ?>
			<tr><td width="10%">				
				<?php if($product->images[0]->file_url_thumb!='') { echo $product->images[0]->displayMediaThumb('class="modal browseProductImage" border="0" title="/'.$product->product_name.'" , true');  } ?>
			</td><td width="25%">
				<h2><?php echo JHTML::link($product->link, trim(str_replace($this->category->category_name,'',$product->product_name))); ?></h2>					
			</td><td width="65%">

<div class="addtocart-area">
<form method="post" class="product js-recalculate" action="<?php echo JRoute::_ ('index.php'); ?>">
<table border="0"><tr><td width="30%">

<span class="PricebasePrice"><?php //echo number_format($product->prices[basePrice],0,'',' ').' руб. '; ?></span>
<?php // Product custom_fields
		if (!empty($product->customfieldsCart)) {
			?>
			<div class="product-fields">
				<?php foreach ($product->customfieldsCart as $field) {  ?>
				<div class="product-field product-field-type-<?php echo $field->field_type ?>">
					<?php if ($field->custom_tip) {
					echo JHTML::tooltip ($field->custom_tip, JText::_ ($field->custom_title), 'tooltip.png');
				} ?></span>
				<?php
					$nomer=0;
					foreach ($field->options as $myfield)
					 {
						if($nomer==0) $tex1=$myfield->text;
						if($nomer==1) { $tex2=$myfield->text; $cena=$myfield->custom_value.' '.($product->prices[basePrice]+$myfield->custom_price); }
						$nomer++;
						//print_r($myfield);
						//echo '<br><br><br>';
					 }
				?>
					<span class="product-field-display"><?php echo str_replace($tex2,$cena.' руб.',str_replace('Без доплаты','',str_replace($tex1,$tex1.$product->prices[basePrice].' руб.',$field->display))); ?></span>

					<span class="product-field-desc"><?php echo $field->custom_field_desc ?></span>
				</div><br/>
				<?php //print_r($field->text);
			}
				?>
			</div>
			<?php
		} ?>
</td><td>
		<!--<div class="addtocart-bar">

			<?php // Display the quantity box

			$stockhandle = VmConfig::get ('stockhandle', 'none');
			if (($stockhandle == 'disableit' or $stockhandle == 'disableadd') and ($product->product_in_stock - $product->product_ordered) < 1) {
				?>
				<a href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&layout=notify&virtuemart_product_id=' . $product->virtuemart_product_id); ?>" class="notify"><?php echo JText::_ ('COM_VIRTUEMART_CART_NOTIFY') ?></a>

				<?php } else { ?>
				<span class="quantity-box">
		<input type="text" class="quantity-input js-recalculate" name="quantity[]" value="<?php if (isset($product->min_order_level) && (int)$product->min_order_level > 0) {
			echo $product->min_order_level;
		} else {
			echo '1';
		} ?>"/>
	    </span>
	    <span class="quantity-controls js-recalculate">
		<input type="button" class="quantity-controls quantity-plus"/>
		<input type="button" class="quantity-controls quantity-minus"/>
	    </span>
				<?php // Display the quantity box END ?>

				<?php
				// Display the add to cart button
				?>
				<span class="addtocart-button"><?php echo shopFunctionsF::getAddToCartButton ($product->orderable); ?></span>
				<?php } ?>

			<div class="clear"></div>
		</div>-->

		<?php // Display the add to cart button END  ?>
		<input type="hidden" class="pname" value="<?php echo $product->product_name ?>"/>
		<input type="hidden" name="option" value="com_virtuemart"/>
		<input type="hidden" name="view" value="cart"/>
		<noscript><input type="hidden" name="task" value="add"/></noscript>
		<input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>"/>
	

</td></tr></table>
</form>
</div>								
			</td>
				

			</tr>
<?php } ?>
</table></div>
<!-- /div removed valerie -->
	<div class="pagination"><?php echo $this->vmPagination->getPagesLinks(); ?><span style="float:right"><?php echo $this->vmPagination->getPagesCounter(); ?></span></div>
<!-- /div removed valerie -->
<?php } elseif ($this->search !==null ) echo JText::_('COM_VIRTUEMART_NO_RESULT').($this->keyword? ' : ('. $this->keyword. ')' : '')
?>
</div><!-- end browse-view -->
