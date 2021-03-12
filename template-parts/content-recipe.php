<?php
/**
 * Template part for displaying recipe in lists
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Steak-Umm
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <style>#post-<?php the_ID(); ?> .recipe-thumb { background-image: url('<?php echo get_the_post_thumbnail_url(null, "large"); ?>'); }</style>
    <a href="<?php the_permalink(); ?>"><div class="recipe-thumb"></div></a>
    <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
