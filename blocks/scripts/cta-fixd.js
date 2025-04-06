import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

registerBlockType('custom/footer-cta-block', {
    title: 'Footer CTA',
    icon: 'phone',
    category: 'custom-blocks',

    attributes: {
        phoneNumber: { type: 'string', default: '' },
        whatsNumber: { type: 'string', default: '' },
    },

    example: {
        attributes: {
            phoneNumber: '',
            whatsNumber: '',
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { phoneNumber, whatsNumber } = attributes;

        return (
            <div className="footer-cta-block-editor">
                <InspectorControls>
                    <PanelBody title="إعدادات التواصل">
                    </PanelBody>
                </InspectorControls>

                <div className="footer-cta">
                    <a
                        id='cta_whats' target="_blank"
                        href={`https://wa.me/${whatsNumber}?text=اريد الاستفسار عن :`}
                        className="social-item whats" aria-label="whatsapp">
                        <i className="fa fa-whatsapp" aria-hidden="true"></i>
                    </a>
                    <a id='cta_call' href={`tel:${phoneNumber}`} className="social-item phone" aria-label="call">
                        <i className="fa fa-phone" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        );
    },

    save: () => {
        return null; // سيتم الريندر باستخدام PHP
    }
});
