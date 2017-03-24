<?php
/**
 *
 * Show the products in a category
 *
 * @package    VirtueMart
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
 * @version $Id: default.php 6556 2012-10-17 18:15:30Z kkmediaproduction $
 */

//vmdebug('$this->category',$this->category);
vmdebug ('$this->category ' . $this->category->category_name);
// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
JHTML::_ ('behavior.modal');
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

$document = JFactory::getDocument ();
$document->addScriptDeclaration ($js);

/*$edit_link = '';
if(!class_exists('Permissions')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'permissions.php');
if (Permissions::getInstance()->check("admin,storeadmin")) {
	$edit_link = '<a href="'.JURI::root().'index.php?option=com_virtuemart&tmpl=component&view=category&task=edit&virtuemart_category_id='.$this->category->virtuemart_category_id.'">
		'.JHTML::_('image', 'images/M_images/edit.png', JText::_('COM_VIRTUEMART_PRODUCT_FORM_EDIT_PRODUCT'), array('width' => 16, 'height' => 16, 'border' => 0)).'</a>';
}

echo $edit_link; */
?>

<h1><?php echo $this->category->category_name; ?></h1>

<div class="horizontal-separator-green"></div>
<?php $category = $this->category; ?>

<div class="category_description">
	<?php echo $this->category->category_description; ?>
</div> 
<?php

/* Show child categories */

