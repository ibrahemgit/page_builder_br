<?php 

function render_arabic_steps_block($attributes) {
    $title       = esc_html($attributes['widgetTitle'] ?? 'امتلك عقارك بخطوات بسيطة');
    $cta_text    = esc_html($attributes['ctaText'] ?? 'سجل اهتمامك');
    $cta_link    = esc_url($attributes['ctaLink'] ?? '#');
    $cta_bg      = esc_attr($attributes['ctaBgColor'] ?? '#3f51b5');
    $cta_textcol = esc_attr($attributes['ctaTextColor'] ?? '#ffffff');

    $steps = [
        [
            'title' => 'سجّل اهتمامك',
            'desc'  => 'املأ النموذج وسيقوم فريقنا بالتواصل معك.'
        ],
        [
            'title' => 'احجز وحدتك',
            'desc'  => 'اختر العقار المناسب وادفع عربون الحجز.'
        ],
        [
            'title' => 'تابع خطة الدفع',
            'desc'  => 'ادفع حسب الجدول المالي المحدد للمشروع.'
        ],
        [
            'title' => 'استلم العقار',
            'desc'  => 'عند الانتهاء من المشروع، يصبح عقارك جاهزًا للتسليم.'
        ]
    ];

    ob_start();
    ?>
    <div class="shortcodesection">
        <div class="container">
            <div class="arabic-steps-widget">
                <div class="headline sm_title shorttitle">
                    <span><?php echo $title; ?></span>
                </div>

                <div class="steps-row">
                    <?php foreach ($steps as $index => $step): ?>
                        <div class="step-wrapper">
                            <div class="step-item">
                                <div style="border-color: <?php echo $cta_bg; ?>; color: <?php echo $cta_bg; ?>;" class="step-circle"><?php echo $index + 1; ?></div>
                            </div>
                            <div class="step-label">
                                <div class="step-label-title"><?php echo esc_html($step['title']); ?></div>
                                <div class="step-label-desc"><?php echo esc_html($step['desc']); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="steps-cta">
                    <span 
                        data-url="<?php echo $cta_link; ?>" 
                        class="cta-button holdbrshor"
                        style="background-color: <?php echo $cta_bg; ?>; color: <?php echo $cta_textcol; ?>;"
                    >
                        <?php echo $cta_text; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_action('init', function () {
    register_block_type('custom/arabic-steps', [
        'attributes' => [
            'widgetTitle'    => ['type' => 'string', 'default' => 'امتلك عقارك بخطوات بسيطة'],
            'ctaText'        => ['type' => 'string', 'default' => 'سجل اهتمامك'],
            'ctaLink'        => ['type' => 'string', 'default' => '#'],
            'ctaBgColor'     => ['type' => 'string', 'default' => '#3f51b5'],
            'ctaTextColor'   => ['type' => 'string', 'default' => '#ffffff'],
        ],
        'render_callback' => 'render_arabic_steps_block'
    ]);
});
