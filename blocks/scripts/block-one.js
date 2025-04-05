import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, MediaUpload } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';
import { useEffect } from '@wordpress/element';

registerBlockType('custom/home-banner', {
    title: 'Home Page Banner',
    icon: 'format-image',
    category: 'custom-blocks',

    attributes: {
        bannerImagePc: { type: 'string', default: 'https://boldroutesexpo.com/wp-content/uploads/2025/02/43255310080-scaled.webp' },
        bannerImageMobile: { type: 'string', default: 'https://boldroutesexpo.com/wp-content/uploads/2025/02/43255310080-scaled.webp' },
        bannerTitle: { type: 'string', default: 'عنوان البانر' },
    },

    example: {
        attributes: {
            bannerImagePc: 'https://boldroutesexpo.com/wp-content/uploads/2025/02/43255310080-scaled.webp',
            bannerImageMobile: 'https://boldroutesexpo.com/wp-content/uploads/2025/02/43255310080-scaled.webp',
            bannerTitle: 'معاينة البانر',
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { bannerImagePc, bannerImageMobile, bannerTitle } = attributes;

        useEffect(() => {
            document.documentElement.style.setProperty('--homepanner', `url(${bannerImagePc})`);
            document.documentElement.style.setProperty('--homepanner_mobile', `url(${bannerImageMobile})`);
        }, [bannerImagePc, bannerImageMobile]);

        return (
            <div className="banner-block-editor">
                <InspectorControls>
                    <PanelBody title="إعدادات البانر">
                        <MediaUpload
                            onSelect={(media) => setAttributes({ bannerImagePc: media.url })}
                            allowedTypes={['image']}
                            render={({ open }) => (
                                <Button onClick={open} isPrimary>اختر صورة للحاسوب</Button>
                            )}
                        />
                        {bannerImagePc && <img src={bannerImagePc} alt="صورة الحاسوب" style={{ maxWidth: '100%' }} />}

                        <MediaUpload
                            onSelect={(media) => setAttributes({ bannerImageMobile: media.url })}
                            allowedTypes={['image']}
                            render={({ open }) => (
                                <Button onClick={open} isPrimary>اختر صورة للهاتف</Button>
                            )}
                        />
                        {bannerImageMobile && <img src={bannerImageMobile} alt="صورة الهاتف" style={{ maxWidth: '100%' }} />}

                        <TextControl
                            label="عنوان البانر"
                            value={bannerTitle}
                            onChange={(value) => setAttributes({ bannerTitle: value })}
                        />
                    </PanelBody>
                </InspectorControls>

                {/* ✅ عرض المعاينة المباشرة داخل المحرر */}
                <style>
                    {`
                        :root {
                            --homepanner: url(${bannerImagePc});
                            --homepanner_mobile: url(${bannerImageMobile});
                        }
                    `}
                </style>
                <div className='herosection'>
                    <div className='container'>
                        <div className='flxcnter'>
                            <h1>{bannerTitle}</h1>
                        </div>
                    </div>
                </div>
            </div>
        );
    },

    save: () => null, // ❌ لا يتم حفظ البيانات هنا، سيتم عرضها عبر PHP
});
