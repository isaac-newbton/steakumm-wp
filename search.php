<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Steak-Umm
 */

get_header();
?>

	<main id="primary" class="site-main container">

        <?php if ( isset($_GET['post_type']) && $_GET['post_type'] != 'recipe' ) : ?>
        <header class="page-header">
            <h1 class="page-title">
                <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'Search Results for: %s', 'steak-umm' ), '<span>' . get_search_query() . '</span>' );
                ?>
            </h1>
        </header><!-- .page-header -->
        <?php endif;
        if ( isset($_GET['post_type']) && $_GET['post_type'] == 'recipe' ) :
            get_search_form( array( 'search_type' => 'recipe-search' ) );
        endif;
        if ( have_posts() ) :
            if ( isset($_GET['post_type']) && $_GET['post_type'] == 'recipe' ) :
        ?>
            <div class="recipe-grid">
        <?php else: ?>
            <div class="search-results-list">
        <?php
            endif;
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();

                    if ( isset($_GET['post_type']) && $_GET['post_type'] == 'recipe' ) :
                        get_template_part( 'template-parts/content', get_post_type() );
                    else:
                        get_template_part( 'template-parts/content', 'search' );
                    endif;

                endwhile;
            else :
			    get_template_part( 'template-parts/content', 'none' );
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
