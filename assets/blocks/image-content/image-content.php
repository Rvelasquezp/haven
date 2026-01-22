<?php

/**
 * Image Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'image-content-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'image-content';
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
            'className' => 'image-content-left',
        ],
        [
            [
                'core/image',
                [
                    'url' => get_template_directory_uri() . '/assets/images/sample1.png',
                    'alt' => 'image-content-left',
                ]
            ],
            [
                'core/group',
                [
                    'className' => 'has-pink-red-background-color has-background',
                ],
                []
            ]
        ]
    ],
    [
        'core/group',
        [
            'className' => 'image-content-right',
        ],
        [
            [
                'core/heading',
                [
                    'content' => 'We are a full service boutique <span style="color:#ed1849">construction management firm</span>',
                    'level' => 2,
                ]
            ],
            [
                'core/paragraph',
                [
                    'content' => 'Newly formed, our team brings a vast amount of experience with a diverse portfolio of fine residential, commercial and retail projects in the City of Ottawa. We specialize in project management and we offer clients our expertise in every phase of the building, renovation, restoration process, from the initial designs and plans, specifications and permitting, all the way through to the end of construction. We are equipped to tackle larger and smaller projects (See our service list). Our business model is structured to keep our overhead low in order to deliver projects at lower costs while delivering superior quality projects.'
                ]
            ],
            [
                'core/paragraph',
                [
                    'content' => 'Our qualified, creative team of craftsmen, subcontractors and managers helps us meet the individual needs of every client, with unique solutions and reliable professionalism. We work with clients on an individual basis to achieve a result that suits them best. Retaining Haven Building Group not only results in superior quality and service, it can provide significant cost savings as well.'
                ]
            ],
            [
                'core/buttons',
                [],
                [
                    [
                        'core/button',
                        [
                            'text' => 'CONTACT US',
                            'url' => '#'
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