<?php the_custom_logo(); ?>
<nav id="footer-navigation" class="footer-navigation">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'menu-footer',
        'menu_id'        => 'menu-footer',
    ) );
    ?>
</nav><!-- #site-navigation -->
<nav id="social-navigation" class="social-navigation">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'menu-social',
        'menu_id'        => 'menu-social',
    ) );
    ?>
</nav><!-- #social-navigation -->