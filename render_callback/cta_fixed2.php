<?php
add_action('init', function () {
    register_block_type('custom/footer-cta-block2', array(
        'render_callback' => 'footer_cta_block_render2',
        'attributes'      => array(
            'titleText'   => array('type' => 'string', 'default' => 'تواصل معنا لمزيد من التفاصيل'),
            'phoneNumber' => array('type' => 'string', 'default' => ''),
            'whatsNumber' => array('type' => 'string', 'default' => ''),
            'borderColor' => array('type' => 'string', 'default' => '#000000'),
        ),
    ));
});

function footer_cta_block_render2($attributes) {
    $titleText   = isset($attributes['titleText']) ? esc_html($attributes['titleText']) : 'تواصل معنا لمزيد من التفاصيل';
    $borderColor = isset($attributes['borderColor']) ? esc_attr($attributes['borderColor']) : '#000000';
    $post_id     = get_the_ID();

    // 1. post meta
    $post_phone = get_post_meta($post_id, 'contact_phone', true);
    $post_whats = get_post_meta($post_id, 'contact_whatsapp', true);

    // 2. extra random numbers
    $extra_phones = get_option('extra_phones', []);
    $extra_whatsapps = get_option('extra_whatsapps', []);
    $random_extra_phone = !empty($extra_phones) ? $extra_phones[array_rand($extra_phones)] : null;
    $random_extra_whats = !empty($extra_whatsapps) ? $extra_whatsapps[array_rand($extra_whatsapps)] : null;

    // 3. option
    $option_phone = get_option('custom_phone');
    $option_whats = get_option('custom_whatsapp');

    // 4. block attributes fallback
    $attr_phone = !empty($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '';
    $attr_whats = !empty($attributes['whatsNumber']) ? esc_html($attributes['whatsNumber']) : '';

    // تحديد الرقم النهائي حسب الترتيب المطلوب
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
