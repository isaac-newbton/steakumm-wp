<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Steak-Umm
 */

?>

<section class="no-results not-found">
    <?php if ( isset($_GET['post_type']) && $_GET['post_type'] != 'recipe' ) : ?>
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'steak-umm' ); ?></h1>
	</header><!-- .page-header -->
    <?php endif; ?>

	<div class="page-content">
		<?php if ( is_search() ) :
		    if ( isset($_GET['post_type']) && $_GET['post_type'] == 'recipe' ) : ?>
            <p class="no-recipes">Sorry, no recipes were found!</p>
            <?php else: ?>
            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'steak-umm' ); ?></p>
            <?php endif;
		else :
			?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'steak-umm' ); ?></p>
			<?php
			get_search_form();
		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
