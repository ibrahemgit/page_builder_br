<?php
function register_custom_patterns() {
    register_block_pattern(
        'custom/homepage-layout',
        array(
            'title'       => __( 'تصميم الصفحة الرئيسية', 'text-domain' ),
            'description' => __( 'تصميم متكامل باستخدام البلوكات المخصصة.', 'text-domain' ),
            'categories'  => array( 'custom-patterns' ),
            'content'     => '
<!-- wp:custom/home-banner /-->
<!-- wp:custom/form-block /-->
<!-- wp:custom/cta-block /-->
<!-- wp:custom/project-content-block /-->
<!-- wp:custom/form-block /-->
<!-- wp:custom/cta-block /-->
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
<!-- wp:custom/home-banner /-->
<!-- wp:custom/fixed-header /-->
<!-- wp:custom/project-content-block /-->
<!-- wp:custom/form-block /-->
<!-- wp:custom/gallery-logos /-->
<!-- wp:custom/youtube-gallery /-->
<!-- wp:custom/footer-cta-block /-->
',
        )
    );

}
add_action('init', 'register_custom_patterns');
?>
