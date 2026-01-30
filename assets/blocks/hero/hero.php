<?php

/**
 * Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$template = [
    [
        'core/group',
        [
            'className' => 'hero-content',
        ],
        [
            [
                'core/heading',
                [
                    'content' => 'Providing innovative and sustainable construction solutions',
                    'level' => 1,
                ]
            ],
            [
                'core/buttons',
                [],
                [
                    [
                        'core/button',
                        [
                            'text' => 'Discover our services',
                            'url' => '#'
                        ]
                    ]
                ]
            ]
        ]
    ],
    [
        'core/image',
        [
            'url' => get_template_directory_uri() . '/assets/images/small_h.png',
            'alt' => 'Hero',
            'className' => 'hero-decor'
        ]
    ]
];


?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="hero-top-content">
        <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
        <div class="hero-background-slider">
            <?php if(get_field('set_hero_section_as_slider')) { ?>
            <?php
            if (have_rows('slides')) {
            ?>
            <div class="swiper hero-slider">
                <div class="swiper-wrapper">
                    <?php
                    while (have_rows('slides')) {
                        the_row();
                        $image = get_sub_field('image');
                        $image_url = $image['url'];
                        $image_alt = $image['alt'];
                    ?>
                    <div class="swiper-slide">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            }
            ?>

            <?php } else { ?>

            <div class="hero-video">
                <?php 
                // var_dump(get_field('hero_section_video')); 
                ?>

                <video autoplay muted>
                    <source src="<?php echo get_field('hero_section_video')['url'] ?>"
                        type="<?php echo get_field('hero_section_video')['mime_type'] ?>">
                    Your browser does not support the video tag.
                </video>

            </div>

            <?php } ?>
        </div>
    </div>

  <figure class="wp-block-image hero-decor">
    <img decoding="async" 
         src="<?php echo get_template_directory_uri(); ?>/assets/images/small_h.png" 
         alt="Hero">
</figure>



</section>