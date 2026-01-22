<?php

/**
 * Our FAQ Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'our-faq-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'our-faq';
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
            'className' => 'our-faq-container',
        ],
        [
            [
                'core/group',
                [
                    'className' => 'our-faq-left',
                ],
                [
                    [
                        'core/heading',
                        [
                            'content' => 'FAQ',
                            'level' => 3,
                        ]
                    ],
                    [
                        'core/group',
                        [
                            'className' => 'our-faq-items',
                        ],
                        [
                            ['utopian/faq'],
                            ['utopian/faq'],
                            ['utopian/faq'],
                            ['utopian/faq'],
                            ['utopian/faq']
                        ]
                    ]
                ]
            ],
            [
                'core/group',
                [
                    'className' => 'our-faq-right',
                ],
                [
                    [
                        'core/image',
                        [
                            'url' => get_template_directory_uri() . '/assets/images/small_h.png',
                        ]
                    ]
                ]
            ]
        ]
    ]
];
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
</section>