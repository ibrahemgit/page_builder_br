<?php

function render_review_block_callback($attributes) {
    if (empty($attributes['reviews']) || !is_array($attributes['reviews'])) {
        return '';
    }

    $titleText = esc_html($attributes['titleText'] ?? '');

    ob_start();
    ?>
    <div class="shortcodesection">
        <div class="container">
            <?php if ($titleText): ?>
                <div class="headline sm_title shorttitle">
                    <span><?php echo $titleText; ?></span>
                </div>
            <?php endif; ?>

            <div class="custom-reviews-grid">
                <?php foreach ($attributes['reviews'] as $index => $review): 
                    $name    = esc_html($review['name'] ?? '');
                    $time    = esc_html($review['time'] ?? '');
                    $message = esc_html($review['message'] ?? '');
                    $stars   = intval($review['stars'] ?? 5);
                    $initial = strtoupper(mb_substr($name, 0, 1));
                    $color_class = 'avatar-color-' . (($index % 5) + 1); // عشوائي بالتكرار
                ?>
                    <div class="review-card">
                        <div class="review-header">
                            <div class="review-avatar <?php echo $color_class; ?>"><?php echo esc_html($initial); ?></div>
                            <div class="review-meta">
                                <div class="review-name"><?php echo $name; ?></div>
                                <div class="review-time"><?php echo $time; ?></div>
                            </div>
                        </div>
                        <div class="review-stars">
                            <?php for ($i = 0; $i < $stars; $i++): ?>
                                <span>⭐</span>
                            <?php endfor; ?>
                        </div>
                        <div class="review-message"><?php echo $message; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_action('init', function () {
    register_block_type('custom/review-block', [
        'render_callback' => 'render_review_block_callback',
        'attributes' => [
            'titleText' => [
                'type' => 'string',
                'default' => 'عنوان التقييمات'
            ],
            'reviews' => [
                'type' => 'array',
                'default' => []
            ]
        ]
    ]);
});
