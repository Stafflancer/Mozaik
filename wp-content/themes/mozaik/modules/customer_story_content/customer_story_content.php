<?php
if (get_the_content()) {
    wp_enqueue_style('customer_story_content_styles', get_template_directory_uri() . '/static/css/modules/customer_story_content/customer_story_content.css', '', '', 'all'); ?>

    <section class="customer_story_content">
        <div class="container">
            <div class="section-holder">
                <?php $post_type_obj = get_post_type_object('customer_story'); ?>
                <div class="breadcrumbs">
                    <span><?php echo $post_type_obj->labels->name; ?></span>
                </div>
                <h1><?php the_title(); ?></h1>
                <div class="content">
                    <?php the_content(); ?>
                </div>
                <div class="next-post-btn-holder">
                    <?php echo get_next_post_link('%link','Read Next Customer Story >'); ?>
                    <span></span>
                </div>
            </div>
        </div>
    </section>
<?php } ?>