<?php
function render_accordion_with_units_block($attributes) {
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
                        $unitsTitle = esc_html($item['unitsTitle'] ?? 'الوحدات المتاحة');
                        $units = $item['units'] ?? [];
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
                                <?php if (!empty($content)): ?>
                                    <!-- المحتوى النصي -->
                                    <div class="accordion-text-section sncac">
                                        <?php echo $content; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($units)): ?>
                                    <!-- كروت الوحدات -->
                                    <div class="accordion-units-section">
                                        <?php if (!empty($unitsTitle)): ?>
                                            <div class="pjc-title"><?php echo $unitsTitle; ?></div>
                                        <?php endif; ?>
                                        
                                        <div class="property-grid">
                                            <?php foreach ($units as $unit): ?>
                                                <div class="property-card">
                                                    <?php if (!empty($unit['icon'])): ?>
                                                        <div class="property-icon">
                                                            <i class="fa fa-<?php echo esc_attr($unit['icon']); ?>"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (!empty($unit['title'])): ?>
                                                        <div class="property-title"><?php echo esc_html($unit['title']); ?></div>
                                                    <?php endif; ?>

                                                    <div class='propitems'>
                                                        <?php if (!empty($unit['area'])): ?>
                                                            <div class="property-area msaha">
                                                                <strong>المساحة : </strong> <?php echo esc_html($unit['area']); ?> م²
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if (!empty($unit['price'])): ?>
                                                            <div class="property-price">
                                                                <strong>السعر : </strong> 
                                                                <span class='pricee'><?php echo esc_html($unit['price']); ?></span>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if (!empty($unit['down'])): ?>
                                                            <div class="property-down">
                                                                <strong>المقدم : </strong> <?php echo esc_html($unit['down']); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    
                                                    <div class="property-cta">احجز الان</div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (empty($content) && empty($units)): ?>
                                    <!-- رسالة عند عدم وجود محتوى -->
                                    <div class="no-content-message">
                                        <p>لم يتم إضافة أي محتوى لهذا القسم بعد.</p>
                                    </div>
                                <?php endif; ?>
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

// تسجيل البلوك
register_block_type('custom/accordion-with-units', [
    'render_callback' => 'render_accordion_with_units_block',
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
?>