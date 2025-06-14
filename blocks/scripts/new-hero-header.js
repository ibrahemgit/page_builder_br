import { MediaUpload, InspectorControls , PanelColorSettings  } from '@wordpress/block-editor';
import {
    TextControl,
    TextareaControl,
    ToggleControl,
    PanelBody,
    Button,
    SelectControl
} from '@wordpress/components';

import { registerBlockType } from '@wordpress/blocks';
import { Fragment } from '@wordpress/element';

registerBlockType('custom/hero-header', {
    title: 'Ultimate Hero Header',
    icon: 'format-image',
    category: 'custom-blocks',

    attributes: {
        backgroundImage: {
            type: 'string',
            default: 'https://placehold.co/1200x1200?text=Hero+Background'
        },
        logoImage: {
            type: 'string',
            default: 'https://placehold.co/200x80/000000/FFF?text=Logo'
        },
        title: { type: 'string', default: 'عنوان الهيدر' },
        description: { type: 'string', default: 'وصف الهيدر هنا' },
        enableForm: { type: 'boolean', default: false },
        logoAlign: { type: 'string', default: 'center' },
        ctaText: { type: 'string', default: 'اضغط هنا' },
        ctaBgColor: { type: 'string', default: '#007cba' },
        ctaTextColor: { type: 'string', default: '#ffffff' },
        enableCTA: { type: 'boolean', default: true },
        logoAbsolute: { type: 'boolean', default: false },

    },

    edit: ({ attributes, setAttributes }) => {
        const {
            backgroundImage,
            logoImage,
            title,
            description,
            enableForm,
            logoAlign
        } = attributes;

        return (
            <Fragment>
                <InspectorControls>
                    <PanelBody title="إعدادات الهيدر" initialOpen={false}>
                        <div style={{ margin: '10px 0' }}></div>

                        <MediaUpload
                            onSelect={(media) => setAttributes({ backgroundImage: media.url })}
                            allowedTypes={['image']}
                            render={({ open }) => (
                                <Button onClick={open} isSecondary>
                                    اختر صورة الخلفية
                                </Button>
                            )}
                        />
                        <div style={{ margin: '10px 0' }}></div>

                        <TextControl
                            label="عنوان الهيدر"
                            value={title}
                            onChange={(value) => setAttributes({ title: value })}
                        />
                        <TextControl
                            label="وصف الهيدر"
                            value={description}
                            onChange={(value) => setAttributes({ description: value })}
                        />

                    </PanelBody>



                    <PanelBody title='اعدادات اللوجو' initialOpen={false}>

                        <MediaUpload
                            onSelect={(media) => setAttributes({ logoImage: media.url })}
                            allowedTypes={['image']}
                            render={({ open }) => (
                                <Button onClick={open} isSecondary style={{ marginTop: '10px' }}>
                                    اختر لوجو
                                </Button>
                            )}
                        />
                        <div style={{ margin: '10px 0' }}></div>

                        <ToggleControl
                            label="عرض اللوجو بوضع مطلق (Absolute)"
                            checked={attributes.logoAbsolute}
                            onChange={(value) => setAttributes({ logoAbsolute: value })}
                        />
                        <div style={{ margin: '10px 0' }}></div>

                        {attributes.logoAbsolute && (
                            <SelectControl
                                label="محاذاة اللوجو"
                                value={attributes.logoAlign}
                                options={[
                                    { label: 'يمين', value: 'right' },
                                    { label: 'منتصف', value: 'center' },
                                    { label: 'يسار', value: 'left' }
                                ]}
                                onChange={(value) => setAttributes({ logoAlign: value })}
                            />
                        )}
                    </PanelBody>

                    <PanelBody title="إعدادات ال CTA" initialOpen={false} >

                        <PanelBody title="الفورم" initialOpen={false} >
                            <div style={{ margin: '10px 0' }}></div>

                            <ToggleControl
                                label="تفعيل الفورم العائم"
                                checked={enableForm}
                                onChange={(value) => setAttributes({ enableForm: value })}
                            />

                        </PanelBody>
                        
                        <PanelBody title="الازرار" initialOpen={false} >
                            <div style={{ margin: '10px 0' }}></div>

                            <ToggleControl
                                label="إظهار الزر"
                                checked={attributes.enableCTA}
                                onChange={(value) => setAttributes({ enableCTA: value })}
                            />
                            <div style={{ margin: '10px 0' }}></div>
                            <TextControl
                                label="نص الزر"
                                value={attributes.ctaText}
                                onChange={(value) => setAttributes({ ctaText: value })}
                            />

                            <PanelColorSettings
                                title="ألوان الزر"
                                initialOpen={false}
                                colorSettings={[
                                    {
                                        label: 'لون خلفية الزر',
                                        value: attributes.ctaBgColor,
                                        onChange: (value) => setAttributes({ ctaBgColor: value })
                                    },
                                    {
                                        label: 'لون نص الزر',
                                        value: attributes.ctaTextColor,
                                        onChange: (value) => setAttributes({ ctaTextColor: value })
                                    }
                                ]}
                            />
                        </PanelBody>
                    </PanelBody>
                </InspectorControls>

                <div
                    className="hero-header-new prev"
                    style={{ backgroundImage: `url(${backgroundImage})` }}
                >
                    <div className='container'>
                        <div className='flex-items-hero'>
                            {logoImage && (
                                <img
                                    className={`hero-new-logo logo-align-${logoAlign} ${attributes.logoAbsolute ? 'logo-absolute' : ''}`}
                                    src={logoImage}
                                    alt="Logo"
                                />
                            )}

                            {title && <h1>{title}</h1>}
                            {description && <span>{description}</span>}

                            {enableForm &&  (
                                <div> الفورم هنا </div>
                            )}

                            {attributes.enableCTA && attributes.ctaText && (
                                <a
                                    className="hero-header-cta"
                                    href="#"
                                    style={{
                                        backgroundColor: attributes.ctaBgColor,
                                        color: attributes.ctaTextColor,
                                        padding: '10px 20px',
                                        textDecoration: 'none',
                                        display: 'inline-block',
                                        borderRadius: '4px',
                                        marginTop: '20px'
                                    }}
                                >
                                    {attributes.ctaText}
                                </a>
                            )}

                        </div>
                    </div>
                </div>
            </Fragment>
        );
    },

    save: () => null // باستخدام render_callback في PHP
});
