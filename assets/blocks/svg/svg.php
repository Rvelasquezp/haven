<?php
if (!array_key_exists('svgLink', $attributes) || !$attributes['svgLink']) {
    $content = file_get_contents($attributes['svgURL']);
    echo str_replace('<svg', '<svg class="svg-block"', $content);
} else {
    if (!$attributes['svgLink']) {
        $attributes['svgLink'] = '#';
    }
    $arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);
    $content = file_get_contents($attributes['svgURL'], false, stream_context_create($arrContextOptions));
    echo '<a href="' . $attributes['svgLink'] . '">' . str_replace('<svg', '<svg class="svg-block"', $content) . '</a>';
}
