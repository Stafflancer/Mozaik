<?php
$s_heading = get_sub_field('s_heading');
$s_icons_position = get_sub_field('s_icons_position');
$s_columns_per_row = get_sub_field('s_columns_per_row');
$s_button = get_sub_field('s_button');

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

<?php if ($s_heading || $s_icons_position || $s_columns_per_row || $s_button || have_rows('s_columns')) {
    wp_enqueue_style('columns_with_icons_block_styles', get_template_directory_uri() . '/static/css/modules/columns_with_icons_block/columns_with_icons_block.css', '', '', 'all');

    if ($media_type == 'image' && !empty($image) && $parallax) {
        wp_enqueue_script('parallax-js', get_template_directory_uri() . '/static/js/parallax.min.js', '', '', true);
    } ?>

    <section
            class="columns_with_icons_block
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
                if (have_rows('s_columns')) { ?>
                    <div class="columns <?php echo $s_icons_position ? $s_icons_position : '';
                    echo ' ';
                    echo $s_columns_per_row ? 'columns-' . $s_columns_per_row : ''; ?>">
                        <?php while (have_rows('s_columns')) : the_row(); ?>
                            <div class="block">
                                <?php $icon = get_sub_field('icon'); ?>
                                <?php if ($icon) { ?>
                                    <div class="icon">
                                        <?php echo wp_get_attachment_image($icon, 'full'); ?>
                                    </div>
                                <?php } ?>
                                <div>
                                    <div class="heading">
                                        <?php the_sub_field('heading'); ?>
                                    </div>
                                    <?php $content = get_sub_field('content');
                                    if ($content) { ?>
                                        <div class="content">
                                            <?php echo $content; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php }

                if ($s_button) { ?>
                    <div class="button-holder">
                        <a href="<?php echo $s_button['url']; ?>" class="secondary-btn"
                           target="<?php echo $s_button['target']; ?>"><?php echo $s_button['title']; ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>