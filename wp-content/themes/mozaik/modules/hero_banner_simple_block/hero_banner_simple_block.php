<?php
$page_id = get_queried_object_id();
$s_heading = get_sub_field('s_heading');
$s_content = get_sub_field('s_content');
$s_content_size = get_sub_field('s_content_size');

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

<?php if ($s_heading || $s_content || $s_content_size) {
    wp_enqueue_style('hero_banner_simple_block_styles', get_template_directory_uri() . '/static/css/modules/hero_banner_simple_block/hero_banner_simple_block.css', '', '', 'all');

    if ($media_type == 'image' && !empty($image) && $parallax) {
        wp_enqueue_script('parallax-js', get_template_directory_uri() . '/static/js/parallax.min.js', '', '', true);
    } ?>

    <section
            class="hero_banner_simple_block
            <?php
            echo $s_content_size ? $s_content_size . ' ' : '';
            /* css class */
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
                <div class="breadcrumbs">
                    <span><?php echo get_the_title($page_id); ?></span>
                </div>
                <?php if ($s_heading) { ?>
                    <h1><?php echo $s_heading; ?></h1>
                <?php }
                if ($s_content) { ?>
                    <div class="content">
                        <?php echo $s_content; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>