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
}
add_action('init', 'register_custom_patterns');
?>
