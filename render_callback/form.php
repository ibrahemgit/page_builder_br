<?php 
function custom_form_block_render($attributes) {
    $form_title = isset($attributes['formTitle']) ? esc_html($attributes['formTitle']) : 'استلم دعوتك المجانية';
    $submit_button_text = isset($attributes['submitButtonText']) ? esc_html($attributes['submitButtonText']) : 'إرسال';
    $form_id = isset($attributes['formID']) ? esc_attr($attributes['formID']) : 'header_form';
    $name_placeholder = isset($attributes['namePlaceholder']) ? esc_attr($attributes['namePlaceholder']) : 'الاسم بالكامل';
    $phone_placeholder = isset($attributes['phonePlaceholder']) ? esc_attr($attributes['phonePlaceholder']) : 'رقم الهاتف';
    $bg_color = isset($attributes['bgColor']) ? esc_attr($attributes['bgColor']) : '#000000';
    $reverse_color = isset($attributes['reverseColor']) && $attributes['reverseColor'] ? 'reverscolor' : '';
    $button_bg_color = isset($attributes['buttonBgColor']) ? esc_attr($attributes['buttonBgColor']) : '#0073aa';
    $button_text_color = isset($attributes['buttonTextColor']) ? esc_attr($attributes['buttonTextColor']) : '#ffffff';

    $post_id = get_the_ID();
    ob_start();
    ?>
    <div class='project_header <?php echo esc_attr($reverse_color); ?>' style='background-color: <?php echo $bg_color; ?>;' data_id='<?php echo $post_id; ?>'>
        <div class='container'>
            <div class='headflx'>
                <div class="contact_us">
                    <div class="form-title"><?php echo $form_title; ?></div>
                    <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" id='<?php echo $form_id; ?>'>
                        <div class="cusinpput">
                            <label for="name">الاسم *</label>
                            <input placeholder="<?php echo $name_placeholder; ?>" type="text" id="name" name="name" required />
                        </div>
                        <div class="cusinpput">
                            <label for="phone">رقم الهاتف *</label>
                            <input placeholder="<?php echo $phone_placeholder; ?>" type="tel" id="phone" name="phone" required />
                        </div>
                        <button class='submit' type="submit" style="background-color: <?php echo $button_bg_color; ?>; color: <?php echo $button_text_color; ?>;">
                            <?php echo $submit_button_text; ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}


// تسجيل البلوك مع render_callback
register_block_type('custom/form-block', array(
    'render_callback' => 'custom_form_block_render',
    'attributes' => array(
        'formTitle' => array('type' => 'string', 'default' => 'استلم دعوتك المجانية'),
        'submitButtonText' => array('type' => 'string', 'default' => 'إرسال'),
        'formID' => array('type' => 'string', 'default' => 'header_form'),
        'namePlaceholder' => array('type' => 'string', 'default' => 'الاسم بالكامل'),
        'phonePlaceholder' => array('type' => 'string', 'default' => 'رقم الهاتف'),
        'bgColor' => array('type' => 'string', 'default' => '#000000'),
        'reverseColor' => array('type' => 'boolean', 'default' => false),
        'buttonBgColor' => array('type' => 'string', 'default' => '#0073aa'), // ✅ لون خلفية الزر
        'buttonTextColor' => array('type' => 'string', 'default' => '#ffffff') // ✅ لون نص الزر
    ),
));
