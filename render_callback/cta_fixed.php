<?php 

function render_footer_cta_block($attributes) {
    $post_id = get_the_ID();

    // 1. post meta
    $post_phone = get_post_meta($post_id, 'contact_phone', true);
    $post_whats = get_post_meta($post_id, 'contact_whatsapp', true);

    // 2. option
    $option_phone = get_option('custom_phone');
    $option_whats = get_option('custom_whatsapp');

    // 3. block attributes fallback
    $attr_phone = !empty($attributes['phoneNumber']) ? esc_attr($attributes['phoneNumber']) : '';
    $attr_whats = !empty($attributes['whatsNumber']) ? esc_attr($attributes['whatsNumber']) : '';

    // النهائي
    $phone_n = !empty($post_phone) ? $post_phone : (!empty($option_phone) ? $option_phone : $attr_phone);
    $whats_n = !empty($post_whats) ? $post_whats : (!empty($option_whats) ? $option_whats : $attr_whats);

    $post_title = $post_id ? get_the_title($post_id) : 'المعرض';

    ob_start();
    ?>
    <div class="footer-cta">
        <a id="cta_whats" target="_blank" class="social-item whats" href="https://wa.me/<?php echo esc_attr($whats_n); ?>?text= اريد الاستفسار عن : <?php echo esc_html($post_title); ?>">
            <i class="fa fa-whatsapp" aria-hidden="true"></i> 
        </a>
        <a id="cta_call" class="social-item phone" href="tel:<?php echo esc_attr($phone_n); ?>">
            <i class="fa fa-phone" aria-hidden="true"></i> 
        </a>
    </div>
    <?php
    return ob_get_clean();
}


register_block_type('custom/footer-cta-block', array(
    'render_callback' => 'render_footer_cta_block',
    'attributes' => array(
        'phoneNumber' => array('type' => 'string', 'default' => ''),
        'whatsNumber' => array('type' => 'string', 'default' => ''),
    ),
));
