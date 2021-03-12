<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Steak-Umm
 */

get_header();
?>

    <main id="primary" class="site-main container">

        <?php if ( have_posts() ) : ?>

        <header class="page-header hidden">
            <h1 class="page-title"><?php echo post_type_archive_title( '', false ); ?></h1>
        </header><!-- .page-header -->
        <?php get_search_form( array( 'search_type' => 'recipe-search' ) ); ?>
        <div class="recipe-grid">
            <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();

                /*
                 * Include the Post-Type-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', get_post_type() );

            endwhile;
        endif;
        ?>
        </div>
        <div class="pagination">
            <?php
            $pageArgs = array(
                'prev_text' => "<i class='fas fa-caret-left'></i>",
                'next_text' => "<i class='fas fa-caret-right'></i>",
            );
            echo paginate_links($pageArgs);
            ?>
        </div>
    </main><!-- #main -->

<?php
get_sidebar();
get_footer();
