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
    <form class="locator-form mobile-only" action="/beef-detector">
        <h3>FIND YOUR FAVORITE STEAK-UMM<sup>®</sup></h3>
        <div class="inner-form">
            <select class="upc" name="upc">
                <option value="Steakumm">100% Beef Sandwich Steaks</option>
                <option value="7254507001">Chicken Breast Sandwich Steaks</option>
                <option value="7254506270">100% Angus Beef Sandwich Steaks</option>
            </select>
            <input class="zipcode" type="text" placeholder="Zip Code" name="zip" title="Enter your zip code here" required>
            <select class="distance" name="distance">
                <option value="20">20 miles</option>
                <option value="15">15 miles</option>
                <option value="10">10 miles</option>
                <option value="5">5 miles</option>
            </select>
            <button type="submit">FIND'EM</button>
        </div>
    </form>
    <?php the_post(); ?>
    <div id="map" class="hidden"></div>
    <div class="container store-list">
        <table>
            <tbody>
                <tr>
                    <td class="empty"><strong>Enter your zipcode to get started.</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</main><!-- #main -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoWMtraIIJqYFNhdhqYlH_wNXb5DtuUIM"></script>
<script src="<?php echo get_template_directory_uri().'/js/product-search-debug.js?v='._S_VERSION; ?>"></script>
<?php
get_sidebar();
get_footer();