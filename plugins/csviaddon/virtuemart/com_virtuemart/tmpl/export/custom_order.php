<?php
/**
 * @package     CSVI
 * @subpackage  VirtueMart
 *
 * @author      RolandD Cyber Produksi <contact@csvimproved.com>
 * @copyright   Copyright (C) 2006 - 2017 RolandD Cyber Produksi. All rights reserved.
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @link        https://csvimproved.com
 */

defined('_JEXEC') or die;

$form = $this->forms->custom_order;
?>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('language', 'jform')->labelClass; ?>" for="<?php echo $form->getField('language', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('language', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('language', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('language', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('language', 'jform')->id); ?>
		</span>
	</div>
</div>

<?php if ($this->operation != 'snelstart' && $this->operation != 'orderadvanced'): ?>
<div class="control-group">
	<label class="control-label <?php echo $form->getField('splitorderline', 'jform')->labelClass; ?>" for="<?php echo $form->getField('splitorderline', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('splitorderline', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('splitorderline', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('splitorderline', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('splitorderline', 'jform')->id); ?>
		</span>
	</div>
</div>
<?php endif;?>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('ordernostart', 'jform')->labelClass; ?>" for="<?php echo $form->getField('ordernostart', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('ordernostart', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('ordernostart', 'jform'); ?>
		<?php echo $form->getInput('ordernoend', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('ordernostart', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('ordernostart', 'jform')->id); ?>
			/
			<?php echo str_replace('jform_', 'form.', $form->getField('ordernoend', 'jform')->id); ?>
		</span>
	</div>
</div>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('orderlist', 'jform')->labelClass; ?>" for="<?php echo $form->getField('orderlist', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('orderlist', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('orderlist', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('orderlist', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('orderlist', 'jform')->id); ?>
		</span>
	</div>
</div>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('orderdaterange', 'jform')->labelClass; ?>" for="<?php echo $form->getField('orderdaterange', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('orderdaterange', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('orderdaterange', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('orderdaterange', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('orderdaterange', 'jform')->id); ?>
		</span>
	</div>
</div>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('orderdatestart', 'jform')->labelClass; ?>" for="<?php echo $form->getField('orderdatestart', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('orderdatestart', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('orderdatestart', 'jform'); ?>
		<?php echo $form->getInput('orderdateend', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('orderdatestart', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('orderdatestart', 'jform')->id); ?>
			/
			<?php echo str_replace('jform_', 'form.', $form->getField('orderdateend', 'jform')->id); ?>
		</span>
	</div>
</div>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('ordermdatestart', 'jform')->labelClass; ?>" for="<?php echo $form->getField('ordermdatestart', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('ordermdatestart', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('ordermdatestart', 'jform'); ?>
		<?php echo $form->getInput('ordermdateend', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('ordermdatestart', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('ordermdatestart', 'jform')->id); ?>
			/
			<?php echo str_replace('jform_', 'form.', $form->getField('ordermdateend', 'jform')->id); ?>
		</span>
	</div>
</div>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('orderstatus', 'jform')->labelClass; ?>" for="<?php echo $form->getField('orderstatus', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('orderstatus', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('orderstatus', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('orderstatus', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('orderstatus', 'jform')->id); ?>
		</span>
	</div>
</div>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('orderpayment', 'jform')->labelClass; ?>" for="<?php echo $form->getField('orderpayment', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('orderpayment', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('orderpayment', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('orderpayment', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('orderpayment', 'jform')->id); ?>
		</span>
	</div>
</div>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('ordershipment', 'jform')->labelClass; ?>" for="<?php echo $form->getField('ordershipment', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('ordershipment', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('ordershipment', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('ordershipment', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('ordershipment', 'jform')->id); ?>
		</span>
	</div>
</div>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('order_address', 'jform')->labelClass; ?>" for="<?php echo $form->getField('order_address', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('order_address', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('order_address', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('order_address', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('order_address', 'jform')->id); ?>
		</span>
	</div>
</div>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('ordermanufacturer', 'jform')->labelClass; ?>" for="<?php echo $form->getField('ordermanufacturer', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('ordermanufacturer', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('ordermanufacturer', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('ordermanufacturer', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('ordermanufacturer', 'jform')->id); ?>
		</span>
	</div>
</div>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('ordercurrency', 'jform')->labelClass; ?>" for="<?php echo $form->getField('ordercurrency', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('ordercurrency', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('ordercurrency', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('ordercurrency', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('ordercurrency', 'jform')->id); ?>
		</span>
	</div>
</div>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('orderpricestart', 'jform')->labelClass; ?>" for="<?php echo $form->getField('orderpricestart', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('orderpricestart', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<?php echo $form->getInput('orderpricestart', 'jform'); ?>
		<?php echo $form->getInput('orderpriceend', 'jform'); ?>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('orderpricestart', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('orderpricestart', 'jform')->id); ?>
			/
			<?php echo str_replace('jform_', 'form.', $form->getField('orderpriceend', 'jform')->id); ?>
		</span>
	</div>
</div>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('orderuser', 'jform')->labelClass; ?>" for="<?php echo $form->getField('orderuser', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('orderuser', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<div class="pull-left">
			<?php echo $form->getInput('orderuser', 'jform'); ?>
		</div>
		<div class="pull-left ordersearch">
			<div id="searchuser"><input type="text" name="searchuserbox" id="searchuserbox" placeholder="<?php echo JText::_('COM_CSVI_SEARCH'); ?>" /></div>
			<div class="clr"></div>

			<div>
				<table id="selectuserid" class="table table-striped">
					<thead>
						<tr>
							<th>
								<?php echo JText::_('COM_CSVI_EXPORT_USER_ID'); ?>
							</th>
							<th>
								<?php echo JText::_('COM_CSVI_EXPORT_USERNAME');?>
							</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		<div class="clr"></div>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('orderuser', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('orderuser', 'jform')->id); ?>
		</span>
	</div>
</div>

<div class="control-group">
	<label class="control-label <?php echo $form->getField('orderproduct', 'jform')->labelClass; ?>" for="<?php echo $form->getField('orderproduct', 'jform')->id; ?>">
		<?php echo JText::_('COM_CSVI_' . $form->getField('orderproduct', 'jform')->id . '_LABEL'); ?>
	</label>
	<div class="controls">
		<div class="pull-left">
			<?php echo $form->getInput('orderproduct', 'jform'); ?>
		</div>
		<div class="pull-left ordersearch">
			<div id="searchproduct">
				<input type="text" name="searchproductbox" id="searchproductbox" placeholder="<?php echo JText::_('COM_CSVI_SEARCH'); ?>" />
			</div>
			<div class="clr"></div>

			<div>
				<table id="selectproductsku" class="table table-striped">
					<thead>
					<tr>
						<th class="dialog-hide">
							<?php echo JText::_('COM_CSVI_EXPORT_PRODUCT_ID'); ?>
						</th>
						<th>
							<?php echo JText::_('COM_CSVI_EXPORT_PRODUCT_SKU'); ?>
						</th>
						<th>
							<?php echo JText::_('COM_CSVI_EXPORT_PRODUCT_NAME');?>
						</th>
					</tr>
					</thead>
				</table>
			</div>
		</div>
		<div class="clr"></div>
		<span class="help-block">
			<?php echo JText::_('COM_CSVI_' . $form->getField('orderproduct', 'jform')->id . '_DESC'); ?>
		</span>
		<span class="cron-block">
			<?php echo str_replace('jform_', 'form.', $form->getField('orderproduct', 'jform')->id); ?>
		</span>
	</div>
</div>
