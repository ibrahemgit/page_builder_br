import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, ColorPalette } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';

registerBlockType('custom/cta-block', {
    title: 'CTA تواصل معنا',
    icon: 'phone',
    category: 'custom-blocks',

    attributes: {
        titleText: { type: 'string', default: 'تواصل معنا لمزيد من التفاصيل' },
        phoneNumber: { type: 'string', default: '' },
        whatsNumber: { type: 'string', default: '' },
    },

    example: {
        attributes: {
            titleText: 'تواصل معنا الآن!',
            phoneNumber: '',
            whatsNumber: '',
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { titleText, ctaText, whatsNumber, phoneNumber } = attributes;

        return (
            <div className="cta-block-editor">
                <InspectorControls>
                    <PanelBody title="إعدادات القسم">
                        <TextControl
                            label="عنوان القسم"
                            value={titleText}
                            onChange={(value) => setAttributes({ titleText: value })}
                        />
                       
                       <TextControl
                            label="رقم الواتس"
                            value={whatsNumber}
                            onChange={(value) => setAttributes({ whatsNumber: value })}
                        />

                        <TextControl
                            label="رقم الهاتف"
                            value={phoneNumber}
                            onChange={(value) => setAttributes({ phoneNumber: value })}
                        />
                        
                    </PanelBody>
                </InspectorControls>

                {/* ✅ تطبيق الألوان في المعاينة */}
                <div className="shortcodesection">
                    <div className="container">
                        <div className="custom_cta_shortcode">
                            <div className="headline sm_title shorttitle">
                                <span>{titleText}</span>
                            </div>
                            <div className="towitem">
                                
                                <a id="cta_whats" target="_blank" className="whatsapp">
                                    <i className="fa fa-whatsapp" aria-hidden="true"></i> واتساب
                                </a>
                                <a id="cta_call" className="phone" >
                                    <i className="fa fa-phone" aria-hidden="true"></i> اتصال
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    },

    save: () => {
        return null; // سيتم التعامل مع الريندر من خلال PHP
    }
});
