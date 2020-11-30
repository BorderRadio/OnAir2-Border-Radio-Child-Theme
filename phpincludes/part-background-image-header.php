 <?php 
/*
Package: OnAir2
Description: Header background from page or customizer
Version: 0.0.0
Author: QantumThemes
Author URI: http://qantumthemes.com
*/

if( (is_singular() || is_home() || is_front_page()) && has_post_thumbnail()){
	?>
	<div class="qt-header-bg" data-bgimage="<?php echo the_post_thumbnail_url( 'qantumthemes-xl' ); ?>" data-bgattachment="" data-parallax="1">
	</div>
	<?php
} else {
	$image_from_customizer = get_theme_mod( 'qt_header_backgroundimage', '' );
	/**
	 * since 1.9.9 // updated in 2.0.5
	 * Check for custom background addable via QT custom category plugin
	 */
	if(is_category() || is_tax('podcastfilter') || is_tax('eventtype')){

		if(is_category()){
			// $category = get_category( get_query_var( 'cat' ) );
			$catid = get_query_var( 'cat' );
		}

		/**
		 * since 2.0.5 // support for custom images in podcast categories
		 */
		if(is_tax('podcastfilter')){
			$slug = get_query_var( 'podcastfilter' );
			$term = get_term_by('slug',  $slug,  'podcastfilter');
			$catid = $term->term_id;
		} else if(is_tax('eventtype')){
			$slug = get_query_var( 'eventtype' );
			$term = get_term_by('slug',  $slug,  'eventtype');
			$catid = $term->term_id;
		}
		if(!empty( $catid)){
			$image_id =  get_term_meta($catid, 'qt_category_img_id', true);
			if($image_id){
				$image_from_customizer = wp_get_attachment_url ( $image_id, 'full' ); 
			}
		}
	}

	if($image_from_customizer != '') {
		?>
			<div class="qt-header-bg" data-bgimage="<?php echo esc_url($image_from_customizer); ?>" data-bgattachment="" data-parallax="1">
			</div>
		<?php  
	}
}
