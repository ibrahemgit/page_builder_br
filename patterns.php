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

<!-- wp:custom/hero-header {"backgroundImage":"https://mountainview.boldroutes.com/wp-content/uploads/2025/07/seazen-5.webp","title":"ماونتن فيو كريستا الساحل الشمالي","description":"شاليهات وفيلات مباشرةً علي البحر احجز وحدتك الان اونلاين مع ماونتن فيو احصل على خصم على الكاش يصل إلى 20% وتقسيط يصل حتى 12 سنة","enableForm":true,"formTitle":"لمعرفة تفاصيل اكتر عن الأسعار والمساحات وأنظمة السداد والعروض تواصل معنا","enableFormStyle":false,"fullbort":true} /-->

<!-- wp:custom/project-content-block {"sectionTitle":"استفيد بسعر الطرح الاول في ماونتن فيو كريستا" /-->

<!-- wp:custom/cta-block2 {"enableCTAPopup":true,"ctaPopupText":"استفيد بخصم خاص"} /-->

<!-- wp:custom/units-grid {"sectionTitle":"ليه تسكن في شاليه لما ممكن تسكن في جزيرة علي البحر في ماونتن فيو كريستا الساحل الشمالي","units":[{"title":"Beach Cabin","icon":"umbrella","area":"45","price":"14,000,000 ج.م","down":"5%"},{"title":"Beach House with Roof","icon":"home","area":"145","price":"14,600,000 ج.م","down":"5%"},{"title":"Beach House with Garden","icon":"tree","area":"150","price":"15,800,000 ج.م","down":"5%"}]} /-->

<!-- wp:custom/accordion-section {"sectionTitle":"اهم الاسئلة الشائعه من عملائنا","accordions":[{"id":1752535702755,"title":"سؤال 1","content":""},{"id":1752535707786,"title":"سؤال 2","content":""}]} /-->

<!-- wp:custom/form-block {"formTitle":"لمعرفة تفاصيل اكتر عن الأسعار والمساحات وأنظمة السداد والعروض تواصل معنا","submitButtonText":"احجز الان"} /-->

<!-- wp:custom/gallery-images  /-->

<!-- wp:custom/cta-block2 {"enableCTAPopup":true,"ctaPopupText":"استفيد بخصم خاص"} /-->

<!-- wp:custom/review-block {"titleText":"تقييمات عملائنا","reviews":[{"name":"محمد عبد الحليم","time":"منذ ساعة","message":"شكرا لتيم السيلز لاحترام الوعد وصبرهم عليا في طلباتي واسئلتي الكتير وانهم متخنقوش مني لغاية ما اختارنا الحاجة الي انا محتاجها بالظبط","stars":"5"},{"name":"mahmoud abo zed","time":"منذ يومين","message":"حصل معايا مشكلة ومكنتش لاقي ردود سريعة علي الي انا محتاجه بس بعد ما المشكله اتصعدت للمسؤل تم حل المشكلة في اسرع وقت ","stars":"5"},{"name":"Cristina idrees","time":"منذ خمسة ايام","message":"كنت اشتريت معاهم قبل كده في مشروع التجمع وكنت مبسوطة جدا وكان نفسي اشتري معاهم في اول مشروع في الساحل بس لما جيت اشتري اليونت كانت خلاص اتباعت الي كنت محتاجاها علشان كنت محتاجه يونت عالبحر مباشرتا واول منزل المشروع الجديد كنت خلاص لازم اخد الخطوه بسرعه قبل ما تتباع وقبل ما سعرها يزيد علشان عارفه ان اسعار الوحدات عندهم بتزيد بسرعه بعد اللونش ","stars":"5"}]} /-->

<!-- wp:custom/cta-block2 {"titleText":"إرسل تقييمك علي","enableCTAPopup":true,"ctaPopupText":"كتابة التقييم"} /-->

<!-- wp:custom/arabic-steps {"widgetTitle":"لو عايز تاخد خصم زيادة اتبع الخطوات التالية","ctaText":"اتعرف علي خصمك الان","steps":[{"title":"سجل بياناتك","desc":"املأ النموذج وسيقوم فريقنا بالتواصل معك."},{"title":"انتظر مكالمة القسم المختص","desc":"سيتم التواصل معك من خلال فريقنا خلال يومين"},{"title":"حدد احتياجك","desc":"هنساعدك تختار اليونت المناسبه ليك بافضل خطة سداد"},{"title":"احصل علي خصمك الان","desc":"سيتم ابلاغك بالخصم المخصص لك"}]} /-->

<!-- wp:custom/form-block /-->

<!-- wp:custom/footer-cta-block /-->
',
        )
    );
}

add_action('init', 'register_custom_patterns');
?>
