<?php
$s_label = get_sub_field('s_label');
$s_heading = get_sub_field('s_heading');
$s_image = get_sub_field('s_image');
$s_description = get_sub_field('s_description');
$s_link = get_sub_field('s_link');

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
<?php if ($s_label || $s_heading || $s_image || $s_description || $s_link) {
    wp_enqueue_style('call_to_action_block_styles', get_template_directory_uri() . '/static/css/modules/call_to_action_block/call_to_action_block.css', '', '', 'all');

    if ($media_type == 'image' && !empty($image) && $parallax) {
        wp_enqueue_script('parallax-js', get_template_directory_uri() . '/static/js/parallax.min.js', '', '', true);
    } ?>

    <section
            class="call_to_action_block
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
                <div class="story">
                    <div>
                        <?php if ($s_label) { ?>
                            <span><?php echo $s_label; ?></span>
                        <?php } ?>
                        <?php if ($s_heading) { ?>
                            <h2>
                                <?php echo $s_heading; ?>
                            </h2>
                        <?php } ?>
                        <?php if ($s_description) { ?>
                            <div class="excerpt">
                                <?php echo $s_description; ?>
                            </div>
                        <?php } ?>
                        <?php if ($s_link) { ?>
                            <a href="<?php echo $s_link['url']; ?>" target="<?php echo $s_link['target']; ?>"
                               class="secondary-btn"><?php echo $s_link['title']; ?></a>
                        <?php } ?>
                    </div>
                    <?php if ($s_image) { ?>
                        <div class="image">
                            <?php echo wp_get_attachment_image($s_image, 'm_xs'); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>