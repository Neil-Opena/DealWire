<div class="entry-summary">
    <header class="blog-header">
        <?php the_post_thumbnail('blog-thumb'); ?>
        <h2 class="entry-title"><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span> <?php get_template_part( 'event_cat/entry', 'meta' ); ?></h2>
    </header>
    <?php
    if ($post->post_type == 'ignition_product') {
        echo apply_filters('the_content', get_post_meta($post->ID, 'ign_project_long_description', true));
    }
    else {
        the_excerpt();
    }
    if(is_search()) {
        wp_link_pages();
    }
    ?>
</div>