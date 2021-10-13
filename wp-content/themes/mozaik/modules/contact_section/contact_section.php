<?php
$page_id = get_queried_object_id();

$page_title = get_field('page_title');
$page_content = get_field('page_content');
$page_form = get_field('page_form');

if ($page_title || $page_content || $page_form) {
    wp_enqueue_style('contact_section_styles', get_template_directory_uri() . '/static/css/modules/contact_section/contact_section.css', '', '', 'all');

    wp_enqueue_script('contact_section_js', get_template_directory_uri() . '/static/js/modules/contact_section/contact_section.js', '', '', true); ?>

    <section class="contact_section">
        <div class="container">
            <div class="section-holder">
                <div class="breadcrumbs">
                    <span><?php echo get_the_title($page_id); ?></span>
                </div>
                <?php if ($page_title) { ?>
                    <h1>
                        <?php echo $page_title; ?>
                    </h1>
                <?php }
                if ($page_content) { ?>
                    <div class="content">
                        <?php echo $page_content; ?>
                    </div>
                <?php }
                if ($page_form) { ?>
                    <div class="form-holder">
                        <?php echo do_shortcode("[gravityform id=\"$page_form\" title='false']"); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="contact_info_section">
        <div class="container">
            <div class="cols">
                <?php
                if (have_rows('contact_group', 'option')) :
                    while (have_rows('contact_group', 'option')) : the_row();
                        $address_line_1 = get_sub_field('address_line_1');
                        $address_line_2 = get_sub_field('address_line_2');
                        $phone = get_sub_field('phone');
                        $map_code = get_sub_field('map_code');
                    endwhile;
                endif; ?>

                <div class="left-block">
                    <h3><?php _e('Mozaik', 'mozaik'); ?></h3>
                    <?php if (!empty($address_line_1)) { ?>
                        <div class="address">
                            <?php echo $address_line_1; ?>
                        </div>
                    <?php }
                    if (!empty($address_line_2)) { ?>
                        <div class="address">
                            <?php echo $address_line_2; ?>
                        </div>
                    <?php }
                    if (!empty($phone)) { ?>
                        <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
                    <?php } ?>
                </div>

                <?php if (!empty($map_code)) { ?>
                    <div class="map">
                        <?php echo $map_code; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

<?php } ?>