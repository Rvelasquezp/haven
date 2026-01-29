<?php

/**
 * Services Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Campo ACF (Post Object multiple → retorna IDs)
$careers_selected = get_field('careers');

// Base query
$args = array(
    'post_type'      => 'career',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'ASC',
);

// Si hay selección → solo esos
if ( ! empty($careers_selected) ) {
    $args['post__in'] = $careers_selected;
    $args['orderby'] = 'post__in'; // respeta el orden del cliente
}

$query = new WP_Query($args);

if ($query->have_posts()) : ?>

<div class="career-list">

    <?php 
    while ($query->have_posts()) : $query->the_post();     
    ?>
    <a href="<?php echo esc_url( get_permalink() ); ?>" class="career-link">
        <h3 class="career"><?php the_title(); ?></h3>
        <svg id="Groupe_1443" data-name="Groupe 1443" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" width="31.657" height="24.643" viewBox="0 0 31.657 24.643">
            <defs>
                <clipPath id="clip-path">
                    <rect id="Rectangle_2384" data-name="Rectangle 2384" width="31.657" height="24.643"
                        fill="#282626" />
                </clipPath>
            </defs>
            <g id="Groupe_1441" data-name="Groupe 1441" transform="translate(0 0)">
                <path id="Tracé_2569" data-name="Tracé 2569"
                    d="M17.7,1.806a1.818,1.818,0,0,0,.5,1.275l7.506,7.506H1.77a1.77,1.77,0,1,0,0,3.541H25.706L18.2,21.563a1.778,1.778,0,0,0,2.478,2.549l10.48-10.48c.071-.071.142-.212.212-.283a1.684,1.684,0,0,0,.142-1.629,1.542,1.542,0,0,0-.354-.567L20.678.531a1.711,1.711,0,0,0-2.478,0,1.707,1.707,0,0,0-.5,1.275"
                    transform="translate(0 0)" fill="#282626" />
            </g>
        </svg>

    </a>
    <?php endwhile; ?>

</div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>