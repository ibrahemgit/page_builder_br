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

<!-- wp:custom/hero-header {"backgroundImage":"https://mountainview.boldroutes.com/wp-content/uploads/2025/06/الساحل-الشمالى.jpg","title":"ماونتن فيو Plage ..  امتلك وحدتك في قلب الساحل الشمالي","description":"خصم خاص لمده يومين شاليهات وفيلات فيو مباشره علي البحر فقط بمقدم 5% واقساط علي 12 سنه بدلا من 10 سنين","enableForm":true,"logoAlign":"left","logoAbsolute":true,"enableFormStyle":false,"fullbort":true,"enableCTAPopup":false} /-->

<!-- wp:custom/project-content-block {"sectionTitle":"رفاهية ساحلية بمعنى جديد... الآن بين يديك","content":"\u003cp class=\u0022MsoNormal\u0022 style=\u0022line-height: normal; direction: ltr; unicode-bidi: embed; text-align: center;\u0022\u003e\u003cstrong\u003e\u003cspan dir=\u0022RTL\u0022 lang=\u0022AR-SA\u0022 style=\u0022font-size: 12.0pt; font-family: 'Times New Roman',serif; mso-fareast-font-family: 'Times New Roman';\u0022\u003eاستمتع بالحياة على البحر مباشرةً في ماونتن فيو بلاج\u0026nbsp; \u0026nbsp;\u003c/span\u003e\u003c/strong\u003e\u003c/p\u003e\n\u003cp class=\u0022MsoNormal\u0022 style=\u0022line-height: normal; direction: ltr; unicode-bidi: embed; text-align: center;\u0022\u003e\u003cspan dir=\u0022RTL\u0022 lang=\u0022AR-SA\u0022 style=\u0022font-size: 12.0pt; font-family: 'Times New Roman',serif; mso-fareast-font-family: 'Times New Roman';\u0022\u003e، حيث الفخامة تلتقي بالاسترخاء. يقع المشروع في موقع استراتيجي في الساحل الشمالي، ليمنحك تجربة صيفية استثنائية مع شواطئ نقية، بحيرات كريستالية، ومساحات خضراء شاسعة\u003c/span\u003e\u003c/p\u003e","reverseImage":true} /-->

<!-- wp:custom/cta-block2 /-->

<!-- wp:custom/units-grid {"sectionTitle":"تواصل معنا واحصل على كل المعلومات عن مشروع Plage","units":[{"title":"Beach House with Roof","icon":"home","area":"145","price":"14,600,000 ج.م","down":"5%"},{"title":"Beach House with Garden","icon":"tree","area":"150","price":"15,800,000 ج.م","down":"5%"},{"title":"Townhouse Middle","icon":"building","area":"175","price":"19,100,000 ج.م","down":"5%"}]} /-->

<!-- wp:custom/project-content-block {"sectionTitle":"ماونتن فيو رأس الحكمة","content":"\u003cp dir=\u0022RTL\u0022 style=\u0022direction: rtl; unicode-bidi: embed; text-align: center;\u0022\u003e\u003cstrong\u003e\u003cspan lang=\u0022AR-SA\u0022\u003eوجهتك المثالية في الساحل الشمالي\u003c/span\u003e\u003c/strong\u003e\u003cstrong\u003e\u003cspan dir=\u0022LTR\u0022\u003e!\u003c/span\u003e\u003c/strong\u003e\u003c/p\u003e\n\u003cp dir=\u0022RTL\u0022 style=\u0022direction: rtl; unicode-bidi: embed; text-align: center;\u0022\u003e\u003cspan lang=\u0022AR-SA\u0022\u003eاستمتع بأجواء البحر المتوسط الساحرة مع\u0026nbsp;\u003c/span\u003e\u003cstrong\u003e\u003cspan dir=\u0022LTR\u0022\u003eMountain View Ras El Hekma\u003c/span\u003e\u003c/strong\u003e\u003cspan lang=\u0022AR-SA\u0022\u003e، حيث تجد الفخامة والاسترخاء في أرقى مجتمعات الساحل الشمالي. بموقعه المميز في رأس الحكمة، يقدم لك المشروع شواطئ نقية، مياه فيروزية، وتصميمات مستوحاة من الطراز اليوناني الفريد\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022\u003e.\u003c/span\u003e\u003c/p\u003e"} /-->

