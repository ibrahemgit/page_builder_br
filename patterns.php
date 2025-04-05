<?php
function register_custom_patterns() {
    register_block_pattern(
        'custom/homepage-layout',
        array(
            'title'       => __( 'تصميم الصفحة الرئيسية', 'text-domain' ),
            'description' => __( 'تصميم متكامل باستخدام البلوكات المخصصة.', 'text-domain' ),
            'categories'  => array( 'custom-patterns' ),
            'content'     => '
<!-- wp:custom/home-banner {"bannerImageMobile":"http://brsystem.local/wp-content/uploads/2025/02/WhatsApp-Image-2025-02-18-at-2.24.31-AM.jpeg"} /-->
<!-- wp:custom/form-block /-->
<!-- wp:custom/gallery-block {"images":["http://brsystem.local/wp-content/uploads/2025/02/images-1.png","http://brsystem.local/wp-content/uploads/2025/02/4610-d89fdo.jpg","http://brsystem.local/wp-content/uploads/2025/02/Emaar-Properties-Logo.png","http://brsystem.local/wp-content/uploads/2025/02/emaar_dubai.png"]} /-->
<!-- wp:custom/form-block {"reverseColor":true} /-->
<!-- wp:custom/project-content-block {"content":"\u003cp\u003eمحتوي تجريبي\u003c/p\u003e\n\u003cul\u003e\n\u003cli\u003eأضف المحتوى هنا...\u003c/li\u003e\n\u003cli\u003eالمحتوي المحتوي\u003c/li\u003e\n\u003cli\u003e\u003cstrong\u003eتجريبي \u003c/strong\u003eتجريبي\u003c/li\u003e\n\u003c/ul\u003e","imageUrl":"http://brsystem.local/wp-content/uploads/2025/02/Burj_Khalifa.png"} /-->
<!-- wp:custom/form-block {"reverseColor":true} /-->
<!-- wp:custom/form-block /-->',
        )
    );
}
add_action('init', 'register_custom_patterns');
?>
