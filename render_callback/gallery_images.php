<?php 
function gallery_images_block_render($attributes) {
    $gallery_title = isset($attributes['galleryTitle']) ? esc_html($attributes['galleryTitle']) : 'صور المشروع';
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
                        echo '<img loading="lazy" decoding="async" src="' . esc_url($image_url) . '" alt="صور">';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        var lightboximg = <?php echo json_encode(array_map('esc_url', $images)); ?>;
    </script>
    <?php
    return ob_get_clean();
}

// تسجيل البلوك مع render_callback
register_block_type('custom/gallery-images', array(
    'render_callback' => 'gallery_images_block_render',
    'attributes' => array(
        'galleryTitle' => array('type' => 'string', 'default' => 'صور المشروع'),
        'images' => array('type' => 'array', 'default' => [])
    ),
));