<!-- wp:custom/project-content-block {"sectionTitle":"مميزات ماونتن فيو رأس الحكمة:","content":"\u003cp dir=\u0022RTL\u0022 style=\u0022direction: rtl; unicode-bidi: embed; text-align: center;\u0022\u003e\u003cspan dir=\u0022LTR\u0022 style=\u0022font-family: 'Segoe UI Symbol',sans-serif; mso-bidi-font-family: 'Segoe UI Symbol';\u0022\u003e✅\u003c/span\u003e\u0026nbsp;\u003cspan lang=\u0022AR-SA\u0022\u003eشاليهات وفيلات بإطلالات مباشرة على البحر\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022\u003e.\u003cbr /\u003e\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022 style=\u0022font-family: 'Segoe UI Symbol',sans-serif; mso-bidi-font-family: 'Segoe UI Symbol';\u0022\u003e✅\u003c/span\u003e\u0026nbsp;\u003cspan lang=\u0022AR-SA\u0022\u003eمساحات متنوعة تناسب جميع الاحتياجات\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022\u003e.\u003cbr /\u003e\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022 style=\u0022font-family: 'Segoe UI Symbol',sans-serif; mso-bidi-font-family: 'Segoe UI Symbol';\u0022\u003e✅\u003c/span\u003e\u0026nbsp;\u003cspan lang=\u0022AR-SA\u0022\u003eشواطئ خاصة وبحيرات كريستالية تمنحك أجواء استثنائية\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022\u003e.\u003cbr /\u003e\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022 style=\u0022font-family: 'Segoe UI Symbol',sans-serif; mso-bidi-font-family: 'Segoe UI Symbol';\u0022\u003e✅\u003c/span\u003e\u0026nbsp;\u003cspan lang=\u0022AR-SA\u0022\u003eخدمات متكاملة: نوادٍ رياضية، مطاعم، كافيهات، ومناطق ترفيهية\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022\u003e.\u003cbr /\u003e\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022 style=\u0022font-family: 'Segoe UI Symbol',sans-serif; mso-bidi-font-family: 'Segoe UI Symbol';\u0022\u003e✅\u003c/span\u003e\u0026nbsp;\u003cspan lang=\u0022AR-SA\u0022\u003eأنظمة سداد مرنة تصل إلى 8 سنة\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022\u003e.\u003c/span\u003e\u003c/p\u003e\n\u003cp style=\u0022text-align: center;\u0022\u003e\u0026nbsp;\u003c/p\u003e\n\u003cp dir=\u0022RTL\u0022 style=\u0022direction: rtl; unicode-bidi: embed; text-align: center;\u0022\u003e\u003cspan lang=\u0022AR-SA\u0022\u003eاستمتع بتجربة فريدة من الفخامة والاسترخاء في\u0026nbsp;\u003cstrong\u003eماونتن فيو رأس الحكمة\u003c/strong\u003e\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022\u003e.\u0026nbsp;\u003c/span\u003e\u003cspan lang=\u0022AR-SA\u0022\u003eاحجز وحدتك الآن وانعم بحياة بحرية لا مثيل لها\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022\u003e!\u0026nbsp;\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022 style=\u0022font-family: 'Segoe UI Symbol',sans-serif; mso-bidi-font-family: 'Segoe UI Symbol';\u0022\u003e🌊🏝\u003c/span\u003e\u003cspan dir=\u0022LTR\u0022\u003e️\u003c/span\u003e\u003c/p\u003e"} /-->

<!-- wp:custom/cta-block /-->

