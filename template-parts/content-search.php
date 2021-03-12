<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Steak-Umm
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <h2><?php echo get_post_type(); ?></h2>
    <?php the_post_thumbnail(); ?>
    <div class="content">
        <?php the_excerpt(); ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
