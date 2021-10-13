<?php
$s_heading = get_sub_field('s_heading');

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

<?php if ($s_heading || have_rows('s_subpages')) {
    wp_enqueue_style('subpage_listing_block_styles', get_template_directory_uri() . '/static/css/modules/subpage_listing_block/subpage_listing_block.css', '', '', 'all');

    if ($media_type == 'image' && !empty($image) && $parallax) {
        wp_enqueue_script('parallax-js', get_template_directory_uri() . '/static/js/parallax.min.js', '', '', true);
    } ?>

    <section
            class="subpage_listing_block
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
                <?php if ($s_heading) { ?>
                    <h2><?php echo $s_heading; ?></h2>
                <?php }
                if (have_rows('s_subpages')) { ?>
                    <div class="subpages">
                        <?php while (have_rows('s_subpages')) {
                            the_row();
                            $post_object = get_sub_field('subpage');
                            if ($post_object) {
                                $post = $post_object;
                                setup_postdata($post); ?>

                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="thumbnail">
                                            <?php echo the_post_thumbnail(); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="title">
                                        <?php the_title(); ?>
                                    </div>
                                    <?php if (has_excerpt()) { ?>
                                        <div class="excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    <?php } ?>
                                    <button class="secondary-btn"><?php _e('Learn More'); ?></button>
                                </a>

                                <?php wp_reset_postdata();
                            } ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>