<?php

/**
 * Services Slider Block Template.
 *
 * @param   array $block
 * @param   string $content
 * @param   bool $is_preview
 * @param   (int|string) $post_id
 */

// =============================
// ID Y CLASES DEL BLOCK
// =============================
$id = 'services-slider-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$className = 'services-slider';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}


// =============================
// TEMPLATE HEADING
// =============================
$template = [
    [
        'core/heading',
        [
            'content' => 'Our services',
            'level' => 3,
        ]
    ]
];


// =============================
// QUERY SERVICES
// =============================
$args = [
    'post_status' => 'publish',
    'post_type' => 'service',
    'posts_per_page' => -1
];

if (get_field('custom_services')) {
    $args['post__in'] = get_field('custom_services');
}

$the_query = new WP_Query($args);


// =============================
// TOGGLE MULTI GALLERY (ACF)
// =============================
$multi_gallery = get_field('multi_gallery');

?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

    <div class="services-slider-top-title">
        <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
    </div>

    <?php if ($the_query->have_posts()) : ?>

    <div class="services-slider-container">

        <!-- ================= LEFT TEXT SLIDER ================= -->
        <div class="services-slider-container-left">
            <div class="swiper services-swiper-text">

                <?php if ($title = get_field('title_slider')) : ?>
                <h3><?php echo esc_html($title); ?></h3>
                <?php endif; ?>

                <div class="swiper-nav">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>

                <div class="swiper-wrapper">
                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <div class="swiper-slide">
                        <h4><?php echo esc_html(get_the_title()); ?></h4>
                        <a class="service-button" href="<?php the_permalink(); ?>">
                            KNOW MORE
                        </a>
                    </div>
                    <?php endwhile; ?>
                </div>

            </div>
        </div>


        <!-- RESET LOOP -->
        <?php wp_reset_postdata(); ?>
        <?php $the_query = new WP_Query($args); ?>


        <!-- ================= RIGHT IMAGE SLIDER ================= -->
        <div class="services-slider-container-right">
            <div class="swiper services-swiper-images">
                <div class="swiper-wrapper">

                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                    <div class="swiper-slide">

                        <?php
// =====================================================
// SI MULTI GALLERY ACTIVADO → USAR REPEATER
// =====================================================
if ($multi_gallery && have_rows('images', get_the_ID())) :
?>

                        <div class="swiper services-swiper-inner-images">
                            <div class="swiper-wrapper">

                                <?php while (have_rows('images', get_the_ID())) : the_row();
                $img = get_sub_field('image');
                if (!$img) continue;
            ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo esc_url($img['url']); ?>"
                                        alt="<?php echo esc_attr($img['alt']); ?>" loading="lazy">
                                </div>
                                <?php endwhile; ?>

                            </div>
                        </div>

                        <?php
// =====================================================
// SI MULTI GALLERY DESACTIVADO → FEATURED IMAGE
// =====================================================
else :
    $featured = get_the_post_thumbnail_url(get_the_ID(), 'full');
    if ($featured) :
?>

                        <img src="<?php echo esc_url($featured); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"
                            loading="lazy">

                        <?php endif; endif; ?>

                    </div>

                    <?php endwhile; wp_reset_postdata(); ?>

                </div>
            </div>
        </div>

    </div>

    <?php endif; ?>

</section>