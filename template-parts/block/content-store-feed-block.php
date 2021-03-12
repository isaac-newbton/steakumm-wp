<?php
/**
 * Block Name: Store
 *
 * This is the template that displays the store block.
 */

// create id attribute for specific styling
$id = 'store-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<div id="<?php echo $id; ?>" class="store-block <?php echo $align_class; ?>">
    <?php if (have_rows('product')) : while (have_rows('product')) : the_row(); ?>
        <figure class="item-<?php the_sub_field('size'); ?>">
            <a href="<?php the_sub_field('url'); ?>" target="_blank">
                <img class="product <?php if (!get_sub_field('hover_image')) : echo 'nohover'; endif; ?>" src="<?php the_sub_field('product_image'); ?>">
                <?php if (get_sub_field('hover_image')): ?>
                <img class="hover" src="<?php the_sub_field('hover_image'); ?>">
                <?php endif; ?>
            </a>
            <figcaption>
                <a href="<?php the_sub_field('url'); ?>" target="_blank">BUY NOW</a>
            </figcaption>
        </figure>
    <?php endwhile; endif; ?>
</div>