<?php

/**
 * Équipe Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Campo ACF (Post Object multiple → retorna IDs)
$equipe_selected = get_field('equipe');

// Base query
$args = array(
    'post_type'      => 'equipe',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
);

// Si hay selección → solo esos
if ( ! empty($equipe_selected) ) {
    $args['post__in'] = $equipe_selected;
    $args['orderby'] = 'post__in'; // respeta el orden del cliente
}

$query = new WP_Query($args);

if ($query->have_posts()) : ?>

<div class="equipe-grid">

    <?php while ($query->have_posts()) : $query->the_post(); ?>

    <article class="equipe-card">

        <?php if (has_post_thumbnail()) : ?>
        <div class="equipe-photo">
            <?php the_post_thumbnail('medium'); ?>
        </div>
        <?php endif; ?>

        <div class="equipe-content">
            <h3 class="equipe-name"><?php the_title(); ?></h3>

            <?php 
                    // Campo ACF "poste" (cargo)
                    $poste = get_field('poste');
                    if ($poste) : ?>
            <p class="equipe-poste"><?php echo esc_html($poste); ?></p>
            <?php endif; ?>

            <div class="equipe-description">
                <?php the_content(); ?>
            </div>
        </div>

    </article>

    <?php endwhile; ?>

</div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>