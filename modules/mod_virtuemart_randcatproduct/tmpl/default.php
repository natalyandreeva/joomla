<?php // no direct access
defined ('_JEXEC') or die('Restricted access');
$i=0;

if($show_car==0) {

echo'<div id="mod_rand">';
foreach ($products as $product) {
if(fmod($i,$kolstr)==0 and $i!=0){
echo'<div class="mod_rand_clear"></div>';
}
echo'<div class="mod_rand_product" style="width:'.$width.';"><div class="mod_rand_product_wrap">';
	if (!empty($product->images[0])) {
		$image = $product->images[0]->displayMediaThumb ('class="featuredProductImage" border="0"', FALSE);
	} else {
		$image = '';
	}
	echo'<div class="mod_rand_image">
	'.JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => $product->product_name)).'
	</div>';
	$url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' .
						$product->virtuemart_category_id);
	echo '<div class="mod_rand_naz"><a href="'.$url.'">'.$product->product_name.'</a></div>';
	if ($show_price==1){
	echo'<div class="mod_rand_price">';
			if (!empty($product->prices['salesPrice'])) {
				echo $currency->createPriceDiv ('salesPrice', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
			}
			if (!empty($product->prices['salesPriceWithDiscount'])) {
				echo $currency->createPriceDiv ('salesPriceWithDiscount', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
			}
	echo'</div>';
	}
	if($show_addcart==1) {
	echo'<div class="mod_rand_addcart">';
	echo mod_virtuemart_product::addtocart ($product);
	echo'</div>';
	}
echo'</div></div>';
$i++;
}
echo'</div>';

}elseif($show_car==1) {

echo'<div id="mod_rand">';
echo '<div class="d-carousel" style="width:'.(($width*$kolstr)).'px;"><ul class="carousel" style="width:'.($width*count($products)).'px">';
foreach ($products as $product) {
echo '<li class="b-carousel-block" style="width:'.$width.'px;">';
echo'<div class="mod_rand_product"><div class="mod_rand_product_wrap">';
	if (!empty($product->images[0])) {
		$image = $product->images[0]->displayMediaThumb ('class="featuredProductImage" border="0"', FALSE);
	} else {
		$image = '';
	}
	echo'<div class="mod_rand_image">
	'.JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => $product->product_name)).'
	</div>';
	$url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' .
						$product->virtuemart_category_id);
	echo '<div class="mod_rand_naz"><a href="'.$url.'">'.$product->product_name.'</a></div>';
	if ($show_price==1){
	echo'<div class="mod_rand_price">';
			if (!empty($product->prices['salesPrice'])) {
				echo $currency->createPriceDiv ('salesPrice', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
			}
			if (!empty($product->prices['salesPriceWithDiscount'])) {
				echo $currency->createPriceDiv ('salesPriceWithDiscount', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
			}
	echo'</div>';
	}
	if($show_addcart==1) {
	echo'<div class="mod_rand_addcart">';
	echo mod_virtuemart_product::addtocart ($product);
	echo'</div>';
	}
	echo'</div></div>';
echo '</li>';
$i++;
}
echo'</ul></div>';
echo'</div>';
}
?>