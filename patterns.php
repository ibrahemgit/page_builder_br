<?php
function register_custom_patterns() {
    register_block_pattern(
        'custom/homepage-layout',
        array(
            'title'       => __( 'تصميم الصفحة الرئيسية', 'text-domain' ),
            'description' => __( 'تصميم متكامل باستخدام البلوكات المخصصة.', 'text-domain' ),
            'categories'  => array( 'custom-patterns' ),
            'content'     => '
            
<!-- wp:custom/contact-bar /-->

<!-- wp:custom/hero-header {"enableForm":true,"enableFormStyle":false,"enableCTAPopup":false} /-->

<!-- wp:custom/project-content-block {"reverseImage":true} /-->

<!-- wp:custom/form-block /-->

<!-- wp:custom/card-section {"cards":[{"title":"عنوان جديد","content":"وصف البطاقة","backgroundColor":"#1c2949","textColor":"#ffffff"},{"title":"عنوان جديد","content":"وصف البطاقة","backgroundColor":"#353b48","textColor":"#ffffff"},{"title":"عنوان جديد","content":"وصف البطاقة","backgroundColor":"#303952","textColor":"#ffffff"}]} /-->

<!-- wp:custom/gallery-images /-->

<!-- wp:custom/arabic-steps /-->

<!-- wp:custom/form-block /-->

<!-- wp:custom/footer-cta-block /-->

',
        )
    );

register_block_pattern(
        'custom/homepage-ma3rd',
        array(
            'title'       => __( 'تصميم المعرض', 'text-domain' ),
            'description' => __( 'تصميم مخصص للمعرض.', 'text-domain' ),
            'categories'  => array( 'ma3rd-patterns' ),
            'content'     => '
<!-- wp:custom/contact-bar /-->
<!-- wp:custom/hero-header {"enableForm":true,"formTitle":"لمعرفة تفاصيل اكتر عن الأسعار والمساحات وأنظمة السداد والعروض تواصل معنا","enableFormStyle":false,"enableCTAWhatsapp":false,"enableCTACall":false} /-->
<!-- wp:custom/cta-block2 /-->
<!-- wp:custom/project-content-block /-->
<!-- wp:custom/cta-block2 /-->
<!-- wp:custom/project-content-block {"sectionTitle":"","pricetbda":"15 مليون جنية","mkadmybda":"5%","tkseetybda":"8 سنوات"} /-->
<!-- wp:custom/cta-block /-->

<!-- wp:custom/form-block /-->

<!-- wp:custom/cta-block2 /-->


<!-- wp:custom/card-section /-->
<!-- wp:custom/cta-block2 /-->

<!-- wp:custom/gallery-images /-->

<!-- wp:custom/project-content-block {"sectionTitle":"يمكنك الحجز من خلالنا في كل مشروعات ماونتن فيو الساحل الشمالي","content":"\u003cp style=\u0022text-align: center;\u0022\u003e\u003cstrong\u003eماونتن فيو راس الحكمة - \u003c/strong\u003e\u003cstrong\u003eماونتن فيو كريستا - \u003c/strong\u003e\u003cstrong\u003eماونتن فيو سيدي عبدالرحمن - \u003c/strong\u003e\u003cstrong\u003eماونتن فيو بلاج - \u003c/strong\u003e\u003cstrong\u003eماونتن فيو ليفلز - \u003c/strong\u003e\u003cstrong\u003eماونتن فيو الضبعة\u003c/strong\u003e\u003c/p\u003e"} /-->
<!-- wp:custom/cta-block {"titleText":"احجز كل مشاريعك"} /-->

<!-- wp:custom/arabic-steps /-->

<!-- wp:custom/form-block /-->

<!-- wp:custom/footer-cta-block /-->
',
        )
    );
}

add_action('init', 'register_custom_patterns');
?>
