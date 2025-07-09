<?php

function render_accordion_section_block($attributes) {
    if (empty($attributes['accordions']) || !is_array($attributes['accordions'])) {
        return '';
    }

    $sectionTitle = !empty($attributes['sectionTitle']) ? esc_html($attributes['sectionTitle']) : '';

    ob_start();
    ?>
    <div class="shortcodesection">
        <div class="container">
            <?php if ($sectionTitle): ?>
                <div class="headline sm_title shorttitle">
                    <span><?php echo $sectionTitle; ?></span>
                </div>
            <?php endif; ?>

            <div class="accordion-wrapper" dir="auto">
                <?php foreach ($attributes['accordions'] as $item): ?>
                    <?php
                        $title = esc_html($item['title'] ?? '');
                        $content = wp_kses_post($item['content'] ?? '');
                        $item_id = 'accordion-' . esc_attr($item['id']);
                    ?>
                    <div class="accordion-item">
                        <button
                            class="accordion-header"
                            data-toggle="accordion"
                            aria-expanded="false"
                            aria-controls="<?php echo $item_id; ?>"
                        >
                            <span class="accordion-label"><?php echo $title; ?></span>
                            <i class="fa fa-chevron-down accordion-icon" aria-hidden="true"></i>
                        </button>

                        <div id="<?php echo esc_attr($item_id); ?>" class="accordion-content ph-content" style="display: none;">
                            <div class="accordion-inner">
                                <?php echo $content; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

register_block_type('custom/accordion-section', [
    'render_callback' => 'render_accordion_section_block',
    'attributes' => [
        'sectionTitle' => [
            'type' => 'string',
            'default' => 'عنوان القسم',
        ],
        'accordions' => [
            'type' => 'array',
            'default' => [],
        ],
    ],
]);
