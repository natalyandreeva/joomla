<?php
defined('_JEXEC') or die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/*
 * Module mod_virtuemart_randcatproduct
 * @package VirtueMart
 * @copyright (C) 2013 - Andrew Zahalski
 * www.pusk.ws
 */

 
 
if (!class_exists( 'VmConfig' )) require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');
$mainframe = Jfactory::getApplication();
// параметры
$category_id = JRequest::getInt('virtuemart_category_id',0);
$product_id = JRequest::getInt('virtuemart_product_id',0);
$virtuemart_currency_id = $mainframe->getUserStateFromRequest( "virtuemart_currency_id", 'virtuemart_currency_id',JRequest::getInt('virtuemart_currency_id',0) );
$show_all = $params->get('show_all',1);
$layout = $params->get('layout','default');
$categorymod = $params->get( 'category', 1 );
$stock = $params->get( 'stock', 1 );
$cur_product = $params->get( 'cur_product', 1 );
$kol = $params->get( 'kol', 9 );
$show_price = $params->get( 'show_price', 1 );
$show_addcart = $params->get( 'show_addcart', 1 );
$kolstr = $params->get( 'kolstr', 3 );
$show_car = $params->get( 'show_car', 0 );
$vidthcar = $params->get( 'shirinastr', 654 );
$show_jquery = $params->get( 'show_jquery', 0 );
$cached = $params->get( 'cached', 1 );
$virtuemart_category_idn = $params->get( 'virtuemart_category_idn', 0 );
$vmmanufacturer_idn = $params->get( 'vmmanufacturer_idn', 0 );
$cur_manufacturer = $params->get( 'cur_manufacturer', 0 );
$stepcarusel = $params->get( 'stepcarusel', 1 );
if($show_car==1) {
$ed = round(($vidthcar/$kolstr),0);
$width = $ed;
//$width=round((100/$kolstr),2).'%';
}
elseif($show_car==0){
$width=round((100/$kolstr),2).'%';
}

if(($product_id>0 and $show_all==1) or ($show_all==0)){

$doc = JFactory::getDocument();
$doc->addStyleSheet('/modules/mod_virtuemart_randcatproduct/assets/style.css');
if($show_car==1) {
if($show_jquery==1){
$doc->addScript('http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js');
}
$doc->addScript('/modules/mod_virtuemart_randcatproduct/assets/jquery.jcarousel.min.js');
$jser='
jQuery(document).ready(function() {
    // Initialise the first and second carousel by class selector.
	// Note that they use both the same configuration options (none in this case).
	jQuery(".d-carousel .carousel").jcarousel({
        scroll: '.$stepcarusel.'
    });
});
';
$doc->addScriptDeclaration($jser);
}

//формируем ключ для кеширования
$key = 'mod_virtuemart_randcatproduct.'.$category_id.'.'.$product_id.'.'.$vmmanufacturer_idn.'.'.$virtuemart_category_idn;
$cache	= JFactory::getCache('mod_virtuemart_randcatproduct', 'output');
if($cached==1){
	if($categorymod==3){
	$cache->setCaching(0);
	}else{
	$cache->setCaching(1);
	}
}
/* Load  VM function */
if (!class_exists( 'mod_virtuemart_product' )) require('helper.php');
if (!($output = $cache->get($key))) {
	ob_start();
	if($categorymod!=3){
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('c.virtuemart_product_id');
		$query->from('#__virtuemart_product_categories as c');
		$query->from('#__virtuemart_products as p');
		$query->where("c.virtuemart_product_id = p.virtuemart_product_id");
		$query->where("p.published='1'");
		if($stock==1) {
		$query->where("p.product_in_stock>0");
		}
		if($category_id>0 and $categorymod=='1'){
		$query->where("c.virtuemart_category_id = '".$category_id."'");
		}
		if($virtuemart_category_idn>0 and $categorymod=='2') {
		$query->where("c.virtuemart_category_id = '".$virtuemart_category_idn."'");
		}
		if($product_id>0 and $cur_product=='1'){
		$query->where("c.virtuemart_product_id != '".$product_id."'");
		}
		if(($vmmanufacturer_idn>0 and $product_id==0) or ($product_id>0 and $cur_manufacturer==2)){
		$query->from('#__virtuemart_product_manufacturers as m');
		$query->where("m.virtuemart_product_id = p.virtuemart_product_id AND p.virtuemart_product_id = c.virtuemart_product_id");
		$query->where("m.virtuemart_manufacturer_id = '".$vmmanufacturer_idn."'"); 
		}
		elseif($product_id>0 and $cur_manufacturer==1) {
		$vmmanufacturer_idn_curent = mod_virtuemart_product::productattrmanufacturerid($product_id);
			if($vmmanufacturer_idn_curent){
				$query->from('#__virtuemart_product_manufacturers as m');
				$query->where("m.virtuemart_product_id = p.virtuemart_product_id AND p.virtuemart_product_id = c.virtuemart_product_id");
				$query->where("m.virtuemart_manufacturer_id = '".$vmmanufacturer_idn_curent."'");
			}
		}
		$query->order("RAND()");
		$db->setQuery($query,0,$kol);
		$ids = $db->loadResultArray();
	}
	else
	{ //последние просмотренные товары
	$ids = mod_virtuemart_product::getfulladdProductToRecent();
	if($product_id>0) mod_virtuemart_product::fulladdProductToRecent($product_id, $kol);
	}
$productModel = VmModel::getModel('Product');
$products = $productModel->getProducts($ids);
$productModel->addImages($products);
if(empty($products)) return false; //если ничего нет вернем false
$currency = CurrencyDisplay::getInstance( );
if ($show_addcart) {
vmJsApi::jPrice();
vmJsApi::cssSite();
}

/* Load tmpl default */
require(JModuleHelper::getLayoutPath('mod_virtuemart_randcatproduct',$layout));
	$output = ob_get_clean();
	$cache->store($output, $key);
}
echo $output;

}

?>
