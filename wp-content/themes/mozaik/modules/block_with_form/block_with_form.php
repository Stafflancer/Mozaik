<?php
if(is_singular('customer_story')) {
    $s_heading = get_field('s_heading', 'option');
    $s_content = get_field('s_content', 'option');
    $s_form = get_field('s_form', 'option');
    $s_image = get_field('s_image', 'option');

    /* Settings */
    $media_type = get_field('media_type', 'option');
    $add_overlay = get_field('add_overlay', 'option');
    $overlay_color = get_field('overlay_color', 'option');
    $parallax = get_field('parallax', 'option');
    $color = get_field('color', 'option');
    $image = get_field('image', 'option');
    $video_mp4 = get_field('video_mp4', 'option');
    $video_webm = get_field('video_webm', 'option');

    $custom_id = get_field('custom_id', 'option');
    $custom_css_class = get_field('custom_css_class', 'option');
    $heading_color = get_field('heading_color', 'option');
    $text_color = get_field('text_color', 'option');
} else {
    $s_heading = get_sub_field('s_heading');
    $s_content = get_sub_field('s_content');
    $s_form = get_sub_field('s_form');
    $s_image = get_sub_field('s_image');

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
    $text_color = get_sub_field('text_color');
} ?>

<?php if ($s_heading || $s_content || $s_form) {
    wp_enqueue_style('block_with_form_styles', get_template_directory_uri() . '/static/css/modules/block_with_form/block_with_form.css', '', '', 'all');

    if ($media_type == 'image' && !empty($image) && $parallax) {
        wp_enqueue_script('parallax-js', get_template_directory_uri() . '/static/js/parallax.min.js', '', '', true);
    } ?>

    <section
            class="block_with_form
            <?php
            echo ($media_type == 'video' && !empty($video_mp4) ||
                $media_type == 'video' && !empty($video_webm)) ? ' video ' : '';
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
                if ($s_content) { ?>
                    <div class="content">
                        <?php echo $s_content; ?>
                    </div>
                <?php }
                if ($s_form) { ?>
                    <div class="form-holder">
                        <?php echo do_shortcode("[gravityform id=\"$s_form\" title='false']"); ?>
                    </div>
                <?php } ?>

                <?php if ($s_image) { ?>
                    <div class="s-image">
                        <?php echo wp_get_attachment_image($s_image, 'm_md'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>