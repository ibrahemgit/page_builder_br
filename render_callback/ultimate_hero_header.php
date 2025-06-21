<?php

function render_hero_header_block($attributes) {
    $backgroundImage = esc_url($attributes['backgroundImage'] ?? '');
    $logoImage = esc_url($attributes['logoImage'] ?? '');
    $title = esc_html($attributes['title'] ?? '');
    $description = esc_html($attributes['description'] ?? '');
    $enableForm = $attributes['enableForm'] ?? false;
    $logoAbsolute = $attributes['logoAbsolute'] ?? false;
    $logoAlign = $attributes['logoAlign'] ?? 'center';
    $formTitle = esc_html($attributes['formTitle'] ?? '');
    $enableFormStyle = $attributes['enableFormStyle'] ?? true;
    $cards = $attributes['cards'] ?? [];

    $enableCTAWhatsapp = $attributes['enableCTAWhatsapp'] ?? true;
    $enableCTACall = $attributes['enableCTACall'] ?? true;
    $enableCTAPopup = $attributes['enableCTAPopup'] ?? true;

    $ctaWhatsappText = esc_html($attributes['ctaWhatsappText'] ?? 'واتساب');
    $ctaCallText = esc_html($attributes['ctaCallText'] ?? 'اتصال');
    $ctaPopupText = esc_html($attributes['ctaPopupText'] ?? 'احجز وحدتك');

    $form_class = 'form_header_msvh';
    if (!$enableFormStyle) {
        $form_class .= ' WitBg';
    }


        $post_id = get_the_ID();

    // 1. ابدأ بالأرقام من post meta
    $post_phone  = get_post_meta($post_id, 'contact_phone', true);
    $post_whats  = get_post_meta($post_id, 'contact_whatsapp', true);

    // 2. fallback: من الإعدادات
    $option_phone = get_option('custom_phone');
    $option_whats = get_option('custom_whatsapp');

    // 3. fallback نهائي: من attributes
    $attr_phone = '';
    $attr_whats = '';

    // تحديد النهائي
    $phoneNumber  = !empty($post_phone) ? $post_phone : (!empty($option_phone) ? $option_phone : $attr_phone);
    $whatsNumber  = !empty($post_whats) ? $post_whats : (!empty($option_whats) ? $option_whats : $attr_whats);

    $post_title = $post_id ? get_the_title($post_id) : 'المعرض';


    ob_start();
    ?>
    <div class="msvh_hero-section" style="background-image: url('<?php echo $backgroundImage; ?>');">
        <div class="msvh_overlay"></div>

        <div class="container msvh_content">

            <?php if ($logoImage): ?>
                <div class="msvh_logo <?php echo $logoAbsolute ? 'logo-absolute logo-align-' . esc_attr($logoAlign) : ''; ?>">
                    <img src="<?php echo $logoImage; ?>" alt="Logo" />
                </div>
            <?php endif; ?>

            <?php if ($title || $description): ?>
                <div class='msvh_content_sm'>
                    <?php if ($title): ?>
                        <div class="msvh_headline">
                            <h1><?php echo $title; ?></h1>
                        </div>
                    <?php endif; ?>

                    <?php if ($description): ?>
                        <p class="msvh_description"><?php echo $description; ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($enableForm): ?>
                <div class="<?php echo esc_attr($form_class); ?>">
                    <?php if (!empty($formTitle)): ?>
                        <h3 class="msvh_form-title"><?php echo $formTitle; ?></h3>
                    <?php endif; ?>
                    <form class="msvh_form" method="post" action="#">
                        <input type="text" name="name" placeholder="الاسم بالكامل" required />
                        <input type="tel" name="phone" placeholder="رقم الهاتف" required />
                        <button type="submit" class="msvh_submit-btn">إرسال</button>
                    </form>
                </div>
            <?php endif; ?>

            <?php if ($enableCTAWhatsapp || $enableCTACall || $enableCTAPopup): ?>
                <div class="custom_cta_shortcode cta_block2 msvh_cta_buttons">
                    <div class="towitem">
                        <?php if ($enableCTAWhatsapp): ?>
                            <a id="cta_whats" href="https://wa.me/<?php echo esc_attr($whatsNumber); ?>" target="_blank" class="whatsapp">
                                <i class="fa fa-whatsapp" aria-hidden="true"></i> <?php echo $ctaWhatsappText; ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($enableCTACall): ?>
                            <a id="cta_call" href="tel:<?php echo esc_attr($phoneNumber); ?>" class="phone">
                                <i class="fa fa-phone" aria-hidden="true"></i> <?php echo $ctaCallText; ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($enableCTAPopup): ?>
                            <span id="cta_pop" class="formpopub openform">
                                <i class="fa fa-envelope-open-o" aria-hidden="true"></i> <?php echo $ctaPopupText; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($cards) && is_array($cards)): ?>
                <div class="msvh_cards-wrapper">
                    <?php foreach ($cards as $card): ?>
                        <?php
                            $card_title = esc_html($card['title'] ?? '');
                            $card_desc = esc_html($card['description'] ?? '');
                            if (empty($card_title) && empty($card_desc)) continue;
                        ?>
                        <div class="msvh_card">
                            <?php if ($card_title): ?>
                                <h3 class="msvh_card-title"><?php echo $card_title; ?></h3>
                            <?php endif; ?>
                            <?php if ($card_desc): ?>
                                <p class="msvh_card-desc"><?php echo $card_desc; ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

register_block_type('custom/hero-header', [
    'render_callback' => 'render_hero_header_block',
    'attributes' => [
        'backgroundImage' => ['type' => 'string', 'default' => ''],
        'logoImage' => ['type' => 'string', 'default' => ''],
        'title' => ['type' => 'string', 'default' => 'عنوان الهيدر'],
        'description' => ['type' => 'string', 'default' => 'وصف الهيدر هنا'],
        'enableForm' => ['type' => 'boolean', 'default' => false],
        'logoAlign' => ['type' => 'string', 'default' => 'center'],
        'logoAbsolute' => ['type' => 'boolean', 'default' => false],
        'formTitle' => ['type' => 'string', 'default' => 'تواصل معنا'],
        'enableFormStyle' => ['type' => 'boolean', 'default' => true],

        // أزرار CTA الجديدة
        'enableCTAWhatsapp' => ['type' => 'boolean', 'default' => true],
        'enableCTACall' => ['type' => 'boolean', 'default' => true],
        'enableCTAPopup' => ['type' => 'boolean', 'default' => true],
        'ctaWhatsappText' => ['type' => 'string', 'default' => 'واتساب'],
        'ctaCallText' => ['type' => 'string', 'default' => 'اتصال'],
        'ctaPopupText' => ['type' => 'string', 'default' => 'احجز وحدتك'],

        'cards' => ['type' => 'array', 'default' => []]
    ]
]);
