<?php
add_action('init', function () {
    register_block_type('custom/cta-block2', array(
        'render_callback' => 'custom_cta_block_render2',
        'attributes'      => array(
            'titleText'       => array('type' => 'string', 'default' => 'تواصل معنا لمزيد من التفاصيل'),
            'phoneNumber'     => array('type' => 'string', 'default' => ''),
            'whatsNumber'     => array('type' => 'string', 'default' => ''),
            'enableCTAPopup'  => array('type' => 'boolean', 'default' => false),
            'ctaPopupText'    => array('type' => 'string', 'default' => 'طلب عرض سعر'),
        ),
    ));
});

function custom_cta_block_render2($attributes) {
    $titleText      = isset($attributes['titleText']) ? esc_html($attributes['titleText']) : 'تواصل معنا لمزيد من التفاصيل';
    $enableCTAPopup = !empty($attributes['enableCTAPopup']);
    $ctaPopupText   = !empty($attributes['ctaPopupText']) ? esc_html($attributes['ctaPopupText']) : 'طلب عرض سعر';

    $post_id = get_the_ID();

    // 1. من post meta
    $post_phone = get_post_meta($post_id, 'contact_phone', true);
    $post_whats = get_post_meta($post_id, 'contact_whatsapp', true);

    // 2. extra random numbers
    $extra_phones     = get_option('extra_phones', []);
    $extra_whatsapps  = get_option('extra_whatsapps', []);
    $random_extra_phone = !empty($extra_phones) ? $extra_phones[array_rand($extra_phones)] : null;
    $random_extra_whats = !empty($extra_whatsapps) ? $extra_whatsapps[array_rand($extra_whatsapps)] : null;

    // 3. من الإعدادات
    $option_phone = get_option('custom_phone');
    $option_whats = get_option('custom_whatsapp');

    // 4. من attributes
    $attr_phone = !empty($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '';
    $attr_whats = !empty($attributes['whatsNumber']) ? esc_html($attributes['whatsNumber']) : '';

    // اختيار الرقم النهائي حسب الأولوية
    $phoneNumber = !empty($post_phone)
        ? $post_phone
        : (
            !empty($random_extra_phone)
                ? $random_extra_phone
                : (
                    !empty($option_phone)
                        ? $option_phone
                        : $attr_phone
                )
        );

    $whatsNumber = !empty($post_whats)
        ? $post_whats
        : (
            !empty($random_extra_whats)
                ? $random_extra_whats
                : (
                    !empty($option_whats)
                        ? $option_whats
                        : $attr_whats
                )
        );

    $post_title = $post_id ? get_the_title($post_id) : 'المعرض';

    ob_start();
    ?>
    <div class="shortcodesection">
        <div class="container">
            <div class="custom_cta_shortcode cta_block2">
                <div class="headline sm_title shorttitle">
                    <span><?php echo $titleText; ?></span>
                </div>
                <div class="towitem">
                    <a id="cta_whats" target="_blank" class="whatsapp"
                       href="https://wa.me/<?php echo esc_attr($whatsNumber); ?>?text=أرغب في معرفة المزيد عن <?php echo esc_html($post_title); ?>">
                        <i class="fa fa-whatsapp" aria-hidden="true"></i> واتساب
                    </a>
                    <a id="cta_call" class="phone" href="tel:<?php echo esc_attr($phoneNumber); ?>">
                        <i class="fa fa-phone" aria-hidden="true"></i> اتصال
                    </a>

                    <?php if ($enableCTAPopup): ?>
                        <span id="cta_pop" class="formpopub openform">
                            <i class="fa fa-envelope-open-o" aria-hidden="true"></i> <?php echo $ctaPopupText; ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
