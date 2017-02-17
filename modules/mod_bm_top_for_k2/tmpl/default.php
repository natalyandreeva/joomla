<?php
/**
 * @package     mod_bm_slider_for_k2
 * @author      brainymore.com
 * @email       brainymore@gmail.com
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if(!empty($list)):
	if(isset($list[0]))
	{
		$main_item = $list[0];
		unset($list[0]);
	}
?>
<div class="bm_articles_top bm_aticled_top_<?php echo $theme;?> <?php echo $moduleclass_sfx;?>">
	<div class="bm_articles_top_all">
		<div class="bm_top_first">
			<div class="bm_top_img">
				<a href="<?php echo $params->get('addLinkToImage')? $main_item->link : "javascript:void(0)"; ?>" >
					<span class="bm_rollover" ><i class="fa fa-link"></i></span>
					<img src="<?php echo htmlspecialchars($main_item->image); ?>" alt="<?php echo htmlspecialchars($main_item->title); ?>" />
				</a>
			</div>
			<div class="bm_top_content">
				<div class="bm_top_title">
					<a href="<?php echo $main_item->link; ?>" title="<?php echo htmlspecialchars($main_item->title); ?>"><?php echo JHTML::_('string.truncate', ( $main_item->title ), $params->get('title_limit',50)); ?></a>	
				</div>
				
				<?php if($show_desc):?>
					<div class="bm_top_desc">
						<div>
							 <?php echo JHTML::_('string.truncate', ( $main_item->introtext ), $params->get('readmore_limit',200)); ?>
							<?php if($show_readmore):?>
								<a class="bm_readmore" href="<?php echo $main_item->link; ?>" title="<?php echo htmlspecialchars($main_item->title); ?>">
									<?php echo JText::_($readmore_label); ?>
								</a>
							<?php endif;?>
						</div>
					</div>
				<?php endif;?>
				
			</div>
		</div>
		<?php
			$style="";
			if($theme != 'theme1' && $theme != 'theme5')
			{
				$width = 100;
				if($count = count($list))
				{
					$width = round(100/$count);
				}
				$style = "style='width:".$width."%'";
			}
		?>
		<div class="bm_top_second">
			<?php foreach ($list as $item) : ?> 
				<div class="bm_top_item" <?php echo $style;?>>
                	<?php if($show_thumb):?>
					<div class="bm_top_item_img">
						<a href="<?php echo $params->get('addLinkToImage')? $item->link : "javascript:void(0)"; ?>" >
                        	<span class="bm_rollover" ><i class="fa fa-link"></i></span>
							<img src="<?php echo htmlspecialchars($item->thumb); ?>" alt="<?php echo htmlspecialchars($item->title); ?>" class="cubeRandom" />
						</a>
					</div>
                    <?php endif;?>
					<div class="bm_top_item_content">
						<div class="bm_item_top_title">
							<a href="<?php echo $item->link; ?>" title="<?php echo htmlspecialchars($item->title); ?>"><?php echo JHTML::_('string.truncate', ( $item->title ), $params->get('title_limit',50)); ?></a>
						</div>				
						<?php if($show_desc_small):?>
							<div class="bm_item_top_desc">
								<div>
									 <?php echo JHTML::_('string.truncate', ( $item->introtext ), $params->get('readmore_limit2',100)); ?>
									<?php if($show_readmore):?>
										<a class="bm_readmore" href="<?php echo $item->link; ?>" title="<?php echo htmlspecialchars($item->title); ?>">
											<?php echo JText::_($readmore_label); ?>
										</a>
									<?php endif;?>
								</div>
							</div>
						<?php endif;?>				
					</div>
				</div>
			<?php endforeach; ?>		
		</div>
	</div>
</div>

<?php else: ?>
	<div class="bm-nodata"><?php echo JText::_('Found no item!');?></div>
<?php endif;?>