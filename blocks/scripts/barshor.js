import { registerBlockType } from '@wordpress/blocks';
import { TextControl } from '@wordpress/components';
import { InspectorControls , PanelColorSettings  } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';
import { Fragment } from '@wordpress/element';
const steps = [
    {
        title: 'سجّل اهتمامك',
        desc: 'املأ النموذج وسيقوم فريقنا بالتواصل معك.'
    },
    {
        title: 'احجز وحدتك',
        desc: 'اختر العقار المناسب وادفع عربون الحجز.'
    },
    {
        title: 'تابع خطة الدفع',
        desc: 'ادفع حسب الجدول المالي المحدد للمشروع.'
    },
    {
        title: 'استلم العقار',
        desc: 'عند الانتهاء من المشروع، يصبح عقارك جاهزًا للتسليم.'
    }
];
registerBlockType('custom/arabic-steps', {
    title: 'البرشور',
    icon: 'list-view',
    category: 'custom-CTA',

    attributes: {
        widgetTitle: { type: 'string', default: 'امتلك عقارك بخطوات بسيطة' },
        ctaText: { type: 'string', default: 'سجل اهتمامك' },
        ctaLink: { type: 'string', default: '#' },
        ctaBgColor: { type: 'string', default: '#007cba' },
        ctaTextColor: { type: 'string', default: '#ffffff' }
    },




    edit: ({ attributes, setAttributes }) => {
        const { widgetTitle, ctaText, ctaLink } = attributes;

        return (
            <Fragment>
                <InspectorControls>
                    <PanelBody title="إعدادات القسم">
                        <TextControl
                            label="عنوان القسم"
                            value={widgetTitle}
                            onChange={(value) => setAttributes({ widgetTitle: value })}
                        />
                        <TextControl
                            label="نص الزر"
                            value={ctaText}
                            onChange={(value) => setAttributes({ ctaText: value })}
                        />
                        <TextControl
                            label="رابط الزر"
                            value={ctaLink}
                            onChange={(value) => setAttributes({ ctaLink: value })}
                        />
                    </PanelBody>

                    <PanelColorSettings
                        title="ألوان الزر"
                        initialOpen={false}
                        colorSettings={[
                            {
                                value: attributes.ctaBgColor,
                                onChange: (value) => setAttributes({ ctaBgColor: value }),
                                label: 'لون الخلفية'
                            },
                            {
                                value: attributes.ctaTextColor,
                                onChange: (value) => setAttributes({ ctaTextColor: value }),
                                label: 'لون النص'
                            }
                        ]}
                    />
                </InspectorControls>


                <div className="arabic-steps-widget prev">
                    <div className="headline sm_title shorttitle">
                        <span>{widgetTitle}</span>
                    </div>

                    <div className="steps-row">
                        {steps.map((step, index) => (
                            <div className="step-wrapper" key={index}>
                                <div className="step-item">
                                    <div
                                        className="step-circle"
                                        style={{
                                            color: attributes.ctaBgColor,
                                            borderColor: attributes.ctaBgColor
                                        }}
                                    >
                                        {index + 1}
                                    </div>
                                </div>
                                <div className="step-label">
                                    <div className="step-label-title">{step.title}</div>
                                    <div className="step-label-desc">{step.desc}</div>
                                </div>
                            </div>
                        ))}
                    </div>
                    <div class="steps-cta"><a className="cta-button" href={ctaLink} style={{backgroundColor: attributes.ctaBgColor,color: attributes.ctaTextColor,padding: '10px 20px',textDecoration: 'none',display: 'inline-block',borderRadius: '5px'}}>{ctaText}</a></div>
                    
                </div>
            </Fragment>
        );
    },

    save: () => null // render_callback عبر PHP
});
