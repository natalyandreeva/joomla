<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();
?>
<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search');?>" method="post" class="clearfix">

	<div class="btn-toolbar">
		<div class="btn-group pull-left">
			<input type="text" name="searchword" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="inputbox" />
		</div>
		<div class="btn-group pull-left">
			<button name="Search" onclick="this.form.submit()" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('COM_SEARCH_SEARCH');?>"><span class="icon-search"></span><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
		</div>
		<input type="hidden" name="task" value="search" />
		<div class="clearfix"></div>
	</div>

	<?php if ($this->params->get('search_phrases', 1)) : ?>
		<fieldset class="phrases">
			<legend><?php echo JText::_('COM_SEARCH_FOR');?>
			</legend>
				<div class="phrases-box">
				<?php echo $this->lists['searchphrase']; ?>
				</div>
				<div class="ordering-box">
				<label for="ordering" class="ordering">
					<?php echo JText::_('COM_SEARCH_ORDERING');?>
				</label>
				<?php echo $this->lists['ordering'];?>
				</div>
		</fieldset>
	<?php endif; ?>

	<?php if ($this->params->get('search_areas', 1)) : ?>
		<fieldset class="only">
			<legend><?php echo JText::_('COM_SEARCH_SEARCH_ONLY');?></legend>
			<?php foreach ($this->searchareas['search'] as $val => $txt) :
				$checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : '';
			?>
			<label for="area-<?php echo $val;?>" class="checkbox">
				<input type="checkbox" name="areas[]" value="<?php echo $val;?>" id="area-<?php echo $val;?>" <?php echo $checked;?> >
				<?php echo JText::_($txt); ?>
			</label>
			<?php endforeach; ?>
		</fieldset>
	<?php endif; ?>

    <div class="searchintro<?php echo $this->params->get('pageclass_sfx'); ?>">
		<?php if (!empty($this->searchword)):?>
		<p><?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', '<span class="search_pattern">' . $this->origkeyword . '</span>', $this->total);?></p>
		<?php endif;?>
	</div>
    <div class="horizontal-separator-yellow "></div>
<?php if ($this->total > 0) : ?>
<ul class="pagination-top">
  <li class="counter">
<?php echo $this->pagination->getResultsCounter(); ?>
	</li>
	<li class="form-limit">
		<label for="limit">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
		</label>
		<?php echo $this->pagination->getLimitBox(); ?>
	</li>
</ul>	

<?php endif; ?>

</form>
