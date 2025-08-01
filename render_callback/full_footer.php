<?php
function footer_block_render($attributes) {
    // استخراج القيم مع القيم الافتراضية
    $show_main_section = isset($attributes['showMainSection']) ? $attributes['showMainSection'] : true;
    $show_company_column = isset($attributes['showCompanyColumn']) ? $attributes['showCompanyColumn'] : true;
    $show_contact_column = isset($attributes['showContactColumn']) ? $attributes['showContactColumn'] : true;
    $show_social_column = isset($attributes['showSocialColumn']) ? $attributes['showSocialColumn'] : true;
    $show_copyright = isset($attributes['showCopyright']) ? $attributes['showCopyright'] : true;

    // الألوان
    $background_color = isset($attributes['backgroundColor']) ? esc_attr($attributes['backgroundColor']) : '#111827';
    $border_color = isset($attributes['borderColor']) ? esc_attr($attributes['borderColor']) : 'rgb(156 163 175 / 1)';
    $text_color = isset($attributes['textColor']) ? esc_attr($attributes['textColor']) : '#ffffff';
    $secondary_text_color = isset($attributes['secondaryTextColor']) ? esc_attr($attributes['secondaryTextColor']) : '#d1d5db';
    $copyright_text_color = isset($attributes['copyrightTextColor']) ? esc_attr($attributes['copyrightTextColor']) : '#9ca3af';

    // أزرار السوشيال ميديا
    $social_button_bg = isset($attributes['socialButtonBg']) ? esc_attr($attributes['socialButtonBg']) : '#000000';
    $social_button_text = isset($attributes['socialButtonText']) ? esc_attr($attributes['socialButtonText']) : '#ffffff';
    $social_button_hover_bg = isset($attributes['socialButtonHoverBg']) ? esc_attr($attributes['socialButtonHoverBg']) : '#ffffff';
    $social_button_hover_text = isset($attributes['socialButtonHoverText']) ? esc_attr($attributes['socialButtonHoverText']) : '#000000';

    // محتوى عمود الشركة
    $company_logo = isset($attributes['companyLogo']) ? esc_url($attributes['companyLogo']) : '';
    $company_title = isset($attributes['companyTitle']) ? esc_html($attributes['companyTitle']) : 'Bold Routes';
    $company_description = isset($attributes['companyDescription']) ? esc_html($attributes['companyDescription']) : 'نحن شركة متخصصة في تقديم أفضل الحلول والخدمات المبتكرة';

    // محتوى عمود الاتصال
    $contact_title = isset($attributes['contactTitle']) ? esc_html($attributes['contactTitle']) : 'معلومات الاتصال';
    $contact_address = isset($attributes['contactAddress']) ? esc_html($attributes['contactAddress']) : 'القاهرة، مصر';
    $contact_phone = isset($attributes['contactPhone']) ? esc_html($attributes['contactPhone']) : '+20 123 456 789';
    $contact_email = isset($attributes['contactEmail']) ? esc_html($attributes['contactEmail']) : 'info@boldroutes.com';

    // محتوى عمود السوشيال ميديا
    $social_title = isset($attributes['socialTitle']) ? esc_html($attributes['socialTitle']) : 'تابعنا';
    $facebook_url = isset($attributes['facebookUrl']) ? esc_url($attributes['facebookUrl']) : '#';
    $twitter_url = isset($attributes['twitterUrl']) ? esc_url($attributes['twitterUrl']) : '#';
    $instagram_url = isset($attributes['instagramUrl']) ? esc_url($attributes['instagramUrl']) : '#';
    $linkedin_url = isset($attributes['linkedinUrl']) ? esc_url($attributes['linkedinUrl']) : '#';

    // حقوق النشر
    $copyright_text = isset($attributes['copyrightText']) ? esc_html($attributes['copyrightText']) : '© 2024 Bold Routes. جميع الحقوق محفوظة.';

    // حساب عدد الأعمدة المرئية
    $visible_columns = 0;
    if ($show_company_column) $visible_columns++;
    if ($show_contact_column) $visible_columns++;
    if ($show_social_column) $visible_columns++;

    // تحديد grid classes حسب عدد الأعمدة
    $grid_class = 'footer-grid';
    if ($visible_columns == 1) $grid_class .= ' single-column';
    elseif ($visible_columns == 2) $grid_class .= ' two-columns';

    // Generate unique ID for hover effects
    $unique_id = 'footer-' . uniqid();

    ob_start();
    ?>
    <style>
        #<?php echo $unique_id; ?> .social-btn:hover {
            background-color: <?php echo $social_button_hover_bg; ?> !important;
            color: <?php echo $social_button_hover_text; ?> !important;
            border-color: <?php echo $social_button_hover_bg; ?> !important;
        }
    </style>
    
    <footer id="<?php echo $unique_id; ?>" class="footer-block" style="
        background-color: <?php echo $background_color; ?>;
        border-top: 1px solid <?php echo $border_color; ?>;
        color: <?php echo $text_color; ?>;
    ">
        <div class="footer-container">
            <?php if ($show_main_section && $visible_columns > 0): ?>
                <div class="<?php echo esc_attr($grid_class); ?>">
                    
                    <?php if ($show_company_column): ?>
                        <!-- عمود الشركة -->
                        <div class="footer-column">
                            <?php if ($company_logo): ?>
                                <img src="<?php echo $company_logo; ?>" alt="Company Logo" class="footer-logo" />
                            <?php endif; ?>
                            
                            <?php if ($company_title): ?>
                                <h3 style="color: <?php echo $text_color; ?>;"><?php echo $company_title; ?></h3>
                            <?php endif; ?>
                            
                            <?php if ($company_description): ?>
                                <p style="color: <?php echo $secondary_text_color; ?>;"><?php echo $company_description; ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($show_contact_column): ?>
                        <!-- عمود الاتصال -->
                        <div class="footer-column">
                            <?php if ($contact_title): ?>
                                <h4 style="color: <?php echo $text_color; ?>;"><?php echo $contact_title; ?></h4>
                            <?php endif; ?>
                            
                            <div class="contact-info" style="color: <?php echo $secondary_text_color; ?>;">
                                <?php if ($contact_address): ?>
                                    <div class="contact-item">
                                        <i class="fa fa-map-marker-alt icon" style="color: <?php echo $text_color; ?>;"></i>
                                        <span><?php echo $contact_address; ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($contact_phone): ?>
                                    <div class="contact-item">
                                        <i class="fa fa-phone icon" style="color: <?php echo $text_color; ?>;"></i>
                                        <span><?php echo $contact_phone; ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($contact_email): ?>
                                    <div class="contact-item">
                                        <i class="fa fa-envelope icon" style="color: <?php echo $text_color; ?>;"></i>
                                        <span><?php echo $contact_email; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($show_social_column): ?>
                        <!-- عمود السوشيال ميديا -->
                        <div class="footer-column">
                            <?php if ($social_title): ?>
                                <h4 style="color: <?php echo $text_color; ?>;"><?php echo $social_title; ?></h4>
                            <?php endif; ?>
                            
                            <div class="social-buttons">
                                <?php if ($facebook_url && $facebook_url !== '#'): ?>
                                    <a href="<?php echo $facebook_url; ?>" target="_blank" class="social-btn" style="
                                        background-color: <?php echo $social_button_bg; ?>;
                                        color: <?php echo $social_button_text; ?>;
                                        border: 1px solid #4b5563;
                                    ">
                                        <i class="fa fa-facebook-f"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ($twitter_url && $twitter_url !== '#'): ?>
                                    <a href="<?php echo $twitter_url; ?>" target="_blank" class="social-btn" style="
                                        background-color: <?php echo $social_button_bg; ?>;
                                        color: <?php echo $social_button_text; ?>;
                                        border: 1px solid #4b5563;
                                    ">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ($instagram_url && $instagram_url !== '#'): ?>
                                    <a href="<?php echo $instagram_url; ?>" target="_blank" class="social-btn" style="
                                        background-color: <?php echo $social_button_bg; ?>;
                                        color: <?php echo $social_button_text; ?>;
                                        border: 1px solid #4b5563;
                                    ">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ($linkedin_url && $linkedin_url !== '#'): ?>
                                    <a href="<?php echo $linkedin_url; ?>" target="_blank" class="social-btn" style="
                                        background-color: <?php echo $social_button_bg; ?>;
                                        color: <?php echo $social_button_text; ?>;
                                        border: 1px solid #4b5563;
                                    ">
                                        <i class="fa fa-linkedin-in"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </div>
            <?php endif; ?>

            <?php if ($show_copyright): ?>
                <div class="footer-copyright" style="
                    border-top: 1px solid <?php echo $border_color; ?>;
                    color: <?php echo $copyright_text_color; ?>;
                ">
                    <p><?php echo $copyright_text; ?></p>
                </div>
            <?php endif; ?>
        </div>
    </footer>
    <?php
    return ob_get_clean();
}

