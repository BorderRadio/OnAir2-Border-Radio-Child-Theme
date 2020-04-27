<?php
/*
Package: OnAir2
Description: Item of the podcasts archive
Version: 0.0.0
Author: QantumThemes
Author URI: http://qantumthemes.com
*/
?>
<!-- PODCAST ========================= -->
<div class="qt-part-archive-item qt-item-podcast">
	<div class="qt-item-header">
		<div class="qt-header-top">
			<ul class="qt-tags">
				<li>
					<a href="<?php the_permalink() ?>"><?php the_date() ?></a>
					<span class="fucking-show-title"><?php  echo qantumthemes_get_the_term_list( $post->ID, 'podcastfilter', '', '</li><li>', '' );  ?></span>
				</li>
			</ul>
			<div class="qt-feedback">
	    		<?php 
	    		/**
	    		 *  Display item counters. see functions.php
	    		 */
	    		qantumthemes_item_counters($post->ID, false); 
	    		?>
	    	</div>
	    </div>

		<div class="qt-header-mid qt-vc">
			<div class="qt-vi">
				<a href="<?php the_permalink(); ?>" class="qt-text-shadow">
					<i class="dripicons-media-play qt-text-neg"></i>
				</a>
			</div>
		</div>

		<div class="qt-header-bottom">
			<a href="<?php the_permalink(); ?>" class="qt-btn qt-btn-primary qt-readmore"><i class="dripicons-music"></i></a>
		</div>
		<?php if (has_post_thumbnail()){ ?>
        <div class="qt-header-bg" data-bgimage="<?php echo the_post_thumbnail_url( 'qantumthemes-squared' ); ?>">
            <?php the_post_thumbnail( 'qantumthemes-squared' ); ?>
        </div>
     	<?php } ?>
	</div>

	<div class="qt-item-content-s qt-card">
		<h4 class="qt-ellipsis-2 qt-t">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h4>
	</div>
</div>
<!-- PODCAST END ========================= -->
