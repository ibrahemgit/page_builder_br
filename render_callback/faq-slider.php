<?php
function render_faq_slider_block($attributes) {
    if (empty($attributes['items']) || !is_array($attributes['items'])) return '';

    $title = !empty($attributes['widgetTitle']) ? esc_html($attributes['widgetTitle']) : '';

    ob_start();
    ?>
    <div class="shortcodesection">
        <div class="container">
            <?php if ($title): ?>
                <div class="headline sm_title shorttitle">
                    <span><?php echo $title; ?></span>
                </div>
            <?php endif; ?>
            
            <div class="faq-slick-widget">
                <div class="slider-nav">
                    <?php foreach ($attributes['items'] as $index => $item): ?>
                        <div class="faq-tab-item" data-index="<?php echo $index; ?>">
                            <?php echo esc_html($item['title']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="faq-slider-contents">
                    <?php foreach ($attributes['items'] as $index => $item): ?>
                        <div class="faq-content-item ph-content" data-index="<?php echo $index; ?>" style="<?php echo $index !== 0 ? 'display:none;' : ''; ?>">
                            <?php echo wp_kses_post($item['content']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

<script>
jQuery(document).ready(function ($) {
    // 1. تهيئة Slick
    $('.slider-nav').slick({
        slidesToShow: 3,
        arrows: true,
        infinite: false,
        rtl: true,
        variableWidth: false,
        focusOnSelect: false,
        prevArrow: '<button type="button" class="slick-prev"><svg viewBox="0 0 24 24" width="24"><path d="M9 6l6 6-6 6"/></svg></button>',
        nextArrow: '<button type="button" class="slick-next"><svg viewBox="0 0 24 24" width="24"><path d="M15 6l-6 6 6 6"/></svg></button>',
        responsive: [
            { breakpoint: 768, settings: { slidesToShow: 2 } },
            { breakpoint: 480, settings: { slidesToShow: 1 } }
        ]
    });

    $('.faq-tab-item').first().addClass('active');

    $('.slider-nav').on('click', '.faq-tab-item', function () {

        const $clicked = $(this);
        const index = $clicked.data('index');

        // ✅ لو نفس الزر مضغوط عليه مسبقًا – تجاهل
        if ($clicked.hasClass('active')) return;

        // ✅ فعّل التاب
        $('.faq-tab-item').removeClass('active');
        $clicked.addClass('active');

        // ✅ إخفاء كل العناصر ما عدا المطلوب
        $('.faq-content-item').hide();
        $('.faq-content-item[data-index="' + index + '"]').fadeIn(200);
    });

});

</script>


    <?php
    return ob_get_clean();
}


function register_faq_slider_block() {
    register_block_type('custom/faq-accordion', [ // نفس الـ name بالضبط من JS
        'attributes' => [
            'widgetTitle' => [
                'type' => 'string',
                'default' => 'الأسئلة الشائعة'
            ],
            'items' => [
                'type' => 'array',
                'default' => []
            ]
        ],
        'render_callback' => 'render_faq_slider_block'
    ]);
}
add_action('init', 'register_faq_slider_block');
