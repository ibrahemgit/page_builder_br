import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, PanelColorSettings } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

registerBlockType('custom/contact-bar', {
    title: 'شريط الهيدر الفيكسد',
    icon: 'admin-comments',
    category: 'custom-CTA',

    attributes: {
        backgroundColor: { type: 'string', default: '#222' },
        textColor: { type: 'string', default: '#fff' }
    },

    edit: ({ attributes, setAttributes }) => {
        const { backgroundColor, textColor } = attributes;

        return (
            <Fragment>
                <InspectorControls>
                    <PanelColorSettings
                        title="ألوان الشريط"
                        colorSettings={[
                            {
                                value: backgroundColor,
                                onChange: (color) => setAttributes({ backgroundColor: color }),
                                label: 'لون الخلفية'
                            },
                            {
                                value: textColor,
                                onChange: (color) => setAttributes({ textColor: color }),
                                label: 'لون النص'
                            }
                        ]}
                    />
                </InspectorControls>

                <div className="custom-contact-bar inview" style={{ backgroundColor, color: textColor, textAlign: 'center' }}>
                    <div className="contact-buttons">
                        <span className='contact-btn' style={{ margin: '0 10px' }}> <i className="fa fa-whatsapp"></i> واتساب </span>
                        <span className='contact-btn' style={{ margin: '0 10px' }}> <i className="fa fa-phone"></i> اتصل بنا </span>
                        <span className='contact-btn' style={{ margin: '0 10px' }}> <i className="fa fa-envelope-open-o"></i> احجز وحدتك </span>
                    </div>
                </div>
            </Fragment>
        );
    },

    save: () => null // سيتم العرض عبر PHP
});
