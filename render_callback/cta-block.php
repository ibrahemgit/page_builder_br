<?php
// ✅ تسجيل البلوك عند `init`
add_action('init', function () {
    register_block_type('custom/cta-block', array(
        'render_callback' => 'custom_cta_block_render',
        'attributes'      => array(
            'titleText'   => array('type' => 'string', 'default' => 'تواصل معنا لمزيد من التفاصيل عن المعرض'),
            'phoneNumber' => array('type' => 'string', 'default' => '01044009735'),
            'whatsNumber' => array('type' => 'string', 'default' => '0123456789'),
        ),
    ));
});

// ✅ دالة الريندر الخاصة بالبلوك
function custom_cta_block_render($attributes) {
    $titleText   = isset($attributes['titleText']) ? esc_html($attributes['titleText']) : 'تواصل معنا لمزيد من التفاصيل عن المعرض';
    $phoneNumber = isset($attributes['phoneNumber']) ? esc_html($attributes['phoneNumber']) : '01044009735';
    $whatsNumber = isset($attributes['whatsNumber']) ? esc_html($attributes['whatsNumber']) : '0123456789';

    $post_id = get_the_ID();
    $post_title = $post_id ? get_the_title($post_id) : 'المعرض';

    ob_start(); // ✅ بدء التخزين المؤقت
    ?>
    <div class="shortcodesection">
        <div class="container">
            <div class="custom_cta_shortcode">
                <div class="headline sm_title shorttitle">
                    <span><?php echo $titleText; ?></span>
                </div>
                <div class="towitem">
                    
                    <a id="cta_whats" target="_blank" class="whatsapp" href="https://wa.me/<?php echo $whatsNumber; ?>?text=أرغب في معرفة المزيد عن <?php echo esc_html($post_title); ?>">
                        <i class="fa fa-whatsapp" aria-hidden="true"></i> واتساب
                    </a>
                    <a id="cta_call" class="phone" href="tel:<?php echo $phoneNumber; ?>">
                        <i class="fa fa-phone" aria-hidden="true"></i> اتصال
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean(); // ✅ إرجاع المحتوى المخزن
}
