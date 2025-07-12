<?php
function register_custom_patterns() {
    register_block_pattern(
        'custom/homepage-k1',
        array(
            'title'       => __( ' K1 ', 'text-domain' ),
            'description' => __( ' K1 ', 'text-domain' ),
            'categories'  => array( 'kt-patterns' ),
            'content'     => '
                <!-- wp:custom/contact-bar /-->
                <!-- wp:custom/hero-header /-->
                <!-- wp:custom/cta-block2 /-->
                <!-- wp:custom/project-content-block /-->
                <!-- wp:custom/cta-block2 /-->
                <!-- wp:custom/project-content-block /-->
                <!-- wp:custom/cta-block2 /-->
                <!-- wp:custom/form-block /-->
                <!-- wp:custom/cta-block2 /-->
                <!-- wp:custom/card-section {"cards":[{"title":"عنوان جديد","content":"وصف البطاقة","backgroundColor":"#1E2D2F","textColor":"#ffffff"},{"title":"عنوان جديد","content":"وصف البطاقة","backgroundColor":"#1E2D2F","textColor":"#ffffff"},{"title":"عنوان جديد","content":"وصف البطاقة","backgroundColor":"#1E2D2F","textColor":"#ffffff"}]} /-->
                <!-- wp:custom/cta-block2 /-->
                <!-- wp:custom/gallery-images /-->
                <!-- wp:custom/cta-block /-->
                <!-- wp:custom/arabic-steps /-->
                <!-- wp:custom/form-block /-->
                <!-- wp:custom/footer-cta-block /-->
            ',
        )
    );


register_block_pattern(
        'custom/homepage-ma3rd',
        array(
            'title'       => __( 'A1', 'text-domain' ),
            'description' => __( 'A1', 'text-domain' ),
            'categories'  => array( 'ma3rd-patterns' ),
            'content'     => '
<!-- wp:custom/contact-bar /-->

<!-- wp:custom/hero-header {"enableForm":true,"logoAlign":"left","logoAbsolute":true,"enableFormStyle":false,"fullbort":true,"enableCTAPopup":false} /-->

<!-- wp:custom/cta-block2 /-->

<!-- wp:custom/units-grid {"sectionTitle":"تواصل معنا واحصل على كل المعلومات عن مشروع crysta","units":[{"title":"Beach Cabin","icon":"umbrella","area":"45","price":"14,000,000 ج.م","down":"5%"},{"title":"Beach House with Roof","icon":"home","area":"145","price":"14,600,000 ج.م","down":"5%"},{"title":"Beach House with Garden","icon":"tree","area":"150","price":"15,800,000 ج.م","down":"5%"},{"title":"Townhouse Middle","icon":"building","area":"175","price":"19,100,000 ج.م","down":"5%"},{"title":"Townhouse Corner","icon":"map-marker","area":"185","price":"21,100,000 ج.م","down":"5%"},{"title":"Standalone Villa","icon":"university","area":"210","price":"37,600,000 ج.م","down":"5%"},{"title":"Crysta Villa","icon":"diamond","area":"255","price":"29,900,000 ج.م","down":"5%"},{"title":"One-Story Villa","icon":"minus-square","area":"285","price":"90,000,000 ج.م","down":"5%"},{"title":"Crysta Grand Villa","icon":"star","area":"365","price":"66,600,000 ج.م","down":"5%"}]} /-->

<!-- wp:custom/project-content-block {"sectionTitle":"رفاهية ساحلية بمعنى جديد... الآن بين يديك","content":"\u003cp\u003eعرض حصري جداً إذا حجزت وحدتك الأن أحصل على خصم على الكاش يصل حتى 20% من سعر الوحدة التي ترغب في حجزها أو انظمة سداد حصرية جداً بمقدم 5% وتقسيط يصل حتى 12 سنة فقط سجل معنا واحجز وحدتك في مشروع كريستا الأن.\u003c/p\u003e\n\u003cp\u003eيمتد المشروع على مساحة 470 فدان، ويحتل 85% منها للمساحات الخضراء والLagoon الطبيعية لضمان بيئة هادئة وصحية واجهات مائية داخلية بطول 15 كم، وشاطئ رملي بطول 1 كم، يضمن لـ 90% من الوحدات إطلالة بحرية أو Lagoon مباشرة 35 فدان من Crystal Lagoons وبحيرات صناعية، 3 فنادق بوتيك ضمن المشروعات تُقدم خدمات فندقية فاخرة Club houses، مطاعم وكافيهات عالمية، منطقة تجارية متكاملة (Crysta Town) ، ممشى ساحلي (Crysta Walk) بطول نحو 85 فدان\u003c/p\u003e","reverseImage":true} /-->

<!-- wp:custom/cta-block2 /-->

<!-- wp:custom/project-content-block {"sectionTitle":"","pricetbda":"14 مليون جنيه","mkadmybda":"5%","tkseetybda":"12 سنة"} /-->

<!-- wp:custom/cta-block /-->

<!-- wp:custom/form-block /-->

<!-- wp:custom/cta-block2 /-->

<!-- wp:custom/card-section /-->

<!-- wp:custom/cta-block2 /-->

<!-- wp:custom/gallery-images /-->

<!-- wp:custom/project-content-block {"sectionTitle":"احجز الأن في أي مشروع من مشروعات ماونتن فيو","content":"\u003cp style=\u0022text-align: center;\u0022\u003e\u003cstrong\u003eماونتن فيو رأس الحكمة \u0026ndash; ماونتن فيو plage \u0026ndash; ماونتن فيو lvls\u003c/strong\u003e\u003c/p\u003e"} /-->

<!-- wp:custom/cta-block2 /-->

<!-- wp:custom/arabic-steps /-->

<!-- wp:custom/form-block /-->

<!-- wp:custom/footer-cta-block /-->
',
        )
    );
}

add_action('init', 'register_custom_patterns');
?>
