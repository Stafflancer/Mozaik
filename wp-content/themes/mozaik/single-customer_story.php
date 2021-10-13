<?php echo get_header(); ?>

    <main>
        <?php
        echo get_template_part('modules/customer_story_content/customer_story_content');
        echo get_template_part('modules/latest_customer_story_posts/latest_customer_story_posts');
        echo get_template_part('modules/block_with_form/block_with_form'); ?>
    </main>

<?php echo get_footer(); ?>