<?php

/**
 * Mission and Vision Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'mission-and-vision-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'mission-and-vision';
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
            'className' => 'mission-and-vision-left',
        ],
        [
            [
                'core/heading',
                [
                    'content' => 'Mission',
                    'level' => 3,
                ]
            ],
            [
                'core/paragraph',
                [
                    'content' => "<strong>We solve our clients' challenges and service our chosen markets by:</strong>"
                ]
            ],
            [
                'core/list',
                [
                    'values' => '<li>Fostering a long-term relationship with our clients, employees and partners</li><li>Creating a culture of collaboration, transparency and forward-thinking</li><li>Providing innovative and sustainable construction solutions</li><li>Delivering unparalleled customer service</li><li>Continuously staying up to date with new technologies and processes</li>'
                ]
            ]
        ]
    ],
    [
        'core/group',
        [
            'className' => 'mission-and-vision-right has-pink-red-background-color has-background',
        ],
        [
            [
                'core/heading',
                [
                    'content' => 'Vision',
                    'level' => 3,
                ]
            ],
            [
                'core/paragraph',
                [
                    'content' => 'Our vision is simple at Haven Building Group. We are building a team of talented, business oriented individuals that fosters a progressive mindset and a human-centric approach. We thrive on the idea that there is no company position that is more important than another.'
                ]
            ],
            [
                'core/paragraph',
                [
                    'content' => 'Haven Building Group is not built on the traditional corporate hierarchy model since we believe that transparency and teamwork are the two most important factors to build a strong and united company in today’s society. We teach and promote constant collaboration within teams and lead with the mindset of a forward-thinking team first-mentality.'
                ]
            ]
        ]
    ]
];

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
</section>