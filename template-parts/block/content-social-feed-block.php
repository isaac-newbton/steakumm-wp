<?php
/**
 * Block Name: Social Feed
 *
 * This is the template that displays the social feed block.
 */

// create id attribute for specific styling
$id = 'social-feed-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<div id="<?php echo $id; ?>"
     class="social-feed-block container <?php echo $align_class; ?>"
     data-insta="<?php the_field('instagram_account_name'); ?>"
     data-twitter="<?php the_field('twitter_account_name'); ?>"
>
    <h3 class="loading-message">Loading...</h3>
    <i id="social-loading-spinner" class="fas fa-cog fa-spin"></i>
</div>