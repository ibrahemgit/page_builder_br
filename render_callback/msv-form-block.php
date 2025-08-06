<?php

function advanced_form_block_render($attributes) {
    // محتوى الفورم
    $form_title = isset($attributes['formTitle']) ? esc_html($attributes['formTitle']) : 'عنوان بوكس الفورم';
    $form_subtitle = isset($attributes['formSubtitle']) ? esc_html($attributes['formSubtitle']) : 'صب تايتل للفورم';
    $submit_button_text = isset($attributes['submitButtonText']) ? esc_html($attributes['submitButtonText']) : 'سجل الان';

    // إعدادات العرض
    $show_name_field = isset($attributes['showNameField']) ? $attributes['showNameField'] : true;
    $show_phone_field = isset($attributes['showPhoneField']) ? $attributes['showPhoneField'] : true;
    $show_unit_type_field = isset($attributes['showUnitTypeField']) ? $attributes['showUnitTypeField'] : true;
    $show_price_field = isset($attributes['showPriceField']) ? $attributes['showPriceField'] : true;
    $show_time_field = isset($attributes['showTimeField']) ? $attributes['showTimeField'] : true;

    // حقول النص
    $name_label = isset($attributes['nameLabel']) ? esc_html($attributes['nameLabel']) : 'الاسم';
    $name_placeholder = isset($attributes['namePlaceholder']) ? esc_attr($attributes['namePlaceholder']) : 'الاسم بالكامل';
    $phone_label = isset($attributes['phoneLabel']) ? esc_html($attributes['phoneLabel']) : 'رقم الهاتف';
    $phone_placeholder = isset($attributes['phonePlaceholder']) ? esc_attr($attributes['phonePlaceholder']) : 'رقم الهاتف';
    $unit_type_label = isset($attributes['unitTypeLabel']) ? esc_html($attributes['unitTypeLabel']) : 'نوع الوحدة';
    $price_label = isset($attributes['priceLabel']) ? esc_html($attributes['priceLabel']) : 'السعر (EGP)';
    $price_placeholder = isset($attributes['pricePlaceholder']) ? esc_attr($attributes['pricePlaceholder']) : 'ادخل السعر (min. 10,000,000)';
    $price_min_text = isset($attributes['priceMinText']) ? esc_html($attributes['priceMinText']) : 'اقل سعر :  10,000,000 EGP';
    $time_label = isset($attributes['timeLabel']) ? esc_html($attributes['timeLabel']) : 'الوقت المفضل للتواصل';


    $show_area_field = isset($attributes['showAreaField']) ? $attributes['showAreaField'] : true;
$area_label = isset($attributes['areaLabel']) ? esc_html($attributes['areaLabel']) : 'المنطقة';
$area_options = isset($attributes['areaOptions']) ? $attributes['areaOptions'] : [];


    // خيارات السيليكت - بدون fallback تلقائي
    $unit_type_options = isset($attributes['unitTypeOptions']) ? $attributes['unitTypeOptions'] : [];
    $time_options = isset($attributes['timeOptions']) ? $attributes['timeOptions'] : [];

    // ألوان القسم
    $section_bg_color = isset($attributes['sectionBgColor']) ? esc_attr($attributes['sectionBgColor']) : '#000';
    $section_text_color = isset($attributes['sectionTextColor']) ? esc_attr($attributes['sectionTextColor']) : '#ffffff';

    // ألوان الفورم
    $form_bg_color = isset($attributes['formBgColor']) ? esc_attr($attributes['formBgColor']) : '#13171f';
    $form_border_color = isset($attributes['formBorderColor']) ? esc_attr($attributes['formBorderColor']) : '#4a5568';
    $form_text_color = isset($attributes['formTextColor']) ? esc_attr($attributes['formTextColor']) : '#ffffff';

    // ألوان الحقول
    $field_bg_color = isset($attributes['fieldBgColor']) ? esc_attr($attributes['fieldBgColor']) : '#000';
    $field_text_color = isset($attributes['fieldTextColor']) ? esc_attr($attributes['fieldTextColor']) : '#ffffff';
    $field_border_color = isset($attributes['fieldBorderColor']) ? esc_attr($attributes['fieldBorderColor']) : '#4a5568';

    // ألوان الزر
    $button_bg_color = isset($attributes['buttonBgColor']) ? esc_attr($attributes['buttonBgColor']) : '#007cba';
    $button_text_color = isset($attributes['buttonTextColor']) ? esc_attr($attributes['buttonTextColor']) : '#fff';

    // Generate unique ID for hover styles only
    $unique_id = 'advanced-form-' . uniqid();

    ob_start();
    ?>
    


    <div id="<?php echo $unique_id; ?>" class="advanced-form-wrapper" style="background-color: <?php echo $section_bg_color; ?>; color: <?php echo $section_text_color; ?>;">
        <div class="container" >
            <div class="form-wrapper" >
                <div class="form-card" style="background-color: <?php echo $form_bg_color; ?>; border-color: <?php echo $form_border_color; ?>;">
                    <div class="form-header" style="border-bottom-color: <?php echo $form_border_color; ?>;">
                        <h2 class="pjc-title" style="color: <?php echo $form_text_color; ?>;"><?php echo $form_title; ?></h2>
                        <?php if ($form_subtitle): ?>
                            <p class="pjc-subtitle" style="color: <?php echo $form_text_color; ?>;"><?php echo $form_subtitle; ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-content">
                        <form class="registration-form contact_us" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post">
                            
                            <?php if ($show_name_field || $show_phone_field): ?>
                                <div class="form-row">
                                    <?php if ($show_name_field): ?>
                                        <div class="form-field">
                                            <label class="field-label" style="color: <?php echo $form_text_color; ?>;"><?php echo $name_label; ?></label>
                                            <input 
                                                type="text" 
                                                name="name" 
                                                class="field-input"
                                                placeholder="<?php echo $name_placeholder; ?>"
                                                style="background-color: <?php echo $field_bg_color; ?>; border-color: <?php echo $field_border_color; ?>; color: <?php echo $field_text_color; ?>;"
                                                required
                                            />
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($show_phone_field): ?>
                                        <div class="form-field">
                                            <label class="field-label" style="color: <?php echo $form_text_color; ?>;"><?php echo $phone_label; ?></label>
                                            <input 
                                                type="tel" 
                                                name="phone" 
                                                class="field-input"
                                                placeholder="<?php echo $phone_placeholder; ?>"
                                                style="background-color: <?php echo $field_bg_color; ?>; border-color: <?php echo $field_border_color; ?>; color: <?php echo $field_text_color; ?>;"
                                                required
                                            />
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($show_unit_type_field || $show_price_field): ?>
                                <div class="form-row">
                                    <?php if ($show_unit_type_field): ?>
                                        <div class="form-field">
                                            <label class="field-label" style="color: <?php echo $form_text_color; ?>;"><?php echo $unit_type_label; ?></label>
                                            <?php if (!empty($unit_type_options)): ?>
                                                <select 
                                                    name="unit_type" 
                                                    class="field-select" 
                                                    style="background-color: <?php echo $field_bg_color; ?>; border-color: <?php echo $field_border_color; ?>; color: <?php echo $field_text_color; ?>;"
                                                    required
                                                >
                                                    <?php foreach ($unit_type_options as $index => $option): ?>
                                                        <?php 
                                                        // التأكد من وجود المفاتيح
                                                        $option_value = isset($option['value']) ? $option['value'] : '';
                                                        $option_label = isset($option['label']) ? $option['label'] : '';
                                                        ?>
                                                        <?php if ($index === 0 && empty($option_value)): ?>
                                                            <option value="<?php echo esc_attr($option_value); ?>" disabled selected hidden>
                                                                <?php echo esc_html($option_label); ?>
                                                            </option>
                                                        <?php else: ?>
                                                            <option value="<?php echo esc_attr($option_value); ?>">
                                                                <?php echo esc_html($option_label); ?>
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php else: ?>
                                                <div style="background-color: <?php echo $field_bg_color; ?>; border-color: <?php echo $field_border_color; ?>; color: <?php echo $field_text_color; ?>;" class="no-options-message">
                                                    لا توجد خيارات متاحة - أضف خيارات من الإعدادات
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($show_price_field): ?>
                                        <div class="form-field">
                                            <label class="field-label" style="color: <?php echo $form_text_color; ?>;"><?php echo $price_label; ?></label>
                                            <div class="price-field">
                                                <input 
                                                    type="text" 
                                                    name="price" 
                                                    class="field-input"
                                                    placeholder="<?php echo $price_placeholder; ?>"
                                                    style="background-color: <?php echo $field_bg_color; ?>; border-color: <?php echo $field_border_color; ?>; color: <?php echo $field_text_color; ?>;"
                                                />
                                                <?php if ($price_min_text): ?>
                                                    <small class="price-helper" style="color: <?php echo $form_text_color; ?>;"><?php echo $price_min_text; ?></small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>


                        <div class="form-row">

                            <?php if ($show_time_field): ?>
                                <div class="form-field full-width">
                                    <label class="field-label" style="color: <?php echo $form_text_color; ?>;"><?php echo $time_label; ?></label>

                                    <?php if (!empty($time_options)): ?>
                                        <select 
                                            name="preferred_time" 
                                            class="field-select"
                                            style="background-color: <?php echo $field_bg_color; ?>; border-color: <?php echo $field_border_color; ?>; color: <?php echo $field_text_color; ?>;"
                                        >
                                            <?php foreach ($time_options as $index => $option): ?>
                                                <?php 
                                                // التأكد من وجود المفاتيح
                                                $option_value = isset($option['value']) ? $option['value'] : '';
                                                $option_label = isset($option['label']) ? $option['label'] : '';
                                                ?>
                                                <?php if ($index === 0 && empty($option_value)): ?>
                                                    <option value="<?php echo esc_attr($option_value); ?>" disabled selected hidden>
                                                        <?php echo esc_html($option_label); ?>
                                                    </option>
                                                <?php else: ?>
                                                    <option value="<?php echo esc_attr($option_value); ?>">
                                                        <?php echo esc_html($option_label); ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php else: ?>
                                        <div style="background-color: <?php echo $field_bg_color; ?>; border-color: <?php echo $field_border_color; ?>; color: <?php echo $field_text_color; ?>;" class="no-options-message">
                                            لا توجد خيارات متاحة - أضف خيارات من الإعدادات
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>

                            <?php if ($show_area_field): ?>
                                <div class="form-field full-width">
                                    <label class="field-label" style="color: <?php echo $form_text_color; ?>;"><?php echo $area_label; ?></label>

                                    <?php if (!empty($area_options)): ?>
                                        <select 
                                            name="area" 
                                            class="field-select"
                                            style="background-color: <?php echo $field_bg_color; ?>; border-color: <?php echo $field_border_color; ?>; color: <?php echo $field_text_color; ?>;"
                                        >
                                            <?php foreach ($area_options as $index => $option): ?>
                                                <?php 
                                                $option_value = isset($option['value']) ? $option['value'] : '';
                                                $option_label = isset($option['label']) ? $option['label'] : '';
                                                ?>
                                                <?php if ($index === 0 && empty($option_value)): ?>
                                                    <option value="<?php echo esc_attr($option_value); ?>" disabled selected hidden>
                                                        <?php echo esc_html($option_label); ?>
                                                    </option>
                                                <?php else: ?>
                                                    <option value="<?php echo esc_attr($option_value); ?>">
                                                        <?php echo esc_html($option_label); ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php else: ?>
                                        <div style="background-color: <?php echo $field_bg_color; ?>; border-color: <?php echo $field_border_color; ?>; color: <?php echo $field_text_color; ?>;" class="no-options-message">
                                            لا توجد خيارات متاحة - أضف خيارات من الإعدادات
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                        </div>

                            <button 
                                type="submit" 
                                class="submit-button"
                                style="background-color: <?php echo $button_bg_color; ?>; color: <?php echo $button_text_color; ?>; border-color: <?php echo $button_bg_color; ?>;"
                            >
                                <?php echo $submit_button_text; ?>
                            </button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// تسجيل البلوك مع render_callback
register_block_type('custom/advanced-form-block', array(
    'render_callback' => 'advanced_form_block_render',
    'attributes' => array(
        // محتوى الفورم
        'formTitle' => array('type' => 'string', 'default' => 'عنوان بوكس الفورم'),
        'formSubtitle' => array('type' => 'string', 'default' => 'صب تايتل للفورم'),
        'submitButtonText' => array('type' => 'string', 'default' => 'سجل الان'),

        // إعدادات العرض
        'showNameField' => array('type' => 'boolean', 'default' => true),
        'showPhoneField' => array('type' => 'boolean', 'default' => true),
        'showUnitTypeField' => array('type' => 'boolean', 'default' => true),
        'showPriceField' => array('type' => 'boolean', 'default' => true),
        'showTimeField' => array('type' => 'boolean', 'default' => true),

        // حقول النص
        'nameLabel' => array('type' => 'string', 'default' => 'الاسم'),
        'namePlaceholder' => array('type' => 'string', 'default' => 'الاسم بالكامل'),
        'phoneLabel' => array('type' => 'string', 'default' => 'رقم الهاتف'),
        'phonePlaceholder' => array('type' => 'string', 'default' => 'رقم الهاتف'),
        'unitTypeLabel' => array('type' => 'string', 'default' => 'نوع الوحدة'),
        'priceLabel' => array('type' => 'string', 'default' => 'السعر (EGP)'),
        'pricePlaceholder' => array('type' => 'string', 'default' => 'ادخل السعر (min. 10,000,000)'),
        'priceMinText' => array('type' => 'string', 'default' => 'اقل سعر : 10,000,000 EGP'),
        'timeLabel' => array('type' => 'string', 'default' => 'الوقت المفضل للتواصل'),

        // خيارات السيليكت - مع values افتراضية صحيحة
        'unitTypeOptions' => array('type' => 'array', 'default' => array(
            array('label' => 'اختر نوع الوحدة', 'value' => ''),
            array('label' => 'ستديو', 'value' => 'studio'),
            array('label' => 'غرفه', 'value' => '1bedroom'),
            array('label' => 'غرفتين', 'value' => '2bedroom'),
            array('label' => 'ثلاث غرف', 'value' => '3bedroom'),
            array('label' => 'بنتهاوس', 'value' => 'penthouse')
        )),
        'timeOptions' => array('type' => 'array', 'default' => array(
            array('label' => 'اختر الوقت المفضل للتواصل', 'value' => ''),
            array('label' => 'في الصباح (9 AM - 12 PM)', 'value' => 'morning'),
            array('label' => 'بعد الظهر (12 PM - 6 PM)', 'value' => 'afternoon'),
            array('label' => 'في المساء (6 PM - 9 PM)', 'value' => 'evening'),
            array('label' => 'اي وقت', 'value' => 'anytime')
        )),


        // المنطقة
'showAreaField' => array('type' => 'boolean', 'default' => true),
'areaLabel' => array('type' => 'string', 'default' => 'المنطقة'),
'areaOptions' => array('type' => 'array', 'default' => array(
    array('label' => 'اختر المنطقة', 'value' => ''),
    array('label' => 'القاهرة الجديدة', 'value' => 'new-cairo'),
    array('label' => '6 أكتوبر', 'value' => '6october'),
    array('label' => 'الشيخ زايد', 'value' => 'sheikh-zayed'),
    array('label' => 'العين السخنة', 'value' => 'sokhna'),
    array('label' => 'العاصمة الإدارية', 'value' => 'new-capital'),
)),

        // ألوان القسم
        'sectionBgColor' => array('type' => 'string', 'default' => '#000'),
        'sectionTextColor' => array('type' => 'string', 'default' => '#ffffff'),

        // ألوان الفورم
        'formBgColor' => array('type' => 'string', 'default' => '#13171f'),
        'formBorderColor' => array('type' => 'string', 'default' => '#4a5568'),
        'formTextColor' => array('type' => 'string', 'default' => '#ffffff'),

        // ألوان الحقول
        'fieldBgColor' => array('type' => 'string', 'default' => '#000'),
        'fieldTextColor' => array('type' => 'string', 'default' => '#ffffff'),
        'fieldBorderColor' => array('type' => 'string', 'default' => '#4a5568'),

        // ألوان الزر
        'buttonBgColor' => array('type' => 'string', 'default' => '#007cba'),
        'buttonTextColor' => array('type' => 'string', 'default' => '#fff'),
    ),
));