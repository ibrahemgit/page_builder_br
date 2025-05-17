import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ColorPicker, DateTimePicker } from '@wordpress/components';
import { useState } from '@wordpress/element';

registerBlockType('custom/fixed-header', {
    title: 'Fixed Header Control',
    icon: 'admin-settings',
    category: 'custom-blocks',

    attributes: {
        titleText: { type: 'string', default: 'معرض بولد روتس' },
        subtitleText: { type: 'string', default: 'اشترك في العضوية' },
        countdownTime: { type: 'string', default: '' },
        backgroundColor: { type: 'string', default: '#000' }
    },

    edit: ({ attributes, setAttributes }) => {
        const { titleText, subtitleText, countdownTime, backgroundColor } = attributes;

        return (
            <div className="fixed-header-editor" style={{ backgroundColor }}>
                <InspectorControls>
                    <PanelBody title="Header Settings">
                        <TextControl
                            label="Main Title"
                            value={titleText}
                            onChange={(value) => setAttributes({ titleText: value })}
                        />
                        <TextControl
                            label="Subtitle"
                            value={subtitleText}
                            onChange={(value) => setAttributes({ subtitleText: value })}
                        />
                        <DateTimePicker
                            currentDate={countdownTime}
                            onChange={(date) => setAttributes({ countdownTime: date })}
                            is12Hour={false}
                        />
                        <ColorPicker
                            label="Background Color"
                            color={backgroundColor}
                            onChange={(color) => setAttributes({ backgroundColor: color })}
                            disableAlpha
                        />
                    </PanelBody>
                </InspectorControls>

                <div className="sectionfixd" style={{ backgroundColor }}>
                    <div className="container">
                        <div className='scfixdcontentflx'>
                            <div className='col-section colone'>
                                <div className='scfixdtitle'>
                                    <h2 className='scfixdtitleh'>{titleText}</h2>
                                    <span>{subtitleText}</span>
                                </div>
                            </div>
                            <div className='col-section coltow'>
                                <div id="countdown">هيظهر التايمر هنا</div>
                            </div>
                            <div className='col-section coltree'>
                                
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
            </div>
        );
    },

    save: () => null
});
