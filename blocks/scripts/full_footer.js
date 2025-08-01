import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, MediaUpload, ColorPalette } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl, Button } from '@wordpress/components';

registerBlockType('custom/full-footer-block', {
    title: 'Footer Block',
    icon: 'admin-generic',
    category: 'custom-blocks',

    attributes: {
        // عرض الأقسام
        showMainSection: { type: 'boolean', default: true },
        showCompanyColumn: { type: 'boolean', default: true },
        showContactColumn: { type: 'boolean', default: true },
        showSocialColumn: { type: 'boolean', default: true },
        showCopyright: { type: 'boolean', default: true },

        // ألوان
        backgroundColor: { type: 'string', default: '#111827' }, // bg-gray-900
        borderColor: { type: 'string', default: 'rgb(156 163 175 / 1)' },
        textColor: { type: 'string', default: '#ffffff' },
        secondaryTextColor: { type: 'string', default: '#d1d5db' }, // text-gray-300
        copyrightTextColor: { type: 'string', default: '#9ca3af' }, // text-gray-400

        // أزرار السوشيال ميديا
        socialButtonBg: { type: 'string', default: '#000000' },
        socialButtonText: { type: 'string', default: '#ffffff' },
        socialButtonHoverBg: { type: 'string', default: '#ffffff' },
        socialButtonHoverText: { type: 'string', default: '#000000' },

        // محتوى العمود الأول - الشركة
        companyLogo: { type: 'string', default: '' },
        companyTitle: { type: 'string', default: 'Bold Routes' },
        companyDescription: { type: 'string', default: 'نحن شركة متخصصة في تقديم أفضل الحلول والخدمات المبتكرة' },

        // محتوى العمود الثاني - معلومات الاتصال
        contactTitle: { type: 'string', default: 'معلومات الاتصال' },
        contactAddress: { type: 'string', default: 'القاهرة، مصر' },
        contactPhone: { type: 'string', default: '+20 123 456 789' },
        contactEmail: { type: 'string', default: 'info@boldroutes.com' },

        // محتوى العمود الثالث - السوشيال ميديا
        socialTitle: { type: 'string', default: 'تابعنا' },
        facebookUrl: { type: 'string', default: '#' },
        twitterUrl: { type: 'string', default: '#' },
        instagramUrl: { type: 'string', default: '#' },
        linkedinUrl: { type: 'string', default: '#' },

        // حقوق النشر
        copyrightText: { type: 'string', default: '© 2024 Bold Routes. جميع الحقوق محفوظة.' }
    },

    edit: ({ attributes, setAttributes }) => {
        const {
            showMainSection, showCompanyColumn, showContactColumn, showSocialColumn, showCopyright,
            backgroundColor, borderColor, textColor, secondaryTextColor, copyrightTextColor,
            socialButtonBg, socialButtonText, socialButtonHoverBg, socialButtonHoverText,
            companyLogo, companyTitle, companyDescription,
            contactTitle, contactAddress, contactPhone, contactEmail,
            socialTitle, facebookUrl, twitterUrl, instagramUrl, linkedinUrl,
            copyrightText
        } = attributes;

        return (
            <div className="footer-block-editor">
                <InspectorControls>
                    {/* إعدادات العرض */}
                    <PanelBody title="إعدادات العرض" initialOpen={true}>
                        <ToggleControl
                            label="إظهار القسم الرئيسي"
                            checked={showMainSection}
                            onChange={(value) => setAttributes({ showMainSection: value })}
                        />
                        {showMainSection && (
                            <>
                                <ToggleControl
                                    label="إظهار عمود الشركة"
                                    checked={showCompanyColumn}
                                    onChange={(value) => setAttributes({ showCompanyColumn: value })}
                                />
                                <ToggleControl
                                    label="إظهار عمود الاتصال"
                                    checked={showContactColumn}
                                    onChange={(value) => setAttributes({ showContactColumn: value })}
                                />
                                <ToggleControl
                                    label="إظهار عمود السوشيال ميديا"
                                    checked={showSocialColumn}
                                    onChange={(value) => setAttributes({ showSocialColumn: value })}
                                />
                            </>
                        )}
                        <ToggleControl
                            label="إظهار حقوق النشر"
                            checked={showCopyright}
                            onChange={(value) => setAttributes({ showCopyright: value })}
                        />
                    </PanelBody>

                    {/* إعدادات الألوان */}
                    <PanelBody title="إعدادات الألوان" initialOpen={false}>
                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>لون الخلفية</label>
                            <ColorPalette
                                value={backgroundColor}
                                onChange={(color) => setAttributes({ backgroundColor: color || '#111827' })}
                                colors={[
                                    { name: 'رمادي غامق', color: '#111827' },
                                    { name: 'أسود', color: '#000000' },
                                    { name: 'أزرق غامق', color: '#1e3a8a' },
                                    { name: 'أخضر غامق', color: '#166534' },
                                    { name: 'بنفسجي غامق', color: '#581c87' }
                                ]}
                            />
                        </div>

                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>لون النص الرئيسي</label>
                            <ColorPalette
                                value={textColor}
                                onChange={(color) => setAttributes({ textColor: color || '#ffffff' })}
                                colors={[
                                    { name: 'أبيض', color: '#ffffff' },
                                    { name: 'رمادي فاتح', color: '#f3f4f6' },
                                    { name: 'أصفر', color: '#fbbf24' }
                                ]}
                            />
                        </div>

                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>لون النص الثانوي</label>
                            <ColorPalette
                                value={secondaryTextColor}
                                onChange={(color) => setAttributes({ secondaryTextColor: color || '#d1d5db' })}
                                colors={[
                                    { name: 'رمادي فاتح', color: '#d1d5db' },
                                    { name: 'رمادي متوسط', color: '#9ca3af' },
                                    { name: 'أبيض', color: '#ffffff' }
                                ]}
                            />
                        </div>
                    </PanelBody>

                    {/* إعدادات عمود الشركة */}
                    {showMainSection && showCompanyColumn && (
                        <PanelBody title="عمود الشركة" initialOpen={false}>
                            {companyLogo && (
                                <div style={{ marginBottom: '10px' }}>
                                    <img src={companyLogo} alt="Company Logo" style={{ maxWidth: '150px', height: 'auto' }} />
                                    <Button
                                        isDestructive
                                        isSmall
                                        onClick={() => setAttributes({ companyLogo: '' })}
                                        style={{ marginTop: '5px' }}
                                    >
                                        حذف اللوجو
                                    </Button>
                                </div>
                            )}
                            <MediaUpload
                                onSelect={(media) => setAttributes({ companyLogo: media.url })}
                                allowedTypes={['image']}
                                render={({ open }) => (
                                    <Button onClick={open} isSecondary style={{ marginBottom: '15px' }}>
                                        {companyLogo ? 'تغيير اللوجو' : 'اختيار لوجو'}
                                    </Button>
                                )}
                            />
                            
                            <TextControl
                                label="عنوان الشركة"
                                value={companyTitle}
                                onChange={(value) => setAttributes({ companyTitle: value })}
                            />
                            <TextControl
                                label="وصف الشركة"
                                value={companyDescription}
                                onChange={(value) => setAttributes({ companyDescription: value })}
                            />
                        </PanelBody>
                    )}

                    {/* إعدادات عمود الاتصال */}
                    {showMainSection && showContactColumn && (
                        <PanelBody title="عمود الاتصال" initialOpen={false}>
                            <TextControl
                                label="عنوان القسم"
                                value={contactTitle}
                                onChange={(value) => setAttributes({ contactTitle: value })}
                            />
                            <TextControl
                                label="العنوان"
                                value={contactAddress}
                                onChange={(value) => setAttributes({ contactAddress: value })}
                            />
                            <TextControl
                                label="رقم الهاتف"
                                value={contactPhone}
                                onChange={(value) => setAttributes({ contactPhone: value })}
                            />
                            <TextControl
                                label="البريد الإلكتروني"
                                value={contactEmail}
                                onChange={(value) => setAttributes({ contactEmail: value })}
                            />
                        </PanelBody>
                    )}

                    {/* إعدادات السوشيال ميديا */}
                    {showMainSection && showSocialColumn && (
                        <PanelBody title="السوشيال ميديا" initialOpen={false}>
                            <TextControl
                                label="عنوان القسم"
                                value={socialTitle}
                                onChange={(value) => setAttributes({ socialTitle: value })}
                            />
                            <TextControl
                                label="رابط فيسبوك"
                                value={facebookUrl}
                                onChange={(value) => setAttributes({ facebookUrl: value })}
                            />
                            <TextControl
                                label="رابط تويتر"
                                value={twitterUrl}
                                onChange={(value) => setAttributes({ twitterUrl: value })}
                            />
                            <TextControl
                                label="رابط إنستجرام"
                                value={instagramUrl}
                                onChange={(value) => setAttributes({ instagramUrl: value })}
                            />
                            <TextControl
                                label="رابط لينكد إن"
                                value={linkedinUrl}
                                onChange={(value) => setAttributes({ linkedinUrl: value })}
                            />
                        </PanelBody>
                    )}

                    {/* إعدادات حقوق النشر */}
                    {showCopyright && (
                        <PanelBody title="حقوق النشر" initialOpen={false}>
                            <TextControl
                                label="نص حقوق النشر"
                                value={copyrightText}
                                onChange={(value) => setAttributes({ copyrightText: value })}
                            />
                        </PanelBody>
                    )}
                </InspectorControls>

                {/* معاينة الفوتر */}
                <footer className="footer-block-preview" style={{ 
                    backgroundColor: backgroundColor,
                    borderTop: `1px solid ${borderColor}`,
                    color: textColor,
                    padding: '48px 0'
                }}>
                    <div className="footer-container">
                        {showMainSection && (
                            <div className="footer-grid">
                                {/* عمود الشركة */}
                                {showCompanyColumn && (
                                    <div className="footer-column">
                                        {companyLogo && (
                                            <img src={companyLogo} alt="Company Logo" className="footer-logo" />
                                        )}
                                        <h3 style={{ color: textColor }}>{companyTitle}</h3>
                                        <p style={{ color: secondaryTextColor }}>{companyDescription}</p>
                                    </div>
                                )}

                                {/* عمود الاتصال */}
                                {showContactColumn && (
                                    <div className="footer-column">
                                        <h4 style={{ color: textColor }}>{contactTitle}</h4>
                                        <div className="contact-info" style={{ color: secondaryTextColor }}>
                                            <div className="contact-item">📍 {contactAddress}</div>
                                            <div className="contact-item">📞 {contactPhone}</div>
                                            <div className="contact-item">✉️ {contactEmail}</div>
                                        </div>
                                    </div>
                                )}

                                {/* عمود السوشيال ميديا */}
                                {showSocialColumn && (
                                    <div className="footer-column">
                                        <h4 style={{ color: textColor }}>{socialTitle}</h4>
                                        <div className="social-buttons">
                                            <span className="social-btn">📘</span>
                                            <span className="social-btn">🐦</span>
                                            <span className="social-btn">📷</span>
                                            <span className="social-btn">💼</span>
                                        </div>
                                    </div>
                                )}
                            </div>
                        )}

                        {showCopyright && (
                            <div className="footer-copyright" style={{ 
                                borderTop: `1px solid ${borderColor}`,
                                color: copyrightTextColor 
                            }}>
                                <p>{copyrightText}</p>
                            </div>
                        )}
                    </div>
                </footer>
            </div>
        );
    },

    save: () => null
});