<?php

/**
 * Coming Soon Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'coming-soon-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'coming-soon';
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
            'className' => 'coming-soon__grid',
        ],
        [
            [
                'core/group',
                [
                    'className' => 'coming-soon__left',
                ],
                [
                    [
                        'utopian/svg'
                    ]
                ]
            ],
            [
                'core/group',
                [
                    'className' => 'coming-soon__right',
                ],
                [

                    [
                        'core/group',
                        [
                            'className' => 'coming-soon__top-text',
                        ],
                        [
                            [
                                'core/paragraph',
                                [
                                    'content' => 'Website coming soon',
                                ]
                            ]
                        ]
                    ],
                    [
                        'core/image',
                        [
                            'className' => 'hero-image',
                            'url' => get_theme_file_uri('/assets/images/coming-soon.jpg'),
                            'alt' => 'Haven',
                        ],
                    ],
                    [
                        'core/group',
                        [
                            'className' => 'coming-soon__contact',
                        ],
                        [
                            [
                                'core/buttons',
                                [],
                                [
                                    [
                                        'core/button',
                                        [
                                            'text' => 'Contact Us',
                                            'url' => '#',
                                        ]
                                    ]
                                ]
                            ],
                            [
                                'core/paragraph',
                                [
                                    'content' => '<a href="tel:613-617-4576">613-617-4576</a>',
                                    'className' => 'coming-soon__phone'
                                ]
                            ],
                            [
                                'core/paragraph',
                                [
                                    'content' => '1769 St-Laurent Blvd Suite 117<br>Ottawa Ontario  K1G 3V4',
                                ]
                            ]
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