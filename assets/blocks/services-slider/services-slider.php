<?php

/**
 * Services Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'services-slider-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'services-slider';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$template = [
    [
        'core/heading',
        [
            'content' => 'Our services',
            'level' => 3,
        ]
    ]
];

$args = array(
    'post_status' => 'publish',
    'post_type' => 'service',
    "posts_per_page" => -1
);

if (get_field('custom_services')) {
    $args['post__in'] = get_field('custom_services');
}

$the_query = new WP_Query($args);

?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

    <div class="services-slider-top-title">
        <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
    </div>

    <?php

    if ($the_query->have_posts()) {

    ?>
    <div class="services-slider-container">
        <div class="services-slider-container-left">
            <div class="swiper services-swiper-text">
                <div class="swiper-nav">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <div class="swiper-wrapper">
                    <?php
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                        ?>
                    <div class="swiper-slide">
                        <?php if ( has_excerpt() ) : ?>
                        <h3 class="excerpt"><?php echo get_the_excerpt(); ?></h3>
                        <?php endif; ?>
                        <h4><?php echo get_the_title(); ?></h4>
                        <!-- Botón al permalink -->
                        <a class="service-button" href="<?php the_permalink(); ?>">KNOW MORE</a>
                    </div>
                    <?php
                        }
                        ?>
                </div>

            </div>
        </div>
        <?php wp_reset_postdata(); // resetea antes del siguiente loop ?>
        <div class="services-slider-container-right">
            <div class="swiper services-swiper-images">
                <div class="swiper-wrapper">
                    <?php
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                        ?>
                    <div class="swiper-slide">
                        <?php if (!have_rows("images", get_the_ID())) { ?>
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>">
                        <?php } else { ?>
                        <div class="swiper services-swiper-inner-images">
                            <div class="swiper-wrapper">
                                <?php while (have_rows("images", get_the_ID())) {
                                                the_row();
                                            ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo get_sub_field('image')['url']; ?>"
                                        alt="<?php echo get_sub_field('image')['alt']; ?>">
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <?php
                        }

                        wp_reset_postdata();
                        ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    }

    ?>
</section>