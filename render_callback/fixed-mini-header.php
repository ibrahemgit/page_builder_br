<?php

function render_contact_bar_block($attributes) {
    $bg = esc_attr($attributes['backgroundColor'] ?? '#222');
    $text = esc_attr($attributes['textColor'] ?? '#fff');

    ob_start();
    ?>
    <div class="custom-contact-bar inview" style="background-color: <?php echo $bg ?>; color: <?php echo $text ?>;">
        <div class='container'>
            <div class="contact-buttons">
                <a href="#" class="contact-btn"><i class="fa fa-whatsapp"></i> واتساب</a>
                <a href="#" class="contact-btn"><i class="fa fa-phone"></i> اتصل بنا</a>
                <a href="#" class="contact-btn"><i class="fa fa-calendar"></i> تواصل معنا</a>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_action('init', function () {
    register_block_type('custom/contact-bar', [
        'attributes' => [
            'backgroundColor' => ['type' => 'string', 'default' => '#222'],
            'textColor'       => ['type' => 'string', 'default' => '#fff'],
        ],
        'render_callback' => 'render_contact_bar_block'
    ]);
});
