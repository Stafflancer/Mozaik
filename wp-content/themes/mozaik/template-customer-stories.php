<?php // Template Name: Customer Stories
echo get_header(); ?>

    <main class="main">
        <?php if (have_rows('modules')) :
            while (have_rows('modules')) : the_row();
                if (get_row_layout() == 'hero_banner_common_block') :
                    get_template_part('modules/hero_banner_common_block/hero_banner_common_block');
                endif;
            endwhile;
        endif;

        echo get_template_part('modules/customer_stories_posts/customer_stories_posts');

        if (have_rows('modules')) :
            while (have_rows('modules')) : the_row();
                if (get_row_layout() == 'general_content_block') :
                    get_template_part('modules/general_content_block/general_content_block');
                elseif (get_row_layout() == 'block_with_form') :
                    get_template_part('modules/block_with_form/block_with_form');
                endif;
            endwhile;
        endif; ?>
    </main>

<?php echo get_footer(); ?>