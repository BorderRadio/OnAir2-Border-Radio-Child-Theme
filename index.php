<?php
/*
Package: OnAir2
Description: Standard blog index
Version: 0.0.0
Author: QantumThemes
Author URI: http://qantumthemes.com
*/
?>
<?php get_header(); ?> 
    <?php  
    get_template_part ('phpincludes/menu');
    get_template_part ('phpincludes/part-searchbar'); 
    ?>
    <div id="maincontent" class="qt-main">
        <?php 
        /**
         * From V 2.5
         */
        if (get_theme_mod( 'qt_playerbar_version', '1' ) === '2'){ ?>
            <hr class="qt-header-player-spacer">
        <?php } ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- ======================= HEADER SECTION ======================= -->
            <?php get_template_part( 'phpincludes/part-header-caption-archive'); ?>
            <!-- ======================= CONTENT SECTION ======================= -->
            <div class="qt-container qt-vertical-padding-l ">
                <div class="row">
                    <div class="col s12 m8 push-m2">
                        <?php 
                            /**
                             * [$args Query arguments]
                             * @var array
                             */
                            $args = array(
                                'post_type' => 'post',
                                'post_status' => 'publish',
                                'suppress_filters' => false,
                                'paged' => $paged
                            );
                            /**
                             * [$wp_query execution of the query]
                             * @var WP_Query
                             */
                            $wp_query = new WP_Query( $args );
                            if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
                                $post = $wp_query->post;
                                setup_postdata( $post );
                               
                                if(is_sticky()){
                                    get_template_part (  'phpincludes/part-archive-item-post-featured' );
                                } else {
                                    get_template_part (  'phpincludes/part-archive-item-post' );
                                }
                                ?>
                                <?php
                            endwhile; else: ?>
                                <h3><?php echo esc_attr__("Sorry, nothing here","onair2")?></h3>
                            <?php endif;
                            wp_reset_postdata();
                        ?>
                        <hr class="qt-spacer-m">
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .qt-main end -->
    <?php get_template_part ( 'phpincludes/part-sponsors' ); ?>
    <?php get_template_part ( 'phpincludes/footerwidgets' ); ?>
    <?php get_template_part (  'phpincludes/part-player-sidebar' ); ?>
<?php get_footer(); ?>
