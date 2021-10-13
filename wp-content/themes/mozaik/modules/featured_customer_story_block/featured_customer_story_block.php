<?php
$s_customer_story = get_sub_field('s_customer_story');

/* Settings */
$media_type = get_sub_field('media_type');
$add_overlay = get_sub_field('add_overlay');
$overlay_color = get_sub_field('overlay_color');
$parallax = get_sub_field('parallax');
$color = get_sub_field('color');
$image = get_sub_field('image');
$video_mp4 = get_sub_field('video_mp4');
$video_webm = get_sub_field('video_webm');

$custom_id = get_sub_field('custom_id');
$custom_css_class = get_sub_field('custom_css_class');
$heading_color = get_sub_field('heading_color');
$text_color = get_sub_field('text_color'); ?>
<?php if ($s_customer_story) {
    wp_enqueue_style('featured_customer_story_block_styles', get_template_directory_uri() . '/static/css/modules/featured_customer_story_block/featured_customer_story_block.css', '', '', 'all');

    if ($media_type == 'image' && !empty($image) && $parallax) {
        wp_enqueue_script('parallax-js', get_template_directory_uri() . '/static/js/parallax.min.js', '', '', true);
    } ?>

    <section
            class="featured_customer_story_block
            <?php
            /* css class */
            echo !empty($custom_css_class) ? $custom_css_class . ' ' : '';
            /* heading color */
            echo !empty($heading_color) ? $heading_color . ' ' : '';
            /* text color */
            echo !empty($text_color) ? $text_color . ' ' : '';
            /* bg image */
            echo ($media_type == 'image' && !empty($image)) ? 'bg-image ' : '';
            /* bg color */
            echo $media_type == 'color' && !empty($color) ? 'bg-' . $color : ''; ?>"
            <?php
            /* custom id */
            echo !empty($custom_id) ? 'id="' . $custom_id . '"' : '';
            /* bg image */
            if ($media_type == 'image' && !empty($image) && !$parallax) { ?>style="background-image: url('<?php echo $image ?>')"
            <?php }
            /* bg image with parallax */
            if ($media_type == 'image' && !empty($image) && $parallax) { ?>data-parallax="scroll"
            data-image-src="<?php echo $image; ?>"<?php } ?>>

        <div class="container">
            <?php
            /* overlay */
            if (($media_type == 'image' || $media_type == 'video')
                && $add_overlay && !empty($overlay_color)) { ?>
                <div class="overlay <?php echo $overlay_color; ?>"></div>
            <?php }

            /* video */
            if ($media_type == 'video' && !empty($video_mp4) ||
                $media_type == 'video' && !empty($video_webm)) { ?>
                <video autoplay="true" loop="true" muted="true" class="bg-video">
                    <source src="<?php echo $video_mp4['url'] ?>" type="video/mp4">
                    <source src="<?php echo $video_webm['url'] ?>" type="video/webm">
                </video>
            <?php } ?>

            <div class="section-holder">
                <?php
                $title = get_the_title($s_customer_story);
                $excerpt = get_the_excerpt($s_customer_story);
                $thumb = get_post_thumbnail_id($s_customer_story);
                ?>

                <div class="story">
                    <div>
                        <span><?php _e('Customer Story', 'mozaik'); ?></span>
                        <h2>
                            <?php echo $title; ?>
                        </h2>
                        <?php if ($excerpt) { ?>
                            <div class="excerpt">
                                <?php echo $excerpt; ?>
                            </div>
                        <?php } ?>
                        <a href="<?php the_permalink($s_customer_story); ?>" class="secondary-btn"><?php _e('Read Customer Story'); ?></a>
                    </div>
                    <?php if ($thumb) { ?>
                        <div class="image">
                            <?php echo wp_get_attachment_image($thumb, 'm_xs'); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>