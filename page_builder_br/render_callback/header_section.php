<?php 
function custom_home_banner_render($attributes) {
    $banner_image_pc = isset($attributes['bannerImagePc']) ? esc_url($attributes['bannerImagePc']) : 'https://boldroutesexpo.com/wp-content/uploads/2025/02/43255310080-scaled.webp';
    $banner_image_mobile = isset($attributes['bannerImageMobile']) ? esc_url($attributes['bannerImageMobile']) : 'https://boldroutesexpo.com/wp-content/uploads/2025/02/43255310080-scaled.webp';
    $banner_title = isset($attributes['bannerTitle']) ? esc_html($attributes['bannerTitle']) : 'عنوان البانر';

    ob_start();
    ?>
    <style>
        :root {
            --homepanner: url(<?php echo esc_url($banner_image_pc); ?>);
            --homepanner_mobile: url(<?php echo esc_url($banner_image_mobile); ?>);
        }
    </style>
    <div class='herosection'>
        <div class='container'>
            <div class='flxcnter'>
                <h1><?php echo esc_html($banner_title); ?></h1>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// ✅ تسجيل البلوك مع `render_callback`
register_block_type('custom/home-banner', array(
    'render_callback' => 'custom_home_banner_render',
    'attributes' => array(
        'bannerImagePc' => array('type' => 'string', 'default' => 'https://boldroutesexpo.com/wp-content/uploads/2025/02/43255310080-scaled.webp'),
        'bannerImageMobile' => array('type' => 'string', 'default' => 'https://boldroutesexpo.com/wp-content/uploads/2025/02/43255310080-scaled.webp'),
        'bannerTitle' => array('type' => 'string', 'default' => 'عنوان البانر'),
    ),
));
