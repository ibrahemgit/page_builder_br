import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, ColorPalette } from '@wordpress/block-editor';
import { PanelBody, TextControl, DateTimePicker, ToggleControl } from '@wordpress/components';
import { useState } from '@wordpress/element';

registerBlockType('custom/fixed-header', {
    title: 'Fixed Header Control',
    icon: 'admin-settings',
    category: 'custom-blocks',

    attributes: {
        titleText: { type: 'string', default: 'معرض بولد روتس' },
        subtitleText: { type: 'string', default: 'اشترك في العضوية' },
        countdownTime: { type: 'string', default: '' },
        backgroundColor: { type: 'string', default: '#000' },
        isRTL: { type: 'boolean', default: true },
        registerButtonText: { type: 'string', default: 'سجل بياناتك' },
        registerButtonBgColor: { type: 'string', default: '#007cba' }, // ✅ لون خلفية الزر
        registerButtonTextColor: { type: 'string', default: '#ffffff' } // ✅ لون نص الزر
    },

    edit: ({ attributes, setAttributes }) => {
        const { titleText, subtitleText, countdownTime, backgroundColor, isRTL, registerButtonText, registerButtonBgColor, registerButtonTextColor } = attributes;

        return (
            <div className="fixed-header-editor" style={{ background: backgroundColor }}>
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
                        
                        {/* ✅ تغيير ColorPicker إلى TextControl */}
                        <TextControl
                            label="CSS Background (لون، جراديانت، الخ)"
                            value={backgroundColor}
                            onChange={(value) => setAttributes({ backgroundColor: value })}
                            placeholder="مثال: #000 أو linear-gradient(45deg, #ff6b6b, #4ecdc4)"
                            help="يمكنك كتابة أي CSS background: لون عادي، جراديانت، أو أي تأثير آخر"
                        />
                        <div style={{ fontSize: '11px', color: '#666', marginTop: '5px', marginBottom: '15px' }}>
                            <strong>أمثلة:</strong><br/>
                            • لون عادي: <code>#000</code><br/>
                            • جراديانت: <code>linear-gradient(45deg, #ff6b6b, #4ecdc4)</code><br/>
                            • جراديانت متعدد: <code>linear-gradient(to bottom right, #0E1627, #000, #1f2937)</code>
                        </div>

                        {/* ✅ خيار الاتجاه الجديد */}
                        <ToggleControl
                            label="الاتجاه من اليمين لليسار (RTL)"
                            checked={isRTL}
                            onChange={(value) => setAttributes({ isRTL: value })}
                            help={isRTL ? "الاتجاه: من اليمين لليسار (RTL)" : "الاتجاه: من اليسار لليمين (LTR)"}
                        />

                        {/* ✅ إعدادات زر التسجيل - جديد */}
                        <TextControl
                            label="نص زر التسجيل"
                            value={registerButtonText}
                            onChange={(value) => setAttributes({ registerButtonText: value })}
                            placeholder="سجل بياناتك"
                        />
                        
                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>
                                لون خلفية الزر
                            </label>
                            <ColorPalette
                                value={registerButtonBgColor}
                                onChange={(color) => setAttributes({ registerButtonBgColor: color || '#007cba' })}
                                colors={[
                                    { name: 'أزرق', color: '#007cba' },
                                    { name: 'أخضر', color: '#22c55e' },
                                    { name: 'أحمر', color: '#ef4444' },
                                    { name: 'برتقالي', color: '#f59e0b' },
                                    { name: 'بنفسجي', color: '#8b5cf6' },
                                    { name: 'وردي', color: '#ec4899' },
                                    { name: 'أسود', color: '#000000' },
                                    { name: 'رمادي', color: '#6b7280' }
                                ]}
                            />
                        </div>

                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>
                                لون نص الزر
                            </label>
                            <ColorPalette
                                value={registerButtonTextColor}
                                onChange={(color) => setAttributes({ registerButtonTextColor: color || '#ffffff' })}
                                colors={[
                                    { name: 'أبيض', color: '#ffffff' },
                                    { name: 'أسود', color: '#000000' },
                                    { name: 'رمادي فاتح', color: '#f3f4f6' },
                                    { name: 'رمادي غامق', color: '#374151' },
                                    { name: 'أزرق فاتح', color: '#dbeafe' },
                                    { name: 'أخضر فاتح', color: '#dcfce7' },
                                    { name: 'أحمر فاتح', color: '#fef2f2' },
                                    { name: 'برتقالي فاتح', color: '#fef3c7' }
                                ]}
                            />
                        </div>
                    </PanelBody>
                </InspectorControls>

                <div className="sectionfixd" style={{ background: backgroundColor, direction: isRTL ? 'rtl' : 'ltr' }}>
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
                                    <span id="subform" class='subform' style={{ 
                                        backgroundColor: registerButtonBgColor,
                                        color: registerButtonTextColor 
                                    }}>
                                        {registerButtonText}
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