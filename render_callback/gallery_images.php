<?php 
function gallery_images_block_render($attributes) {
    $gallery_title = isset($attributes['galleryTitle']) ? esc_html($attributes['galleryTitle']) : 'أهم المطورين';
    $images = isset($attributes['images']) ? $attributes['images'] : [];

    ob_start();
    ?>
    <div class='section_gallry'>
        <div class='container'>
            <div class="pjc-title"><?php echo $gallery_title; ?></div>
            <div class='gallery_images'>
                <?php
                if (!empty($images)) {
                    foreach ($images as $image_url) {
                        echo '<img loading="lazy" decoding="async" src="' . esc_url($image_url) . '" alt="صورة المعرض">';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// تسجيل البلوك مع render_callback
register_block_type('custom/gallery-images', array(
    'render_callback' => 'gallery_images_block_render',
    'attributes' => array(
        'galleryTitle' => array('type' => 'string', 'default' => 'أهم المطورين'),
        'images' => array('type' => 'array', 'default' => [])
    ),
));
