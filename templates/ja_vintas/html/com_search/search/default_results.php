<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>


<div class="search-results<?php echo $this->pageclass_sfx; ?>">
<?php foreach ($this->results as $result) : ?>
	<?php if ($result->category_path) : ?>
			<span class="result-section">
				<?php echo $result->category_path; ?>
			</span>
	<?php endif; ?>
	<ul class="search-table clearfix">
	    <li class="result-image">
	        <div class="img-intro-left ?>">
			<?php
			if (!empty($result->image->file_url)) { ?>
				<img class="category-image" border="0"  src="<?php echo $result->image->file_url ?>">
				<?php
				//echo $result->image->displayMediaThumb ('', FALSE);
			} else {
			?>
			<img  src="components/com_virtuemart/assets/images/vmgeneral/noimage.gif" >
			<?php } ?>
			</div>
		</li>			
	<li class="result-title">
		<?php $result->title = str_ireplace($this->origkeyword, "<i>".$this->origkeyword."</i>", $result->title);?>
		<?php if ($result->href) :?>
			<a href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) :?> target="_blank"<?php endif;?>>
				<?php echo $result->title;?>
			</a>
		<?php else:?>
			<?php echo $result->title;?>
		<?php endif; ?>
		<br /><a href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) :?> target="_blank"<?php endif;?>><span class="read-more"><?php echo JText::_('COM_CONTENT_FEED_READMORE'); ?></span></a>
	</li>
	</ul>
	
<?php endforeach; ?>
</div>

<div class="pagination">

	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
