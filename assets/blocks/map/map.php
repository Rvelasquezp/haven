<div <?php echo get_block_wrapper_attributes(['class' => 'maps_container']); ?>>
    <div class="acf-map" data-zoom="16">
        <?php
            $location = get_field('google_map_adresse');
            // var_dump($location);            

            if ($location) {
                $lat = $location['lat'];
                $lng = $location['lng'];

                // echo $lat;
                // echo $lng;
                if (is_numeric($lat) && is_numeric($lng)) {
                    // echo "entre";
                    ?>

        <div class="marker" data-lat="<?php echo esc_attr($lat); ?>" data-lng="<?php echo esc_attr($lng); ?>"></div>
        <?php
                } else {
                    echo '<!-- Invalid lat/lng values -->';
                }
            } else {
                echo '<!-- Location not found -->';
            }
        ?>
    </div>
</div>