<?php
$s_media_initial_position = get_sub_field('s_media_initial_position');

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

<?php if ($s_media_initial_position || have_rows('s_content_rows')) {
    wp_enqueue_style('media_content_rows_block_styles', get_template_directory_uri() . '/static/css/modules/media_content_rows_block/media_content_rows_block.css', '', '', 'all');

    if ($media_type == 'image' && !empty($image) && $parallax) {
        wp_enqueue_script('parallax-js', get_template_directory_uri() . '/static/js/parallax.min.js', '', '', true);
    } ?>

    <section
            class="media_content_rows_block
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
                <div class="blocks <?php echo $s_media_initial_position ? $s_media_initial_position : ''; ?>">
                    <?php if (have_rows('s_content_rows')) : ?>
                        <?php while (have_rows('s_content_rows')) : the_row(); ?>

                            <?php if (have_rows('media')) : ?>
                                <?php while (have_rows('media')) : the_row(); ?>
                                    <?php $image = get_sub_field('image'); ?>
                                <?php endwhile; ?>
                            <?php endif; ?>

                            <?php if (have_rows('content')) : ?>
                                <?php while (have_rows('content')) : the_row(); ?>
                                    <?php $heading = get_sub_field('heading'); ?>
                                    <?php $content = get_sub_field('content'); ?>
                                <?php endwhile; ?>
                            <?php endif; ?>

                            <div class="block">
                                <div class="content-col">
                                    <?php if (!empty($heading)) { ?>
                                        <h2><?php echo $heading; ?></h2>
                                    <?php }
                                    if (!empty($content)) { ?>
                                        <div class="content">
                                            <?php echo $content; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="image-col">
                                    <?php if (!empty($image)) { ?>
                                        <?php echo wp_get_attachment_image($image, 'm_xs'); ?>
                                    <?php } ?>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>