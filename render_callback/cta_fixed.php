<?php 

function render_footer_cta_block($attributes) {
    $phone_n = get_option('custom_phone');
    $whats_n = get_option('custom_whatsapp');

    if (empty($phone_n)) {
        $phone_n = esc_attr($attributes['phoneNumber']);
    }

    if (empty($whats_n)) {
        $whats_n = esc_attr($attributes['whatsNumber']);
    }

    $post_id = get_the_ID();
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
