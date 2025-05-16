<?php

function fixed_header_block_render($attributes) {
    $titleText = isset($attributes['titleText']) ? esc_html($attributes['titleText']) : 'معرض بولد روتس';
    $subtitleText = isset($attributes['subtitleText']) ? esc_html($attributes['subtitleText']) : 'اشترك في العضوية';
    $countdownTime = isset($attributes['countdownTime']) ? esc_html($attributes['countdownTime']) : '';
    $backgroundColor = isset($attributes['backgroundColor']) ? esc_html($attributes['backgroundColor']) : '#000';

    $post_id = get_the_ID();

    $post_phone  = get_post_meta($post_id, 'contact_phone', true);
    $post_whats  = get_post_meta($post_id, 'contact_whatsapp', true);

    $attr_phone = '01044009738';
    $attr_whats = '01044009738';

    $option_phone = get_option('custom_phone');
    $option_whats = get_option('custom_whatsapp');


    $phoneNumber  = !empty($post_phone) ? $post_phone : (!empty($option_phone) ? $option_phone : $attr_phone);
    $whatsNumber  = !empty($post_whats) ? $post_whats : (!empty($option_whats) ? $option_whats : $attr_whats);

    $post_title = $post_id ? get_the_title($post_id) : 'المعرض';

    ob_start();
    ?>
    <div class="sectionfixd" style="background-color: <?php echo $backgroundColor; ?>;">
        <div class="container">
            <div class="scfixdcontentflx">
                <div class="col-section colone">
                    <div class="scfixdtitle">
                        <h2 class="scfixdtitleh"><?php echo $titleText; ?></h2>
                        <span><?php echo $subtitleText; ?></span>
                    </div>
                </div>
                <div class="col-section coltow">
                    <div id="countdown" data-time="<?php echo $countdownTime; ?>">
                        
                    </div>
                </div>
                <div class="col-section coltree">
                    
                    <div class="towitem">
                        <a id="cta_whats" target="_blank" class="whatsapp" href="https://wa.me/<?php echo esc_attr($whatsNumber); ?>?text=أرغب في معرفة المزيد عن <?php echo esc_html($post_title); ?>">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i> واتساب
                        </a>
                        <span id="subform" class='subform'>
                            سجل بياناتك
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const countdownElement = document.getElementById('countdown');
            const countdownTime = countdownElement.getAttribute('data-time');

            if (countdownTime) {
                const targetDate = new Date(countdownTime);

                function updateCountdown() {
                    const now = new Date().getTime();
                    const distance = targetDate - now;

                    if (distance < 0) {
                        countdownElement.innerHTML = 'Time expired';
                        return;
                    }

                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

                    countdownElement.innerHTML = `<div><span>${days}</span><br>يوم</div>
                                                  <div><span>${hours}</span><br>ساعات</div>
                                                  <div><span>${minutes}</span><br>دقائق</div>`;
                }

                // أول مرة مباشرة
                updateCountdown();

                // تحديث كل 60 ثانية
                setInterval(updateCountdown, 60000);
            }
        });
    </script>

    <?php
    return ob_get_clean();
}

register_block_type('custom/fixed-header', array(
    'render_callback' => 'fixed_header_block_render',
    'attributes' => array(
        'titleText' => array('type' => 'string', 'default' => 'معرض بولد روتس'),
        'subtitleText' => array('type' => 'string', 'default' => 'اشترك في العضوية'),
        'countdownTime' => array('type' => 'string', 'default' => ''),
        'backgroundColor' => array('type' => 'string', 'default' => '#000'),
    ),
));