// تسجيل البلوك مع render_callback
register_block_type('custom/full-footer-block', array(
    'render_callback' => 'footer_block_render',
    'attributes' => array(
        // عرض الأقسام
        'showMainSection' => array('type' => 'boolean', 'default' => true),
        'showCompanyColumn' => array('type' => 'boolean', 'default' => true),
        'showContactColumn' => array('type' => 'boolean', 'default' => true),
        'showSocialColumn' => array('type' => 'boolean', 'default' => true),
        'showCopyright' => array('type' => 'boolean', 'default' => true),

        // ألوان
        'backgroundColor' => array('type' => 'string', 'default' => '#111827'),
        'borderColor' => array('type' => 'string', 'default' => 'rgb(156 163 175 / 1)'),
        'textColor' => array('type' => 'string', 'default' => '#ffffff'),
        'secondaryTextColor' => array('type' => 'string', 'default' => '#d1d5db'),
        'copyrightTextColor' => array('type' => 'string', 'default' => '#9ca3af'),

        // أزرار السوشيال ميديا
        'socialButtonBg' => array('type' => 'string', 'default' => '#000000'),
        'socialButtonText' => array('type' => 'string', 'default' => '#ffffff'),
        'socialButtonHoverBg' => array('type' => 'string', 'default' => '#ffffff'),
        'socialButtonHoverText' => array('type' => 'string', 'default' => '#000000'),

        // محتوى عمود الشركة
        'companyLogo' => array('type' => 'string', 'default' => ''),
        'companyTitle' => array('type' => 'string', 'default' => 'Bold Routes'),
        'companyDescription' => array('type' => 'string', 'default' => 'نحن شركة متخصصة في تقديم أفضل الحلول والخدمات المبتكرة'),

        // محتوى عمود الاتصال
        'contactTitle' => array('type' => 'string', 'default' => 'معلومات الاتصال'),
        'contactAddress' => array('type' => 'string', 'default' => 'القاهرة، مصر'),
        'contactPhone' => array('type' => 'string', 'default' => '+20 123 456 789'),
        'contactEmail' => array('type' => 'string', 'default' => 'info@boldroutes.com'),

        // محتوى عمود السوشيال ميديا
        'socialTitle' => array('type' => 'string', 'default' => 'تابعنا'),
        'facebookUrl' => array('type' => 'string', 'default' => '#'),
        'twitterUrl' => array('type' => 'string', 'default' => '#'),
        'instagramUrl' => array('type' => 'string', 'default' => '#'),
        'linkedinUrl' => array('type' => 'string', 'default' => '#'),

        // حقوق النشر
        'copyrightText' => array('type' => 'string', 'default' => '© 2024 Bold Routes. جميع الحقوق محفوظة.'),
    ),
));