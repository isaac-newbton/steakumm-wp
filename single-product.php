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

    <main id="primary" class="site-main">
        <?php while ( have_posts() ) : the_post(); ?>
        <div class="tagline"><?php the_field('tagline'); ?></div>
        <div class="product-summary">
            <figure>
                <?php the_post_thumbnail(); ?>
            </figure>
            <div class="product-info">
                <h1>
                    STEAKUMM<sup>&reg;</sup><br>
                    <?php the_title(); ?>
                </h1>
                <div class="description">
                    <?php the_content(); ?>
                    <button id="nutr-toggle">NUTRITION <i class="fas fa-caret-right active"></i><i class="fas fa-caret-down"></i></button>
                    <ul class="nutrition">
                        <li><h3>NUTRITION FACTS</h3></li>
                        <li>Serving Size:<span><?php the_field('serving_size'); ?></span></li>
                        <li>Serving Per Container:<span><?php the_field('servings_per_container'); ?></span></li>
                        <li>Amount Per Serving</li>
                        <li>Calories&nbsp;<?php the_field('calories'); ?><span>Calories from Fat&nbsp;<?php the_field('calories_from_fat'); ?></span></li>
                        <li>&nbsp;<span>% Daily Value</span></li>
                        <li>Total Fat <?php the_field('total_fat_g'); ?>g<span><?php the_field('total_fat_perc'); ?>%</span></li>
                        <li>Saturated Fat <?php the_field('saturated_fat_g'); ?>g<span><?php the_field('saturated_fat_perc'); ?>%</span></li>
                        <li>Trans Fat <?php the_field('trans_fat_g'); ?>g</li>
                        <li>Cholesterol <?php the_field('cholesterol_mg'); ?>mg<span><?php the_field('cholesterol_perc'); ?>%</span></li>
                        <li>Sodium <?php the_field('sodium_mg'); ?>mg<span><?php the_field('sodium_perc'); ?>%</span></li>
                        <li>Total Carbohydrates <?php the_field('total_carbohydrates_g'); ?>g<span><?php the_field('total_carbohydrate_perc'); ?>%</span></li>
                        <li>Dietary Fiber <?php the_field('dietary_fiber_g'); ?>g<span><?php the_field('dietary_fiber_perc'); ?>%</span></li>
                        <li>Sugars <?php the_field('sugars_g'); ?>g<span><?php the_field('sugars_perc'); ?>%</span></li>
                        <li>Protein <?php the_field('protein_g'); ?>g</li>
                        <li>Vitamin A <?php the_field('vitamin_a'); ?>% &middot; Vitamin C <?php the_field('vitamin_c'); ?>%</li>
                        <li>Calcium <?php the_field('calcium'); ?>% &middot; Iron <?php the_field('iron'); ?>%</li>
                        <li><h3>INGREDIENTS</h3></li>
                        <li><p><?php the_field('ingredients'); ?></p></li>
                    </ul>
                </div>
                <script>
                    document.getElementById('nutr-toggle').addEventListener('click', (evt) => {
                        document.querySelector('.nutrition').classList.toggle('active');
                        evt.target.querySelector('.fa-caret-right').classList.toggle('active');
                        evt.target.querySelector('.fa-caret-down').classList.toggle('active');
                    });
                </script>
            </div>
        </div>

        <?php endwhile; ?>
    </main><!-- #main -->
<?php
$products = new WP_Query(
    array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'order' => 'DSC'
    )
);
if ( $products->have_posts() ) :
?>
<div class="other-products owl-carousel">
    <?php
    while ( $products->have_posts() ) :
        $products->the_post();
    ?>
    <div class="item">
        <figure>
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
            <figcaption><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></figcaption>
        </figure>
    </div>
    <?php
    endwhile;
    wp_reset_postdata();
    ?>
</div>
<script src="<?php echo get_template_directory_uri().'/js/vendor/owl.carousel.min.js'; ?>"></script>
    <script src="<?php echo get_template_directory_uri().'/js/carousel-generator-debug.js?v='._S_VERSION; ?>"></script>
<?php
endif;
get_sidebar();
get_footer();