if (VmConfig::get ('showCategory', 1) and empty($this->keyword)) {
	if ($this->category->haschildren) {

		// Category and Columns Counter
		$iCol = 1;
		$iCategory = 1;

		// Calculating Categories Per Row
		$categories_per_row = VmConfig::get ('categories_per_row', 1);
		$category_cellwidth = ' width' . floor (100 / $categories_per_row);

		// Separator
		$verticalseparator = " vertical-separator";
		?>

		<div class="category-view">

		<?php // Start the Output
		if (!empty($this->category->children)) {
			foreach ($this->category->children as $category) {

				// Show the horizontal seperator
				if ($iCol == 1 && $iCategory > $categories_per_row) {
					?>
					<div class="horizontal-separator"></div>
					<?php
				}

				// this is an indicator wether a row needs to be opened or not
				if ($iCol == 1) {
					?>
			<div class="row">
			<?php
				}

				// Show the vertical seperator
				if ($iCategory == $categories_per_row or $iCategory % $categories_per_row == 0) {
					$show_vertical_separator = ' ';
				} else {
					$show_vertical_separator = $verticalseparator;
				}

				// Category Link
				$caturl = JRoute::_ ('index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $category->virtuemart_category_id);

				// Show Category
				?>
				<div class="category floatleft<?php echo $category_cellwidth . $show_vertical_separator ?>">
					<div class="spacer">
					<ul class="category_info">
					    <li>
					    	<a href="<?php echo $caturl ?>" title="<?php echo $category->category_name ?>">

								<?php // if ($category->ids) {
									
							    if (!empty($category->images[0]->file_name)) {
							   	    echo $category->images[0]->displayMediaThumb ("", FALSE);
							   	}  ?>
							</a>
					    </li>
					    <li class="category-title">
						<h2>
							<a href="<?php echo $caturl ?>" title="<?php echo $category->category_name ?>">
								<?php echo $category->category_name ?>
								<br/>
							</a>	
						</h2>
							<a href="<?php echo $caturl ?>">
							   <span class="read-more"><?php echo JText::_('COM_VIRTUEMART_FEED_READMORE'); ?></span></a>
						
						</li>
					</ul>	
					</div>
				</div>
				<?php
				$iCategory++;

				// Do we need to close the current row now?
				if ($iCol == $categories_per_row) {
					?>
					<div class="clear"></div>
		</div>
			<?php
					$iCol = 1;
				} else {
					$iCol++;
				}
			}
		}
		// Do we need a final closing row tag?
		if ($iCol != 1) {
			?>
			<div class="clear"></div>
		</div>
	<?php } ?>
	</div>

	<?php
	}
}
?>
<div class="browse-view no-margin">
<?php
if (!empty($this->keyword)) {
	?>
<h3><?php echo $this->keyword; ?></h3>
	<?php
} ?>
<?php if ($this->search !== NULL) { ?>
<form action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=category&limitstart=0&virtuemart_category_id=' . $this->category->virtuemart_category_id); ?>" method="get">

	<!--BEGIN Search Box -->
	<div class="virtuemart_search">
		<?php echo $this->searchcustom ?>
		<br/>
		<?php echo $this->searchcustomvalues ?>
		<input name="keyword" class="inputbox" type="text" size="20" value="<?php echo $this->keyword ?>"/>
		<input type="submit" value="<?php echo JText::_ ('COM_VIRTUEMART_SEARCH') ?>" class="button" onclick="this.form.keyword.focus();"/>
	</div>
	<input type="hidden" name="search" value="true"/>
	<input type="hidden" name="view" value="category"/>

</form>
<!-- End Search Box -->
	<?php } ?>



<?php // Show child categories
if (!empty($this->products)) {
	?>

	<div class="orderby-displaynumber">
				<div style="float:left"><a href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><span class="pviewed">Просмотренныe</span></a></div>
				<div class="pagination">
				    
					
<ul class="pagination-top">
   
  <li class="counter">
<?php echo $this->vmPagination->getResultsCounter(); ?>
	</li>
	<li class="form-limit">
		<label for="limit">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
		</label>
		<?php echo $this->vmPagination->getLimitBox(); ?>
	</li>
</ul>	


				</div>

			</div> <!-- end of orderby-displaynumber -->



     
     <table class="products-table"> 
        <tr>
        <th></th>
        <th class="td-tovar"><span><?php echo JText::_ ('COM_VIRTUEMART_PRODUCTDETAILS_PRODUCT') ?></span></th>
        <th><?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_PRICE_FORPACK') ?></th>
        <th><?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_DESC') ?></th>
        </tr>


	<?php

	// Start the Output
	foreach ($this->products as $product) {

		// Show Products
		?>
		<tr>
		   <td>
		    <a title="<?php echo $product->link ?>" rel="vm-additional-images" href="<?php echo $product->link; ?>">
						<?php
						if ($product->images[0]->file_name) { ?>
						  <img class="category-image" border="0"  src="<?php echo $product->images[0]->file_url ?>">

						  <?php 
						}
							//echo $product->images[0]->displayMediaThumb('class="browseProductImage"', false);
						
						?>
					 </a>
					
			</td>
		    <td width="40%" class="td-tovar">
		
		
				<span class="product-title"><?php echo JHTML::link ($product->link, $product->product_name); ?></span>

					
			</td>
			<td width="20%">			

					<div class="product-price" id="productPrice<?php echo $product->virtuemart_product_id ?>">
						<?php
						if ($this->show_prices == '1') {
							if ($product->prices['priceWithoutTax'] > $product->prices['salesPrice']) {
								echo '<span class="price-crossed">'.$this->currency->createPriceDiv ('priceWithoutTax','', $product->prices)."</span>";
								echo $this->currency->createPriceDiv ('salesPrice', '', $product->prices);
							} else {
						        echo $this->currency->createPriceDiv ('priceWithoutTax','', $product->prices);

						    }
						} ?>

					</div>
				</td>
				<td>	

				

	<a href="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='. $product->virtuemart_product_id); ?>"><span class="details_icon"></span></a>

				</td>	

		</tr>
			<?php
			
	} // end of foreach ( $this->products as $product )
	
	?>
	</table>

<div class="pagination"><?php echo $this->vmPagination->getPagesLinks (); ?></div>

	<?php
} elseif ($this->search !== NULL) {
	echo JText::_ ('COM_VIRTUEMART_NO_RESULT') . ($this->keyword ? ' : (' . $this->keyword . ')' : '');
}
?>
</div><!-- end browse-view -->