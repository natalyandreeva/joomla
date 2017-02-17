<?php
/**
 * Photo text slider
 *
 * @package Photo text slider
 * @subpackage Photo text slider
 * @version   1.0 March, 2012
 * @author    Gopi.R
 * @copyright Copyright (C) 2010 - 2012 www.gopiplus.com, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */
 
// no direct access
defined('_JEXEC') or die;

@$pts_direction = @$args['pts_direction'];
@$pts_speed = @$args['pts_speed'];
@$pts_timeout = @$args['pts_timeout'];
@$pts_name = @$args['pts_name'];

if (!is_numeric($pts_speed)) { $pts_speed = 700; }
if (!is_numeric($pts_timeout)) { $pts_timeout = 5000; }
?>
<!-- begin wp_50_photo -->
<div id="<?php echo @$pts_name; ?>">
<?php
if ( ! empty($items) ) 
{
	foreach ( $items as $item ) 
	{
		$wp_50_path = $item->pts_imge;
		$wp_50_link =  $item->pts_link;
		$wp_50_target =  "";
		$wp_50_title =  $item->pts_title;
		$wp_50_desc =  $item->pts_desc;
		?>
		<div class="post">
			<?php if($wp_50_title <> "") { ?><h2><?php echo $wp_50_title; ?></h2><?php } ?>
			<div class="thumb">
			<?php if($wp_50_link <> "") { ?><a target="<?php echo $wp_50_target; ?>" href="<?php echo $wp_50_link; ?>"><?php } ?>
			<?php if($wp_50_path <> "") { ?><img style="border: 0px; margin: 0px;" src="<?php echo $wp_50_path; ?>" alt="" /><?php } ?>
			<?php if($wp_50_link <> "") { ?></a><?php } ?>
			</div>
			<?php if($wp_50_desc <> "") { ?><p><?php echo $wp_50_desc; ?></p><?php } ?>
		</div>
		<?php
	}
}
?>
</div>
<script type="text/javascript">
	$(function() {
	$('#<?php echo @$pts_name; ?>').cycle({
		fx: '<?php echo @$pts_direction; ?>',
		speed: <?php echo @$pts_speed; ?>,
		timeout: <?php echo @$pts_timeout; ?>
	});
	});
	</script> 
<!-- end wp_50_photo -->