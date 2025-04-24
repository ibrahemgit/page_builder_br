<?php
add_action('init', function () {
    register_block_type('custom/cta-block', array(
        'render_callback' => 'custom_cta_block_render',
        'attributes'      => array(
            'titleText'   => array('type' => 'string', 'default' => 'تواصل معنا لمزيد من التفاصيل'),
            'phoneNumber' => array('type' => 'string', 'default' => ''),
            'whatsNumber' => array('type' => 'string', 'default' => ''),
        ),
    ));
});

function custom_cta_block_render($attributes) {
    $titleText = isset($attributes['titleText']) ? esc_html($attributes['titleText']) : 'تواصل معنا لمزيد من التفاصيل';

    $post_id = get_the_ID();

    // 1. ابدأ بالأرقام من post meta
    $post_phone  = get_post_meta($post_id, 'contact_phone', true);
    $post_whats  = get_post_meta($post_id, 'contact_whatsapp', true);

    // 2. fallback: من الإعدادات
    $option_phone = get_option('custom_phone');
    $option_whats = get_option('custom_whatsapp');

    // 3. fallback نهائي: من attributes
    $attr_phone = isset($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '01044009738';
    $attr_whats = isset($attributes['whatsNumber']) ? esc_html($attributes['whatsNumber']) : '01044009738';

    // تحديد النهائي
    $phoneNumber  = !empty($post_phone) ? $post_phone : (!empty($option_phone) ? $option_phone : $attr_phone);
    $whatsNumber  = !empty($post_whats) ? $post_whats : (!empty($option_whats) ? $option_whats : $attr_whats);

    $post_title = $post_id ? get_the_title($post_id) : 'المعرض';

    ob_start();
    ?>
    <div class="shortcodesection">
        <div class="container">
            <div class="custom_cta_shortcode">
                <div class="headline sm_title shorttitle">
                    <span><?php echo $titleText; ?></span>
                </div>
                <div class="towitem">
                    <a id="cta_whats" target="_blank" class="whatsapp" href="https://wa.me/<?php echo esc_attr($whatsNumber); ?>?text=أرغب في معرفة المزيد عن <?php echo esc_html($post_title); ?>">
                        <i class="fa fa-whatsapp" aria-hidden="true"></i> واتساب
                    </a>
                    <a id="cta_call" class="phone" href="tel:<?php echo esc_attr($phoneNumber); ?>">
                        <i class="fa fa-phone" aria-hidden="true"></i> اتصال
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
