<?php $args = array(
    'post_type' => 'customer_story',
    'posts_per_page' => '-1'
);
$posts = new WP_Query($args);
if ($posts->have_posts()) {
    wp_enqueue_style('customer_stories_posts_styles', get_template_directory_uri() . '/static/css/modules/customer_stories_posts/customer_stories_posts.css', '', '', 'all'); ?>
    <section class="customer_stories_posts">
        <div class="container">
            <div class="posts">
                <?php while ($posts->have_posts()) {
                    $posts->the_post(); ?>
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
                <?php wp_reset_query(); } ?>
            </div>
        </div>
    </section>
<?php } ?>