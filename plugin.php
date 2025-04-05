<?php
/**
 * Plugin Name: BR Plugin
 * Description: إضافة ووردبريس تحتوي على بلوك مخصص.
 * Version: 1.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) {
    exit; // منع الوصول المباشر للملف
}

// تحميل السكربتات والستايلات من `build/`
function brplugin_register_blocks() {
    $js_file = plugin_dir_path(__FILE__) . 'build/index.js'; // ملف JavaScript النهائي
    $css_file = plugin_dir_path(__FILE__) . 'build/index.css'; // ملف CSS النهائي

    // تسجيل JavaScript إذا كان الملف موجودًا
    if (file_exists($js_file)) {
        wp_register_script(
            'brplugin-blocks-js',
            plugins_url('build/index.js', __FILE__),
            array('wp-blocks', 'wp-editor', 'wp-element'),
            filemtime($js_file)
        );
    }

    // تسجيل CSS إذا كان الملف موجودًا
    if (file_exists($css_file)) {
        wp_register_style(
            'brplugin-blocks-css',
            plugins_url('build/index.css', __FILE__),
            array(),
            filemtime($css_file)
        );
    }

    // تسجيل البلوك مع تحميل السكربتات والستايلات الجاهزة
    register_block_type('brplugin/block-one', array(
        'editor_script' => 'brplugin-blocks-js',
        'editor_style'  => 'brplugin-blocks-css',
        'style'         => 'brplugin-blocks-css',
    ));
}

add_action('init', 'brplugin_register_blocks');


require_once plugin_dir_path(__FILE__) . 'patterns.php';

// require_once plugin_dir_path(__FILE__) . 'render_callback/header_section.php';
// require_once plugin_dir_path(__FILE__) . 'render_callback/form.php';
// require_once plugin_dir_path(__FILE__) . 'render_callback/imgloob.php';
// require_once plugin_dir_path(__FILE__) . 'render_callback/content_section.php';
// require_once plugin_dir_path(__FILE__) . 'render_callback/cta-block.php';
// require_once plugin_dir_path(__FILE__) . 'render_callback/cta_fixed.php';


/* جروب بلوكات جديد */
function override_block_categories($categories) {
    return array(
        array(
            'slug'  => 'custom-blocks',
            'title' => '📌 بلوكات مخصصة',
            'icon'  => 'star-filled',
        ),
    );
}
add_filter('block_categories_all', 'override_block_categories', 10, 2);

/* حذف البلوكات */
function remove_all_default_blocks($allowed_block_types, $editor_context) {
    // ✅ السماح فقط ببلوكاتك التي تبدأ بـ "custom/"
    $allowed_blocks = array(
        'custom/home-banner',
        'custom/project-content-block',
        'custom/form-block',
        'custom/gallery-block',
        'custom/cta-block',
        'custom/footer-cta-block',
    );

    return $allowed_blocks;
}
add_filter('allowed_block_types_all', 'remove_all_default_blocks', 10, 2);


/* جروب انماط جديد */
function register_custom_pattern_category() {
    register_block_pattern_category(
        'custom-patterns',
        array(
            'label' => __( '📌 تخطيطات مخصصة', 'text-domain' ), // ✅ اسم المجموعة التي ستظهر في قائمة الأنماط
        )
    );
}
add_action('init', 'register_custom_pattern_category');
