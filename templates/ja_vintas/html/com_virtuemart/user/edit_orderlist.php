<?php
/**
*
* User details, Orderlist
*
* @package	VirtueMart
* @subpackage User
* @author Oscar van Eijk
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: edit_orderlist.php 5351 2012-02-01 13:40:13Z alatak $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access'); ?>

<div id="editcell">
	<table class="adminlist tbl-list">
	<thead>
	<tr>
		<th>
			<?php echo JText::_('COM_VIRTUEMART_ORDER_LIST_ORDER_NUMBER'); ?>
		</th>
		<th>
			<?php echo JText::_('COM_VIRTUEMART_ORDER_LIST_CDATE'); ?>
		</th>
		<th>
			<?php echo JText::_('COM_VIRTUEMART_ORDER_LIST_MDATE'); ?>
		</th>
		<th>
			<?php echo JText::_('COM_VIRTUEMART_ORDER_LIST_STATUS'); ?>
		</th>
		<th>
			<?php echo JText::_('COM_VIRTUEMART_ORDER_LIST_TOTAL'); ?>
		</th>
	</thead>
	<?php
		$k = 0;
		foreach ($this->orderlist as $i => $row) {
			$editlink = JRoute::_('index.php?option=com_virtuemart&view=orders&layout=details&order_number=' . $row->order_number);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="left">
					<a href="<?php echo $editlink; ?>"><?php echo $row->order_number; ?></a>
				</td>
				<td align="left">
					<?php echo JHTML::_('date', $row->created_on); ?>
				</td>
				<td align="left">
					<?php echo JHTML::_('date', $row->modified_on); ?>
				</td>
				<td align="left">
					<?php echo ShopFunctions::getOrderStatusName($row->order_status); ?>
				</td>
				<td align="left" class="price">
					<?php echo $this->currency->priceDisplay($row->order_total); ?>
				</td>
			</tr>
	<?php
			$k = 1 - $k;
		}
	?>
	</table>
	<?php
 
 
        function getRecentProducts($currentId){
            $actualIds=false;
            $rProducts=false;
 
            $rSession = JFactory::getSession();
            $rIds = $rSession->get('vmlastvisitedproductids', array(), 'vm'); // get recent viewed from browser session
            if (is_array($rIds)){ 
                foreach($rIds as $rId){
                    if ($rId!=$currentId) $actualIds[]=$rId; // cut out from array currently viewed product 
                }  
            }
 
            if (is_array($actualIds)){
                if (!class_exists('VirtueMartModelProducts')) // check possible if VM products class exists
                    JModel::addIncludePath(JPATH_VM_ADMINISTRATOR . DS . 'models'); // if not exists, add them
                $rModel = JModel::getInstance('Product', 'VirtueMartModel');
 
                $recent_products_rows = VmConfig::get('recent_products_rows'); // set in VM admin panel
                $products_per_row = VmConfig::get('homepage_products_per_row'); // set in VM admin panel
                $recent_products_count = $products_per_row * $recent_products_rows; // get max recent products count
 
                $rProducts = $rModel->getProducts($actualIds, false, false);  // no front, no calc, only published
            }
            if (is_array($rProducts)) $rProducts=array_slice($rProducts,0,$recent_products_count); // return only allowed num of products
 
            return $rProducts;
        }
 
        $recentProducts=getRecentProducts($this->product->virtuemart_product_id);
        if ($recentProducts){ // if we get recent products, display them
        ?>
        <div style="margin-top: 45px;" class="product-recent-products">
            <h2>Недавно просмотренные товары:</h2>
            <ul class="recent-list">
                <?php
                    foreach ($recentProducts as $rProduct) {
                    ?>
                    <li>
                        <a href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$rProduct->virtuemart_product_id.'&virtuemart_category_id='.$rProduct->virtuemart_category_id); ?>">
                            <?php echo $rProduct->product_name; ?>
                        </a>
                    </li>
                    <?php } ?>
            </ul>
        </div>
        <?php }?>
</div>
