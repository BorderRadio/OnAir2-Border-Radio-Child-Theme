<?php
/*
Package: OnAir2
Description: Post item normal
Version: 0.0.0
Author: QantumThemes
Author URI: http://qantumthemes.com
*/
?>
<!-- POST ITEM ========================= -->
<div id="post-<?php the_ID(); ?>" <?php post_class( "qt-part-archive-item col s12 m6 l4" ); ?>>
	<div class="qt-item-header">
		<div class="qt-header-top">
			<ul class="qt-tags">
				<li>
					<?php the_category('</li><li>'); ?>
				</li>
			</ul>
			<div class="qt-feedback">
	    		<?php
	    		/**
	    		 *  Display item counters. see functions.php
	    		 */
	    		qantumthemes_item_counters($post->ID, true);
	    		?>
	    	</div>
	    </div>
		<div class="qt-header-mid qt-vc">
			<div class="qt-vi">
		  		<h3 class="qt-title qt-ellipsis-2 qt-t">
					<a href="<?php the_permalink(); ?>" class="qt-text-shadow">
						<?php the_title(); ?>
					</a>
				</h3>
			</div>
		</div>
		<div class="qt-header-bottom">
			<?php get_template_part('phpincludes/part-item-metas' ); ?>
			<a href="<?php the_permalink(); ?>" class="qt-btn qt-btn-primary qt-readmore"><i class="<?php qantumthemes_format_icon_class($post->ID); ?>"></i></a>
		</div>
		<?php if (has_post_thumbnail()){ ?>
        <div class="qt-header-bg" data-bgimage="<?php echo the_post_thumbnail_url( 'large' ); ?>">
            <?php the_post_thumbnail( 'large' ); ?>
        </div>
     	<?php } ?>
	</div>

	<div class="qt-item-content qt-card qt-the-content">
		<h4 class="qt-ellipsis-2 qt-t">
			<?php the_excerpt(); ?>
		</h4>
				
	</div>
</div>
<!-- POST ITEM END ========================= -->
