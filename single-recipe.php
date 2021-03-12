<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Steak-Umm
 */

get_header();
?>

    <main id="primary" class="site-main container">
        <?php while ( have_posts() ) : the_post(); ?>
        <div class="recipe-img">
            <figure><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"></figure>
            <div class="related-product noprint">
                <?php $prod = get_field('related_product'); ?>
                <figure>
                    <a href="<?php echo get_the_permalink($prod); ?>">
                        <img src="<?php echo get_the_post_thumbnail_url($prod); ?>" alt="<?php echo get_the_title($prod); ?>">
                    </a>
                </figure>
                <div>
                    <h3><?php echo get_the_title($prod); ?></h3>
                    <a class="btn" href="#">FIND IT <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="recipe-info">
            <button onclick="print()" class="print-btn noprint"><i class="fas fa-print"></i></button>
            <h1><?php the_title(); ?></h1>
            <div class="ingreds"><?php the_field('ingredients'); ?></div>
            <div class="steps"><?php the_field('instructions'); ?></div>
        </div>
        <?php endwhile; // End of the loop. ?>
    </main><!-- #main -->
    <a class="recipe-back noprint btn" href="/recipes">BACK TO RECIPES</a>
<?php
get_sidebar();
get_footer();
