import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, ColorPalette } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';

registerBlockType('custom/footer-cta-block2', {
    title: 'Footer CTA 2',
    icon: 'phone',
    category: 'custom-CTA',

    attributes: {
        titleText: { type: 'string', default: 'تواصل معنا لمزيد من التفاصيل' },
        phoneNumber: { type: 'string', default: '' },
        whatsNumber: { type: 'string', default: '' },
        borderColor: { type: 'string', default: '#000000' } // ✅ اللون الافتراضي للبوردر
    },

    example: {
        attributes: {
            titleText: 'تواصل معنا الآن!',
            phoneNumber: '',
            whatsNumber: '',
            borderColor: '#000000'
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { titleText, phoneNumber, whatsNumber, borderColor } = attributes;

        return (
            <div className="cta-block-editor">
                <InspectorControls>
                    <PanelBody title="إعدادات القسم">
                        <TextControl
                            label="عنوان القسم"
                            value={titleText}
                            onChange={(value) => setAttributes({ titleText: value })}
                        />
                        <PanelBody title="لون البوردر" initialOpen={true}>
                            <ColorPalette
                                value={borderColor}
                                onChange={(newColor) => setAttributes({ borderColor: newColor })}
                            />
                        </PanelBody>
                    </PanelBody>
                </InspectorControls>

                {/* ✅ تطبيق اللون المختار على العنصر */}
                <div className="footer_CTA2" style={{ borderColor: ` ${borderColor}` }}>
                    <div className="container">
                        <div className="footer_cta_block2">
                            <div className="footer_title" style={{ borderColor: ` ${borderColor}` }}>
                                <span>{titleText}</span>
                            </div>
                            <div className="towitem">
                                <a id="cta_whats" target="_blank" className="whatsapp">
                                    <i className="fa fa-whatsapp" aria-hidden="true"></i> واتساب
                                </a>
                                <span id="subform" class='subform'>
                                    سجل بياناتك
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    },

    save: () => null
});
