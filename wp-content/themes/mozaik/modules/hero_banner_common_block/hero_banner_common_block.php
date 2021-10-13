<?php
$page_id = get_queried_object_id();

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

<?php if (have_rows('image_settings')) :
    while (have_rows('image_settings')) : the_row();
        $image_frame = get_sub_field('image_frame');
    endwhile;
endif; ?>


<?php if (have_rows('content_settings')) {
    wp_enqueue_style('hero_banner_common_block_styles', get_template_directory_uri() . '/static/css/modules/hero_banner_common_block/hero_banner_common_block.css', '', '', 'all');

    if ($media_type == 'image' && !empty($image) && $parallax) {
        wp_enqueue_script('parallax-js', get_template_directory_uri() . '/static/js/parallax.min.js', '', '', true);
    } ?>

    <section
            class="hero_banner_common_block
            <?php
            /* image frame */
            echo isset($image_frame) && $image_frame == 'hexagon' ? 'image-frame' . ' ' : '';
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
                <div class="content-col">
                    <?php while (have_rows('content_settings')) : the_row();
                        $heading = get_sub_field('heading');
                        $content = get_sub_field('content'); ?>

                        <div class="breadcrumbs">
                            <span><?php echo get_the_title($page_id); ?></span>
                        </div>

                        <?php if ($heading) { ?>
                            <h1><?php echo $heading; ?></h1>
                        <?php }
                        if ($content) { ?>
                            <div class="content">
                                <?php echo $content; ?>
                            </div>
                        <?php } ?>
                    <?php endwhile; ?>
                </div>

                <?php if (have_rows('image_settings')) : ?>
                    <div class="image-col">
                        <?php while (have_rows('image_settings')) : the_row();
                            $add_image = get_sub_field('add_image');
                            $use_featured_image = get_sub_field('use_featured_image');
                            $image = get_sub_field('image');

                            if (!empty($image)) {
                                echo wp_get_attachment_image($image, 'm_md');
                            }
                        endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php } ?>