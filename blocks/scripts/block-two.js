import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, ColorPalette } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button, ToggleControl } from '@wordpress/components';

registerBlockType('custom/form-block', {
    title: 'نموذج التواصل',
    icon: 'email',
    category: 'custom-blocks',

    attributes: {
        formTitle: { type: 'string', default: 'تواصل معنا الان' },
        submitButtonText: { type: 'string', default: 'إرسال' },
        formID: { type: 'string', default: 'header_form' },
        namePlaceholder: { type: 'string', default: 'الاسم بالكامل' },
        phonePlaceholder: { type: 'string', default: 'رقم الهاتف' },
        bgColor: { type: 'string', default: '#000000' },
        reverseColor: { type: 'boolean', default: false },
        buttonBgColor: { type: 'string', default: '#0073aa' }, // ✅ لون خلفية الزر
        buttonTextColor: { type: 'string', default: '#ffffff' } // ✅ لون نص الزر
    },

    example: {
        attributes: {
            formTitle: 'تواصل معنا الان',
            submitButtonText: 'اشترك الآن',
            formID: 'example_form',
            namePlaceholder: 'أدخل اسمك',
            phonePlaceholder: 'أدخل رقم هاتفك',
            bgColor: '#000000',
            reverseColor: true,
            buttonBgColor: '#0073aa',
            buttonTextColor: '#ffffff'
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { formTitle, submitButtonText, formID, namePlaceholder, phonePlaceholder, bgColor, reverseColor, buttonBgColor, buttonTextColor } = attributes;

        return (
            <div className="form-block-editor">
                <InspectorControls>
                    <PanelBody title="إعدادات النموذج">
                        <TextControl
                            label="عنوان النموذج"
                            value={formTitle}
                            onChange={(value) => setAttributes({ formTitle: value })}
                        />
                        <TextControl
                            label="نص زر الإرسال"
                            value={submitButtonText}
                            onChange={(value) => setAttributes({ submitButtonText: value })}
                        />
                        <TextControl
                            label="ID الخاص بالنموذج"
                            value={formID}
                            onChange={(value) => setAttributes({ formID: value })}
                        />
                        <TextControl
                            label="النص الافتراضي لحقل الاسم"
                            value={namePlaceholder}
                            onChange={(value) => setAttributes({ namePlaceholder: value })}
                        />
                        <TextControl
                            label="النص الافتراضي لحقل الهاتف"
                            value={phonePlaceholder}
                            onChange={(value) => setAttributes({ phonePlaceholder: value })}
                        />

                        <PanelBody title="لون الخلفية">
                            <ColorPalette
                                value={bgColor}
                                onChange={(color) => setAttributes({ bgColor: color })}
                            />
                        </PanelBody>

                        {/* ✅ زر Toggle لعكس الألوان */}
                        <ToggleControl
                            label="عكس الألوان (reverscolor)"
                            checked={reverseColor}
                            onChange={(value) => setAttributes({ reverseColor: value })}
                        />
                    </PanelBody>

                    {/* ✅ بانل منفصل لإعدادات زر الإرسال */}
                    <PanelBody title="إعدادات زر الإرسال" initialOpen={false}>
                        <p>لون خلفية الزر:</p>
                        <ColorPalette
                            value={buttonBgColor}
                            onChange={(color) => setAttributes({ buttonBgColor: color })}
                        />
                        <p>لون نص الزر:</p>
                        <ColorPalette
                            value={buttonTextColor}
                            onChange={(color) => setAttributes({ buttonTextColor: color })}
                        />
                    </PanelBody>
                </InspectorControls>

                {/* ✅ تطبيق الألوان في المعاينة */}
                <div className={`project_header ${reverseColor ? 'reverscolor' : ''}`} style={{ backgroundColor: bgColor }}>
                    <div className='container'>
                        <div className='headflx'>
                            <div className="contact_us">
                                <div className="form-title">{formTitle}</div>
                                <form action="#" method="post" id={formID}>
                                    <div className="cusinpput">
                                        <label htmlFor="name">الاسم *</label>
                                        <input placeholder={namePlaceholder} type="text" id="name" name="name" required />
                                    </div>
                                    <div className="cusinpput">
                                        <label htmlFor="phone">رقم الهاتف *</label>
                                        <input placeholder={phonePlaceholder} type="tel" id="phone" name="phone" required />
                                    </div>
                                    <button className='submit' type="submit" style={{ backgroundColor: buttonBgColor, color: buttonTextColor }}>
                                        {submitButtonText}
                                    </button>
                                </form>
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
