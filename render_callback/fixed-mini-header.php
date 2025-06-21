<?php

function render_contact_bar_block($attributes) {
    $bg = esc_attr($attributes['backgroundColor'] ?? '#222');
    $text = esc_attr($attributes['textColor'] ?? '#fff');

    $post_id = get_the_ID();

    // 1. ابدأ بالأرقام من post meta
    $post_phone  = get_post_meta($post_id, 'contact_phone', true);
    $post_whats  = get_post_meta($post_id, 'contact_whatsapp', true);

    // 2. fallback: من الإعدادات
    $option_phone = get_option('custom_phone');
    $option_whats = get_option('custom_whatsapp');

    // 3. fallback نهائي: من attributes
    $attr_phone = '';
    $attr_whats = '';

    // تحديد النهائي
    $phoneNumber  = !empty($post_phone) ? $post_phone : (!empty($option_phone) ? $option_phone : $attr_phone);
    $whatsNumber  = !empty($post_whats) ? $post_whats : (!empty($option_whats) ? $option_whats : $attr_whats);

    $post_title = $post_id ? get_the_title($post_id) : 'المعرض';


    ob_start();
    ?>
    <div class="custom-contact-bar" style="background-color: <?php echo $bg ?>; color: <?php echo $text ?>;">
        <div class='container'>
            <div class="contact-buttons">
                <a href="https://wa.me/<?php echo esc_attr($whatsNumber); ?>" class="contact-btn"><i class="fa fa-whatsapp"></i> واتساب</a>
                <a href="tel:<?php echo esc_attr($phoneNumber); ?>" class="contact-btn"><i class="fa fa-phone"></i> اتصل بنا</a>
                <span class="contact-btn openform"><i class="fa fa-envelope-open-o"></i> احجز وحدتك</span>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_action('init', function () {
    register_block_type('custom/contact-bar', [
        'attributes' => [
            'backgroundColor' => ['type' => 'string', 'default' => '#222'],
            'textColor'       => ['type' => 'string', 'default' => '#fff'],
        ],
        'render_callback' => 'render_contact_bar_block'
    ]);
});