<!-- wp:custom/form-block /-->

<!-- wp:custom/cta-block2 /-->

<!-- wp:custom/card-section /-->

<!-- wp:custom/accordion-section {"sectionTitle":"اهم الاسئلة الشائعه من عملائنا","accordions":[{"id":1752797536154,"title":"فين موقع مشروع ماونتن فيو بلاچ؟","content":"\u003cp\u003e\u0026nbsp;\u003c/p\u003e\n\u003cp style=\u0022text-align: center;\u0022\u003e📍 المشروع في الساحل الشمالي عند الكيلو 124 على طريق الإسكندرية \u0026ndash; مطروح، في قلب رأس الحكمة، واحدة من أجمل شواطئ البحر المتوسط.\u003c/p\u003e\n\u003cdiv id=\u0022gtx-trans\u0022 style=\u0022position: absolute; left: 413px; top: 18.1875px;\u0022\u003e\n\u003cdiv class=\u0022gtx-trans-icon\u0022\u003e\u0026nbsp;\u003c/div\u003e\n\u003c/div\u003e"},{"id":1752797571766,"title":"إيه أنواع الوحدات المتوفرة؟","content":"\u003cp style=\u0022text-align: center;\u0022\u003e🏡 المشروع بيضم شاليهات، تاون هاوس، وتوين هاوس بتصميم يوناني على اللاجون أو البحر، بمساحات متنوعة تناسب كل الاحتياجات.\u003c/p\u003e\n\u003cdiv id=\u0022gtx-trans\u0022 style=\u0022position: absolute; left: 456px; top: -14px;\u0022\u003e\n\u003cdiv class=\u0022gtx-trans-icon\u0022\u003e\u0026nbsp;\u003c/div\u003e\n\u003c/div\u003e"},{"id":1752797573928,"title":"المشروع فيه إيه من خدمات؟","content":"\u003cp style=\u0022text-align: center;\u0022\u003e🌴 فيه لاجونز ضخمة، شواطئ رملية، حمامات سباحة، ممشى سياحي، مطاعم وكافيهات، منطقة ألعاب أطفال، بيتش كلوب، خدمات أمن وصيانة 24 ساعة.\u003c/p\u003e\n\u003cdiv id=\u0022gtx-trans\u0022 style=\u0022position: absolute; left: 449px; top: -14px;\u0022\u003e\n\u003cdiv class=\u0022gtx-trans-icon\u0022\u003e\u0026nbsp;\u003c/div\u003e\n\u003c/div\u003e"}]} /-->

<!-- wp:custom/cta-block2 /-->

<!-- wp:custom/gallery-images {"images":["https://mountainview.boldroutes.com/wp-content/uploads/2025/06/mountain-view-ras-el-hikmah-3-16-1-scaled-1.jpg","https://mountainview.boldroutes.com/wp-content/uploads/2025/06/5056535-plage-dJKpzvEMHB.webp","https://mountainview.boldroutes.com/wp-content/uploads/2025/06/الساحل-الشمالى.jpg","https://mountainview.boldroutes.com/wp-content/uploads/2025/06/قرية-ماونتن-فيو-راس-الحكمة.jpg"]} /-->

<!-- wp:custom/project-content-block {"sectionTitle":"احجز الأن في أي مشروع من مشروعات ماونتن فيو","content":"\u003cp style=\u0022text-align: center;\u0022\u003e\u003cstrong style=\u0022text-align: center;\u0022\u003eماونتن فيو رأس الحكمة \u0026ndash; ماونتن فيو plage \u0026ndash; ماونتن فيو lvls\u003c/strong\u003e\u003c/p\u003e\n\u003cdiv id=\u0022gtx-trans\u0022 style=\u0022position: absolute; left: 605px; top: 32px;\u0022\u003e\n\u003cdiv class=\u0022gtx-trans-icon\u0022\u003e\u0026nbsp;\u003c/div\u003e\n\u003c/div\u003e"} /-->

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
