<?php 
function gallery_images_grid_block_render($attributes) {
    $gallery_title    = isset($attributes['galleryTitle']) ? esc_html($attributes['galleryTitle']) : 'معرض الصور';
    $gallery_subtitle = isset($attributes['gallerySubtitle']) ? esc_html($attributes['gallerySubtitle']) : '';
    $images           = isset($attributes['images']) ? $attributes['images'] : [];
    $background_color = isset($attributes['backgroundColor']) ? esc_attr($attributes['backgroundColor']) : '#fff';
    $text_color       = isset($attributes['textColor']) ? esc_attr($attributes['textColor']) : '#000';

    ob_start();
    ?>
    <div class='section_gallry_grid' style="background-color: <?php echo $background_color; ?>; color: <?php echo $text_color; ?>;">
        <div class='container'>
        
            <?php if (!empty($gallery_title)): ?>
                <div class="pjc-title" style="color: <?php echo $text_color; ?>;"><?php echo $gallery_title; ?></div>
            <?php endif; ?>
            <?php if (!empty($gallery_subtitle)): ?>
                <div class="pjc-subtitle" style="color: <?php echo $text_color; ?>; "><?php echo $gallery_subtitle; ?></div>
            <?php endif; ?>
            
            <div class='gallery_images_grid'>
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
register_block_type('custom/gallery-images-grid', array(
    'render_callback' => 'gallery_images_grid_block_render',
    'attributes' => array(
        'galleryTitle'    => array('type' => 'string', 'default' => 'معرض الصور'),
        'gallerySubtitle' => array('type' => 'string', 'default' => 'مجموعة مختارة من أجمل الصور'),
        'images'          => array('type' => 'array', 'default' => []),
        'backgroundColor' => array('type' => 'string', 'default' => '#fff'),
        'textColor'       => array('type' => 'string', 'default' => '#000'),
    ),
));