<?php global $post; ?>
<form role="search" method="get" class="search-form" action="/">
    <?php if ($args['search_type'] == 'recipe-search') : ?>
    <label>
        <span class="screen-reader-text">Meal Type</span>
        <select name="meal" id="meal-type">
            <option value="">Meal Type</option>
            <?php foreach ( get_terms(array('taxonomy' => 'meal')) as $tag ) : ?>
            <option value="<?php echo $tag->slug; ?>" <?php if (get_query_var('meal') === $tag->slug) : ?>selected="selected" <?php endif; ?>>
            <?php echo $tag->name ?>
            </option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>
        <span class="screen-reader-text">Product Type</span>
        <?php echo get_query_var('related_product'); ?>
        <select name="related_product" id="related-product">
            <option value="">Product Type</option>
            <?php foreach ( get_posts( array('post_type' => 'product') ) as $prod ) : ?>
            <option value="<?php echo $prod->ID; ?>" <?php if (isset($_GET['related_product']) && $_GET['related_product'] == $prod->ID) : ?>selected="selected" <?php endif; ?>>
                <?php echo get_the_title($prod); ?>
            </option>
            <?php endforeach; ?>
        </select>
    </label>
    <label class="search-input">
        <span class="screen-reader-text">Search:</span>
        <i class="fas fa-search"></i>
        <input type="search" class="search-field" placeholder="Search" value="" name="s">
    </label>
    <input type="hidden" value="recipe" name="post_type" id="post-type" />
    <input type="submit" class="search-submit" value="SUBMIT">
    <?php else : ?>
    <label>
        <span class="screen-reader-text">Search:</span>
        <input type="search" class="search-field" placeholder="Search" value="" name="s">
    </label>
    <input type="submit" class="search-submit" value="Search">
    <?php endif; ?>
</form>