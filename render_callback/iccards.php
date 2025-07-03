<?php


function render_units_grid_block($attributes) {
    // تأكد إن فيه بيانات


    ob_start();
    ?>
    <div class="shortcodesection">
        <div class="container">

            <?php if (!empty($attributes['sectionTitle'])): ?>
                <div class="headline sm_title shorttitle"><span><?php echo esc_html($attributes['sectionTitle']); ?></span></div>
            <?php endif; ?>

            <div class="property-grid">
                <?php foreach ($attributes['units'] as $unit): ?>
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
                                <p class="property-area msaha"><strong>المساحة : </strong> <?php echo esc_html($unit['area']); ?> م²</p>
                            <?php endif; ?>

                            <?php if (!empty($unit['price'])): ?>
                                <p class="property-price"><strong>السعر : </strong> <span class='pricee'><?php echo esc_html($unit['price']); ?></span></p>
                            <?php endif; ?>

                            <?php if (!empty($unit['down'])): ?>
                                <p class="property-down"><strong>المقدم : </strong> <?php echo esc_html($unit['down']); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="property-cta">احجز الان</div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
register_block_type('custom/units-grid', array(
    'render_callback' => 'render_units_grid_block',
    'attributes' => array(
        'units' => array(
            'type' => 'array',
            'default' => array()
        )
    )
));
