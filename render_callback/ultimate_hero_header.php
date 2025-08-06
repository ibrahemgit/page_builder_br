<?php

function render_hero_header_block($attributes) {
    $backgroundType        = $attributes['backgroundType'] ?? 'image';
    $backgroundImage       = esc_url($attributes['backgroundImage'] ?? '');
    $backgroundVideo       = esc_url($attributes['backgroundVideo'] ?? '');
    $backgroundVideoUpload = esc_url($attributes['backgroundVideoUpload'] ?? '');
    $backgroundColor       = esc_attr($attributes['backgroundColor'] ?? '#1e1e1e'); // ✅ جديد

    $logoImage = esc_url($attributes['logoImage'] ?? '');
    $title = $attributes['title'];

    $subtitle = $attributes['subtitle']; // ✅ جديد

    $description = $attributes['description'];
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

    $hero_classes = 'msvh_hero-section';
    if (!empty($attributes['fullbort'])) {
        $hero_classes .= ' fullbort';
    }

    $form_class = 'form_header_msvh';
    if (!$enableFormStyle) {
        $form_class .= ' WitBg';
    }

    $post_id = get_the_ID();

    // Post meta
    $post_phone = get_post_meta($post_id, 'contact_phone', true);
    $post_whats = get_post_meta($post_id, 'contact_whatsapp', true);

    // Extra fallback numbers
    $extra_phones     = get_option('extra_phones', []);
    $extra_whatsapps  = get_option('extra_whatsapps', []);
    $random_extra_phone = !empty($extra_phones) ? $extra_phones[array_rand($extra_phones)] : null;
    $random_extra_whats = !empty($extra_whatsapps) ? $extra_whatsapps[array_rand($extra_whatsapps)] : null;

    // Global options
    $option_phone = get_option('custom_phone');
    $option_whats = get_option('custom_whatsapp');

    // Final phone/whatsapp
    $attr_phone = '';
    $attr_whats = '';

    $phoneNumber = $post_phone ?: ($random_extra_phone ?: ($option_phone ?: $attr_phone));
    $whatsNumber = $post_whats ?: ($random_extra_whats ?: ($option_whats ?: $attr_whats));

    ob_start();
    ?>

    <div class="<?php echo esc_attr($hero_classes); ?>">

        <?php if ($backgroundType === 'image' && $backgroundImage): ?>
            <div class="background-image" style="background-image: url('<?php echo esc_url($backgroundImage); ?>');"></div>
        <?php elseif ($backgroundType === 'upload' && !empty($attributes['backgroundVideoUpload'])): ?>
            <video class="background-video" autoplay muted loop playsinline>
                <source src="<?php echo esc_url($attributes['backgroundVideoUpload']); ?>" type="video/mp4">
            </video>
        <?php elseif ($backgroundType === 'youtube' && $backgroundVideo): ?>
            <div class="background-youtube">
                <iframe
                    src="https://www.youtube.com/embed/<?php echo esc_attr(get_youtube_id($backgroundVideo)); ?>?autoplay=1&mute=1&loop=1&playlist=<?php echo esc_attr(get_youtube_id($backgroundVideo)); ?>&controls=0&showinfo=0&modestbranding=1&rel=0&disablekb=1"
                    frameborder="0"
                    allow="autoplay; encrypted-media"
                    allowfullscreen
                ></iframe>
            </div>
        <?php elseif ($backgroundType === 'color' && $backgroundColor): ?>
            <!-- ✅ خيار اللون/الجراديانت الجديد -->
            <div class="background-color" style="background: <?php echo $backgroundColor; ?>;"></div>
        <?php endif; ?>

        <div class="msvh_overlay"></div>

        <div class="container msvh_content">

            <?php if ($logoImage): ?>
                <div class="msvh_logo <?php echo $logoAbsolute ? 'logo-absolute logo-align-' . esc_attr($logoAlign) : ''; ?>">
                    <img src="<?php echo $logoImage; ?>" alt="Logo" />
                </div>
            <?php endif; ?>

            <?php if ($title || $subtitle || $description): ?>
                <div class="msvh_content_sm">
                    <?php if ($title): ?>
                        <div class="msvh_headline">
                            <h1><?php echo $title; ?></h1>
                        </div>
                    <?php endif; ?>
                    <?php if ($description): ?>
                        <p class="msvh_description"><?php echo $description; ?></p>
                    <?php endif; ?>

                    <?php if ($subtitle): ?>
                        <!-- ✅ إضافة عرض الـ Subtitle -->
                        <span class="msvh_subtitle" style="
                            font-size: 1rem;
                            opacity: 0.9;
                            line-height: 1.5;
                        ">
                            <?php echo $subtitle; ?>
                        </span>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <?php if ($enableForm): ?>
                <div class="<?php echo esc_attr($form_class); ?>">
                    <?php if (!empty($formTitle)): ?>
                        <h3 class="msvh_form-title"><?php echo $formTitle; ?></h3>
                    <?php endif; ?>
                    <form class="msvh_form contact_us" method="post" action="#">
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

// Helper function to extract YouTube ID
function get_youtube_id($url) {
    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches)) {
        return $matches[1];
    }
    return '';
}

register_block_type('custom/hero-header', [
    'render_callback' => 'render_hero_header_block',
    'attributes' => [
        'backgroundType'        => ['type' => 'string', 'default' => 'image'],
        'backgroundImage'       => ['type' => 'string', 'default' => ''],
        'backgroundVideo'       => ['type' => 'string', 'default' => ''],
        'backgroundVideoUpload' => ['type' => 'string', 'default' => ''],
        'backgroundColor'       => ['type' => 'string', 'default' => '#1e1e1e'], // ✅ جديد
        'logoImage'             => ['type' => 'string', 'default' => ''],
        'title'                 => ['type' => 'string', 'default' => 'عنوان الهيدر'],
        'description'           => ['type' => 'string', 'default' => 'وصف الهيدر هنا'],
        'subtitle'              => ['type' => 'string', 'default' => ''], // ✅ جديد
        'enableForm'            => ['type' => 'boolean', 'default' => false],
        'logoAlign'             => ['type' => 'string', 'default' => 'center'],
        'logoAbsolute'          => ['type' => 'boolean', 'default' => false],
        'formTitle'             => ['type' => 'string', 'default' => 'تواصل معنا'],
        'enableFormStyle'       => ['type' => 'boolean', 'default' => true],
        'fullbort'              => ['type' => 'boolean', 'default' => false],
        'enableCTAWhatsapp'     => ['type' => 'boolean', 'default' => true],
        'enableCTACall'         => ['type' => 'boolean', 'default' => true],
        'enableCTAPopup'        => ['type' => 'boolean', 'default' => true],
        'ctaWhatsappText'       => ['type' => 'string', 'default' => 'واتساب'],
        'ctaCallText'           => ['type' => 'string', 'default' => 'اتصال'],
        'ctaPopupText'          => ['type' => 'string', 'default' => 'احجز وحدتك'],
        'cards'                 => ['type' => 'array', 'default' => []],
    ]
]);