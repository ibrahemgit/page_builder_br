<?php
add_action('init', function () {
    register_block_type('custom/footer-cta-block2', array(
        'render_callback' => 'footer_cta_block_render2',
        'attributes'      => array(
            'titleText'   => array('type' => 'string', 'default' => 'تواصل معنا لمزيد من التفاصيل'),
            'phoneNumber' => array('type' => 'string', 'default' => ''),
            'whatsNumber' => array('type' => 'string', 'default' => ''),
            'borderColor' => array('type' => 'string', 'default' => '#000000'), // ✅ أضفنا اللون
        ),
    ));
});

function footer_cta_block_render2($attributes) {
    $titleText = isset($attributes['titleText']) ? esc_html($attributes['titleText']) : 'تواصل معنا لمزيد من التفاصيل';
    $borderColor = isset($attributes['borderColor']) ? esc_attr($attributes['borderColor']) : '#000000'; // ✅ استخدم اللون

    $post_id = get_the_ID();

    // 1. ابدأ بالأرقام من post meta
    $post_phone  = get_post_meta($post_id, 'contact_phone', true);
    $post_whats  = get_post_meta($post_id, 'contact_whatsapp', true);

    // 2. fallback: من الإعدادات
    $option_phone = get_option('custom_phone');
    $option_whats = get_option('custom_whatsapp');

    // 3. fallback نهائي: من attributes
    $attr_phone = isset($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '';
    $attr_whats = isset($attributes['whatsNumber']) ? esc_html($attributes['whatsNumber']) : '';

    // تحديد النهائي
    $phoneNumber  = !empty($post_phone) ? $post_phone : (!empty($option_phone) ? $option_phone : $attr_phone);
    $whatsNumber  = !empty($post_whats) ? $post_whats : (!empty($option_whats) ? $option_whats : $attr_whats);

    $post_title = $post_id ? get_the_title($post_id) : 'المعرض';

    ob_start();
    ?>
    <div class="footer_margin"></div>
    <div class="footer_CTA2" style="border-color: <?php echo $borderColor; ?>;">
        <div class="container">
            <div class="footer_cta_block2">
                <div class="footer_title" style="border-color: <?php echo $borderColor; ?>;">
                    <span><?php echo $titleText; ?></span>
                </div>
                <div class="towitem">
                    <a id="cta_whats" target="_blank" class="whatsapp" href="https://wa.me/<?php echo esc_attr($whatsNumber); ?>?text=أرغب في معرفة المزيد عن <?php echo esc_html($post_title); ?>">
                        <i class="fa fa-whatsapp" aria-hidden="true"></i> واتساب
                    </a>
                    <span id="subform" class='subform'>
                        سجل بياناتك
                    </span>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
