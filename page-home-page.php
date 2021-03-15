<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Steak-Umm
 */

get_header();
?>

    <main id="primary" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();
            if (have_rows('top_slider')) :
        ?>
        <div id="homepage-videos" class="owl-carousel owl-theme">
            <?php while (have_rows('top_slider')) : the_row(); ?>
            <?php
                $video_url = get_sub_field('video_url');
                $video_url_responsive = get_sub_field('video_url_responsive');
                $video_link = get_sub_field('video_link');
                $image_url = get_sub_field('still_image_url');
                $image_link = get_sub_field('image_link');
            ?>
            <?php if($video_url && ''!==$video_url): ?>
                <div class="item">
                    <div class="video-wrapper">
                        <?php if (get_sub_field('video_link')) : ?><a href=""><?php endif;?>
                        <video class="desktop-only" src="<?php the_sub_field('video_url'); ?>" muted playsinline></video>
                        <?php if (get_sub_field('video_link')) : ?></a><?php endif;?>

                        <?php if (get_sub_field('video_url_responsive')) : ?>
                        <?php if (get_sub_field('video_link')) : ?><a href="<?php the_sub_field('video_link'); ?>"><?php endif;?>
                        <video class="mobile-only" src="<?php the_sub_field('video_url_responsive'); ?>" muted playsinline></video>
                        <?php if (get_sub_field('video_link')) : ?></a><?php endif;?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php elseif($image_url && ''!==$image_url): ?>
                <div class="item">
                    <div class="image-wrapper">
                        <?php if($image_link): ?><a href="<?=$image_link?>"><?php endif; ?>
                            <img src="<?=$image_url?>" alt="">
                        <?php if($image_link): ?></a><?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php endwhile; ?>
        </div>
        <?php
            endif;
            the_content();
        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
<script src="<?php echo get_template_directory_uri().'/js/vendor/owl.carousel.min.js'; ?>"></script>
<script src="<?php echo get_template_directory_uri().'/js/homepage-debug.js?v='._S_VERSION; ?>"></script>
<script src="<?php echo get_template_directory_uri().'/js/social-feed-debug.js?v='._S_VERSION; ?>"></script>
<?php
get_sidebar();
get_footer();
