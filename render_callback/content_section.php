<?php 
function custom_project_content_block_render($attributes) {
    $section_title = isset($attributes['sectionTitle']) ? esc_html($attributes['sectionTitle']) : 'عنوان القسم';
    $content = isset($attributes['content']) ? wp_kses_post($attributes['content']) : '';
    $image_url = isset($attributes['imageUrl']) ? esc_url($attributes['imageUrl']) : '';
    $reverse_image = isset($attributes['reverseImage']) && $attributes['reverseImage'] ? 'reversimg' : '';

    ob_start();
    ?>
    <div class='project_content <?php echo esc_attr($reverse_image); ?>' id='<?php echo sanitize_title($section_title); ?>'>
        <div class='container'>
            <h2 class='pjc-title'><?php echo $section_title; ?></h2>
            <div class='pjc-flx' >
                <?php if (!empty($image_url)): ?>
                    <div class='pjc-imgbx' >
                        <img src='<?php echo esc_url($image_url); ?>' loading="lazy" width="500" height="400" decoding="async" alt='<?php echo esc_attr($section_title); ?>'>
                    </div>
                <?php endif; ?>
                <div class='ph-content'>
                    <?php echo wpautop($content); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// ✅ تسجيل البلوك مع `render_callback`
register_block_type('custom/project-content-block', array(
    'render_callback' => 'custom_project_content_block_render',
    'attributes' => array(
        'sectionTitle' => array('type' => 'string', 'default' => 'عنوان القسم'),
        'content' => array('type' => 'string', 'default' => ''),
        'imageUrl' => array('type' => 'string', 'default' => ''),
        'reverseImage' => array('type' => 'boolean', 'default' => false),
    ),
));
