<div class="site-branding">
    <?php the_custom_logo(); ?>
    <div class="mobile-only" id="mobile-nav">
        <i class="fas fa-bars"></i><span class="reader">Open Navigation</span>
    </div>
</div><!-- .site-branding -->
<nav id="site-navigation" class="main-navigation noprint">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'menu-primary',
        'menu_id'        => 'menu-primary',
    ) );
    ?>
    <div class="mobile-only">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'menu-social',
        'menu_id'        => 'menu-social-header',
    ) );
    ?>
    </div>
    <div class="dropdowns">
        <form class="locator-form" action="/beef-detector">
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
        <?php get_search_form(); ?>
    </div>
</nav><!-- #site-navigation -->