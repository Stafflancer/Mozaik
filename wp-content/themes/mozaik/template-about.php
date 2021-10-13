<?php
// Template Name: About Page
echo get_header(); ?>

    <main class="main">
        <?php if (have_rows('modules')): ?>
            <div class="about-page-bg">
                <?php while (have_rows('modules')) : the_row();
                    if (get_row_layout() == 'hero_banner_simple_block') :
                        get_template_part('modules/hero_banner_simple_block/hero_banner_simple_block');
                    elseif (get_row_layout() == 'media_content_rows_block') :
                        get_template_part('modules/media_content_rows_block/media_content_rows_block');
                    endif;
                endwhile; ?>
            </div>

            <?php while (have_rows('modules')) : the_row();
                if (get_row_layout() == 'hero_banner_home_block') :
                    get_template_part('modules/hero_banner_home_block/hero_banner_home_block');
                elseif (get_row_layout() == 'subpage_listing_block') :
                    get_template_part('modules/subpage_listing_block/subpage_listing_block');
                elseif (get_row_layout() == 'columns_with_icons_block') :
                    get_template_part('modules/columns_with_icons_block/columns_with_icons_block');
                elseif (get_row_layout() == 'featured_customer_story_block') :
                    get_template_part('modules/featured_customer_story_block/featured_customer_story_block');
                elseif (get_row_layout() == 'carousel_partners_block') :
                    get_template_part('modules/carousel_partners_block/carousel_partners_block');
                elseif (get_row_layout() == 'block_with_form') :
                    get_template_part('modules/block_with_form/block_with_form');
                elseif (get_row_layout() == 'hero_banner_common_block') :
                    get_template_part('modules/hero_banner_common_block/hero_banner_common_block');
                elseif (get_row_layout() == 'list_columns_block') :
                    get_template_part('modules/list_columns_block/list_columns_block');
                elseif (get_row_layout() == 'general_content_block') :
                    get_template_part('modules/general_content_block/general_content_block');
                elseif (get_row_layout() == 'current_openings_block') :
                    get_template_part('modules/current_openings_block/current_openings_block');
                elseif (get_row_layout() == 'skewed_column_list_block') :
                    get_template_part('modules/skewed_column_list_block/skewed_column_list_block');
                endif;
            endwhile;
        endif; ?>
    </main>

<?php echo get_footer(); ?>