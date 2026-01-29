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
$services_selected = get_field('list_services');

// Base query
$args = array(
    'post_type'      => 'service',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'ASC',
);

// Si hay selección → solo esos
if ( ! empty($services_selected) ) {
    $args['post__in'] = $services_selected;
    $args['orderby'] = 'post__in'; // respeta el orden del cliente
}

$query = new WP_Query($args);

if ($query->have_posts()) : ?>

<div class="services-grid">

    <?php 
    while ($query->have_posts()) : $query->the_post(); 
    $icon_white = get_field('icon_red', get_the_id());
    ?>

    <a href="<?php echo esc_url( get_permalink() ); ?>" class="service-card">
        <div class="equipe-icon">
            <?php if ($icon_white) : ?>
            <img src="<?php echo esc_url( $icon_white['url'] ); ?>" alt="<?php echo esc_attr( $icon_white['alt'] ); ?>">
            <?php endif; ?>
        </div>
        <h3 class="equipe-name"><?php the_title(); ?></h3>
    </a>

    <?php endwhile; ?>

</div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>