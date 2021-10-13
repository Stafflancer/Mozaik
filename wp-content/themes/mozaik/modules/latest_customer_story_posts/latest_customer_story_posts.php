<?php
$current_post_id = get_the_ID();

$args = array(
    'post_type' => 'customer_story',
    'posts_per_page' => '4'
);
$posts = new WP_Query($args);

if ($posts->have_posts()) {
    wp_enqueue_style('latest_customer_story_posts_styles', get_template_directory_uri() . '/static/css/modules/latest_customer_story_posts/latest_customer_story_posts.css', '', '', 'all'); ?>

    <section class="latest_customer_story_posts">
        <div class="container">
            <div class="section-holder">
                <?php $latest_posts_section_title = get_field('latest_posts_section_title', 'option');
                if ($latest_posts_section_title) { ?>
                    <h2><?php echo $latest_posts_section_title; ?></h2>
                <?php } ?>

                <div class="posts">
                    <?php
                    $i = 1;
                    while ($posts->have_posts()) {
                        $posts->the_post();
                        if($i < 4 && $current_post_id != get_the_ID()) {?>
                        <div class="post post-card">
                            <div class="holder">
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="thumb">
                                        <?php the_post_thumbnail('post_thumb'); ?>
                                    </div>
                                <?php } ?>
                                <div class="info-block">
                                    <?php $post_type_obj = get_post_type_object('customer_story'); ?>
                                    <span><?php echo $post_type_obj->labels->singular_name; ?></span>
                                    <h4><?php echo get_the_title(); ?></h4>
                                    <div class="btn-holder">
                                        <a href="<?php echo get_the_permalink(); ?>" class="secondary-btn">Read Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } wp_reset_query(); $i++;
                    } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>