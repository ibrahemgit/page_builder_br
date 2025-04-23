<?php 
function custom_project_content_block_render($attributes) {
    $section_title = isset($attributes['sectionTitle']) ? esc_html($attributes['sectionTitle']) : 'عنوان القسم';
    $content = isset($attributes['content']) ? wp_kses_post($attributes['content']) : '';
    $image_url = isset($attributes['imageUrl']) ? esc_url($attributes['imageUrl']) : '';
    $reverse_image = isset($attributes['reverseImage']) && $attributes['reverseImage'] ? 'reversimg' : '';

    $pricetbda = isset($attributes['pricetbda']) ? esc_html($attributes['pricetbda']) : '';
    $mkadmybda = isset($attributes['mkadmybda']) ? esc_html($attributes['mkadmybda']) : '';
    $tkseetybda = isset($attributes['tkseetybda']) ? esc_html($attributes['tkseetybda']) : '';

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
                <div class='contentsection'>
                    <div class='ph-content'>
                        <?php echo wpautop($content); ?>
                    </div>
                    
                    <?php if(!empty($pricetbda) || !empty($mkadmybda) || !empty($tkseetybda)) : ?>
                        <div class="head_section_payplan">
                            <?php if(!empty($pricetbda)) : ?>
                            <div class="item_plan">
                                <div class="plantext">الأسعار تبدأ من</div>
                                <div class="plantitle"><?php echo sanitize_text_field($pricetbda); ?></div>
                            </div>
                            <?php endif; ?>

                            <?php if(!empty($mkadmybda)) : ?>
                            <div class="item_plan">
                                <div class="plantext">مقدم يبدأ من</div>
                                <div class="plantitle"><?php echo sanitize_text_field($mkadmybda); ?></div>
                            </div>
                            <?php endif; ?>

                            <?php if(!empty($tkseetybda)) : ?>
                            <div class="item_plan">
                                <div class="plantext">تقسيط يصل حتى</div>
                                <div class="plantitle"><?php echo sanitize_text_field($tkseetybda); ?></div>
                            </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
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

        'pricetbda' => array('type' => 'string', 'default' => ''),
        'mkadmybda' => array('type' => 'string', 'default' => ''),
        'tkseetybda' => array('type' => 'string', 'default' => ''),

    ),
));
