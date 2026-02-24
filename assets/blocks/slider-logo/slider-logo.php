<?php

/**
 * Logo Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$images = get_field('slider_images');

if ($images):

    $total_rows = count($images);
    $repeat_count = 1;

    if ($total_rows <= 2) {
        $repeat_count = 4;
    } elseif ($total_rows <= 4) {
        $repeat_count = 3;
    } else {
        $repeat_count = 2;
    }

    $repeated_images = [];
    for ($i = 0; $i < $repeat_count; $i++) {
        $repeated_images = array_merge($repeated_images, $images);
    }
?>

<div <?php echo get_block_wrapper_attributes(['class' => 'slider_logos']); ?>>
    <div class="swiper">
        <div class="swiper-wrapper">

            <?php foreach ($repeated_images as $img_row):

                $image = $img_row['image_slide_logos'];
                $link  = $img_row['link']; // ✅ subcampo del repeater

                if (empty($image)) continue;
            ?>

            <div class="swiper-slide">
                <div class="logo_wrapper">

                    <?php if (!empty($link)): ?>
                    <a href="<?php echo esc_url($link); ?>" class="wp-block-image size-full">
                        <?php endif; ?>

                        <img width="243" height="25" src="<?php echo esc_url($image['url']); ?>"
                            alt="<?php echo esc_attr($image['alt']); ?>">

                        <?php if (!empty($link)): ?>
                    </a>
                    <?php endif; ?>

                </div>
            </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>

<?php endif; ?>