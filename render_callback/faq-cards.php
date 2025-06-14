<?php

function render_card_section_block($attributes) {
    if (empty($attributes['cards']) || !is_array($attributes['cards'])) {
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
            <div class="custom-card-wrapper" >
                <?php foreach ($attributes['cards'] as $card): ?>
                    <?php
                        $title = esc_html($card['title'] ?? '');
                        $content = esc_html($card['content'] ?? '');
                        $bgColor = esc_attr($card['backgroundColor'] ?? '#1E2D2F');
                        $textColor = esc_attr($card['textColor'] ?? '#ffffff');
                    ?>
                    <div class="custom-card" style="background-color: <?php echo $bgColor; ?>; color: <?php echo $textColor; ?>;">
                        <div class="card-content">
                            <h3><?php echo $title; ?></h3>
                            <p><?php echo $content; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

register_block_type('custom/card-section', [
    'render_callback' => 'render_card_section_block',
    'attributes' => [
        "sectionTitle" => [
            "type" => 'string',
            "default" => 'عنوان القسم'
        ],
        'cards' => [
            'type' => 'array',
            'default' => []
        ]
    ]
]);