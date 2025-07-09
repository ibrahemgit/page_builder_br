import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';

registerBlockType('custom/cta-block2', {
    title: 'CTA تواصل معنا 2',
    icon: 'phone',
    category: 'custom-CTA',

    attributes: {
        titleText: { type: 'string', default: 'تواصل معنا لمزيد من التفاصيل' },
        phoneNumber: { type: 'string', default: '' },
        whatsNumber: { type: 'string', default: '' },
        enableCTAPopup: { type: 'boolean', default: false },
        ctaPopupText: { type: 'string', default: 'طلب عرض سعر' },
    },

    example: {
        attributes: {
            titleText: 'تواصل معنا الآن!',
            phoneNumber: '',
            whatsNumber: '',
            enableCTAPopup: true,
            ctaPopupText: 'طلب اتصال',
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { titleText, phoneNumber, whatsNumber, enableCTAPopup, ctaPopupText } = attributes;

        return (
            <div className="cta-block-editor">
                <InspectorControls>
                    <PanelBody title="إعدادات القسم">
                        <TextControl
                            label="عنوان القسم"
                            value={titleText}
                            onChange={(value) => setAttributes({ titleText: value })}
                        />
                        <ToggleControl
                            label="تفعيل زر البوب اب"
                            checked={enableCTAPopup}
                            onChange={(value) => setAttributes({ enableCTAPopup: value })}
                        />
                        {enableCTAPopup && (
                            <TextControl
                                label="نص زر البوب اب"
                                value={ctaPopupText}
                                onChange={(value) => setAttributes({ ctaPopupText: value })}
                            />
                        )}
                    </PanelBody>
                </InspectorControls>

                <div className="shortcodesection">
                    <div className="container">
                        <div className="custom_cta_shortcode cta_block2">
                            <div className="headline sm_title shorttitle">
                                <span>{titleText}</span>
                            </div>
                            <div className="towitem">
                                <a id="cta_whats" target="_blank" className="whatsapp">
                                    <i className="fa fa-whatsapp" aria-hidden="true"></i> واتساب
                                </a>
                                <a id="cta_call" className="phone">
                                    <i className="fa fa-phone" aria-hidden="true"></i> اتصال
                                </a>
                                {enableCTAPopup && (
                                    <span id="cta_pop" className="formpopub openform">
                                        <i className="fa fa-envelope-open-o" aria-hidden="true"></i> {ctaPopupText}
                                    </span>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    },

    save: () => null // سيتم العرض من خلال render_callback
});
