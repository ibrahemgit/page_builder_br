import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, ColorPalette } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button, ToggleControl, SelectControl } from '@wordpress/components';

registerBlockType('custom/advanced-form-block', {
    title: 'Advanced Form Block',
    icon: 'email-alt',
    category: 'custom-CTA',

    attributes: {
        // محتوى الفورم
        formTitle: { type: 'string', default: 'عنوان بوكس الفورم' },
        formSubtitle: { type: 'string', default: 'صب تايتل للفورم' },
        submitButtonText: { type: 'string', default: 'سجل الان' },

        // إعدادات العرض
        showNameField: { type: 'boolean', default: true },
        showPhoneField: { type: 'boolean', default: true },
        showUnitTypeField: { type: 'boolean', default: true },
        showPriceField: { type: 'boolean', default: true },
        showTimeField: { type: 'boolean', default: true },

        // حقول النص
        nameLabel: { type: 'string', default: 'الاسم' },
        namePlaceholder: { type: 'string', default: 'الاسم بالكامل' },
        phoneLabel: { type: 'string', default: 'رقم الهاتف' },
        phonePlaceholder: { type: 'string', default: 'رقم الهاتف' },
        unitTypeLabel: { type: 'string', default: 'نوع الوحدة' },
        priceLabel: { type: 'string', default: 'السعر (EGP)' },
        pricePlaceholder: { type: 'string', default: 'ادخل السعر (min. 10,000,000)' },
        priceMinText: { type: 'string', default: 'اقل سعر 10,000,000 EGP' },
        timeLabel: { type: 'string', default: 'الوقت المفضل للتواصل' },

        // حقل الوظيفة
showJobField: { type: 'boolean', default: true }, // NEW
jobLabel: { type: 'string', default: 'الوظيفة' }, // NEW
jobPlaceholder: { type: 'string', default: 'المسمى الوظيفي' }, // NEW


        // خيارات السيليكت
        unitTypeOptions: { 
            type: 'array', 
            default: [
                { label: 'اختر نوع الوحدة', value: '' },
                { label: 'ستديو', value: 'studio' },
                { label: 'غرفه', value: '1bedroom' },
                { label: 'غرفتين', value: '2bedroom' },
                { label: 'ثلاث غرف', value: '3bedroom' },
                { label: 'بنت هاوس', value: 'penthouse' }
            ]
        },
        timeOptions: {
            type: 'array',
            default: [
                { label: 'اختر الوقت المفضل للتواصل', value: '' },
                { label: 'في الصباح (9 AM - 12 PM)', value: 'morning' },
                { label: 'بعد الظهر (12 PM - 6 PM)', value: 'afternoon' },
                { label: 'في الليل (6 PM - 9 PM)', value: 'evening' },
                { label: 'اي وقت', value: 'anytime' }
            ]
        },


        // حقل المنطقة
        showAreaField: { type: 'boolean', default: true },
        areaLabel: { type: 'string', default: 'المنطقة' },
        areaOptions: {
            type: 'array',
            default: [
                { label: 'اختر المنطقة', value: '' },
                { label: 'القاهرة الجديدة', value: 'new-cairo' },
                { label: '6 أكتوبر', value: '6october' },
                { label: 'الشيخ زايد', value: 'sheikh-zayed' },
                { label: 'العين السخنة', value: 'sokhna' },
                { label: 'العاصمة الإدارية', value: 'new-capital' },
            ]
        },

        // ألوان القسم
        sectionBgColor: { type: 'string', default: '#000' },
        sectionTextColor: { type: 'string', default: '#ffffff' },

        // ألوان الفورم
        formBgColor: { type: 'string', default: '#13171f' },
        formBorderColor: { type: 'string', default: '#4a5568' },
        formTextColor: { type: 'string', default: '#ffffff' },
        
        // ألوان الحقول
        fieldBgColor: { type: 'string', default: '#000' },
        fieldTextColor: { type: 'string', default: '#ffffff' },
        fieldBorderColor: { type: 'string', default: '#4a5568' },
        placeholderColor: { type: 'string', default: '#a0aec0' },

        // ألوان الزر
        buttonBgColor: { type: 'string', default: '#007cba' },
        buttonTextColor: { type: 'string', default: '#fff' },
    },

    edit: ({ attributes, setAttributes }) => {
        const {
            formTitle, formSubtitle, submitButtonText,
            showJobField, jobLabel, jobPlaceholder,
            showNameField, showPhoneField, showUnitTypeField, showPriceField, showTimeField,showAreaField,areaLabel,areaOptions,
            nameLabel, namePlaceholder, phoneLabel, phonePlaceholder, 
            unitTypeLabel, priceLabel, pricePlaceholder, priceMinText, timeLabel,
            unitTypeOptions, timeOptions,
            sectionBgColor, sectionTextColor,
            formBgColor, formBorderColor, formTextColor,
            fieldBgColor, fieldTextColor, fieldBorderColor, placeholderColor,
            buttonBgColor, buttonTextColor,
        } = attributes;

        // إضافة خيار جديد للسيليكت
        const addSelectOption = (field) => {
            const newOptions = [...attributes[field], { label: 'New Option', value: 'new_option' }];
            setAttributes({ [field]: newOptions });
        };

        // حذف خيار من السيليكت
        const removeSelectOption = (field, index) => {
            const newOptions = attributes[field].filter((_, i) => i !== index);
            setAttributes({ [field]: newOptions });
        };

        // تحديث خيار في السيليكت
        const updateSelectOption = (field, index, key, value) => {
            const newOptions = [...attributes[field]];
            newOptions[index][key] = value;
            setAttributes({ [field]: newOptions });
        };

        return (
            <div className="advanced-form-editor">
                <InspectorControls>
                    
                    {/* محتوى الفورم */}
                    <PanelBody title="محتوى الفورم" initialOpen={true}>
                        <TextControl
                            label="عنوان الفورم"
                            value={formTitle}
                            onChange={(value) => setAttributes({ formTitle: value })}
                        />
                        <TextControl
                            label="العنوان الفرعي"
                            value={formSubtitle}
                            onChange={(value) => setAttributes({ formSubtitle: value })}
                        />
                        <TextControl
                            label="نص زر الإرسال"
                            value={submitButtonText}
                            onChange={(value) => setAttributes({ submitButtonText: value })}
                        />
                    </PanelBody>

                    {/* إعدادات العرض */}
                    <PanelBody title="إعدادات العرض" initialOpen={false}>
                        <ToggleControl
                            label="إظهار حقل الاسم"
                            checked={showNameField}
                            onChange={(value) => setAttributes({ showNameField: value })}
                        />
                        <ToggleControl
                            label="إظهار حقل الهاتف"
                            checked={showPhoneField}
                            onChange={(value) => setAttributes({ showPhoneField: value })}
                        />
                        <ToggleControl
                            label="إظهار حقل نوع الوحدة"
                            checked={showUnitTypeField}
                            onChange={(value) => setAttributes({ showUnitTypeField: value })}
                        />
                        <ToggleControl
                            label="إظهار حقل السعر"
                            checked={showPriceField}
                            onChange={(value) => setAttributes({ showPriceField: value })}
                        />
                        <ToggleControl
                            label="إظهار حقل وقت الاتصال"
                            checked={showTimeField}
                            onChange={(value) => setAttributes({ showTimeField: value })}
                        />

                        <ToggleControl
                            label="إظهار حقل المنطقة"
                            checked={showAreaField}
                            onChange={(value) => setAttributes({ showAreaField: value })}
                        />

<ToggleControl
  label="إظهار حقل الوظيفة"
  checked={showJobField}
  onChange={(value) => setAttributes({ showJobField: value })}
/>  {/* NEW */}


                    </PanelBody>

                    {/* إعدادات حقل الاسم */}
                    {showNameField && (
                        <PanelBody title="إعدادات حقل الاسم" initialOpen={false}>
                            <TextControl
                                label="تسمية الحقل"
                                value={nameLabel}
                                onChange={(value) => setAttributes({ nameLabel: value })}
                            />
                            <TextControl
                                label="النص الافتراضي"
                                value={namePlaceholder}
                                onChange={(value) => setAttributes({ namePlaceholder: value })}
                            />
                        </PanelBody>
                    )}

                    {/* إعدادات حقل الهاتف */}
                    {showPhoneField && (
                        <PanelBody title="إعدادات حقل الهاتف" initialOpen={false}>
                            <TextControl
                                label="تسمية الحقل"
                                value={phoneLabel}
                                onChange={(value) => setAttributes({ phoneLabel: value })}
                            />
                            <TextControl
                                label="النص الافتراضي"
                                value={phonePlaceholder}
                                onChange={(value) => setAttributes({ phonePlaceholder: value })}
                            />
                        </PanelBody>
                    )}

                    {/* إعدادات حقل نوع الوحدة */}
                    {showUnitTypeField && (
                        <PanelBody title="إعدادات نوع الوحدة" initialOpen={false}>
                            <TextControl
                                label="تسمية الحقل"
                                value={unitTypeLabel}
                                onChange={(value) => setAttributes({ unitTypeLabel: value })}
                            />
                            <h4>خيارات نوع الوحدة:</h4>
                            {unitTypeOptions.map((option, index) => (
                                <div key={index} style={{ border: '1px solid #ddd', padding: '10px', marginBottom: '10px', borderRadius: '4px' }}>
                                    <TextControl
                                        label={`النص المعروض ${index + 1}`}
                                        value={option.label}
                                        onChange={(value) => updateSelectOption('unitTypeOptions', index, 'label', value)}
                                    />
                                    <TextControl
                                        label={`القيمة ${index + 1}`}
                                        value={option.value}
                                        onChange={(value) => updateSelectOption('unitTypeOptions', index, 'value', value)}
                                    />
                                    <Button
                                        isDestructive
                                        isSmall
                                        onClick={() => removeSelectOption('unitTypeOptions', index)}
                                    >
                                        حذف الخيار
                                    </Button>
                                </div>
                            ))}
                            <Button
                                isSecondary
                                onClick={() => addSelectOption('unitTypeOptions')}
                            >
                                إضافة خيار جديد
                            </Button>
                        </PanelBody>
                    )}

                    {/* إعدادات حقل السعر */}
                    {showPriceField && (
                        <PanelBody title="إعدادات حقل السعر" initialOpen={false}>
                            <TextControl
                                label="تسمية الحقل"
                                value={priceLabel}
                                onChange={(value) => setAttributes({ priceLabel: value })}
                            />
                            <TextControl
                                label="النص الافتراضي"
                                value={pricePlaceholder}
                                onChange={(value) => setAttributes({ pricePlaceholder: value })}
                            />
                            <TextControl
                                label="نص الحد الأدنى"
                                value={priceMinText}
                                onChange={(value) => setAttributes({ priceMinText: value })}
                            />
                        </PanelBody>
                    )}

                    {/* إعدادات حقل وقت الاتصال */}
                    {showTimeField && (
                        <PanelBody title="إعدادات وقت الاتصال" initialOpen={false}>
                            <TextControl
                                label="تسمية الحقل"
                                value={timeLabel}
                                onChange={(value) => setAttributes({ timeLabel: value })}
                            />
                            <h4>خيارات وقت الاتصال:</h4>
                            {timeOptions.map((option, index) => (
                                <div key={index} style={{ border: '1px solid #ddd', padding: '10px', marginBottom: '10px', borderRadius: '4px' }}>
                                    <TextControl
                                        label={`النص المعروض ${index + 1}`}
                                        value={option.label}
                                        onChange={(value) => updateSelectOption('timeOptions', index, 'label', value)}
                                    />
                                    <TextControl
                                        label={`القيمة ${index + 1}`}
                                        value={option.value}
                                        onChange={(value) => updateSelectOption('timeOptions', index, 'value', value)}
                                    />
                                    <Button
                                        isDestructive
                                        isSmall
                                        onClick={() => removeSelectOption('timeOptions', index)}
                                    >
                                        حذف الخيار
                                    </Button>
                                </div>
                            ))}
                            <Button
                                isSecondary
                                onClick={() => addSelectOption('timeOptions')}
                            >
                                إضافة خيار جديد
                            </Button>
                        </PanelBody>
                    )}


{showAreaField && (
    <PanelBody title="إعدادات حقل المنطقة" initialOpen={false}>
        <TextControl
            label="تسمية الحقل"
            value={areaLabel}
            onChange={(value) => setAttributes({ areaLabel: value })}
        />
        <h4>خيارات المنطقة:</h4>
        {areaOptions.map((option, index) => (
            <div key={index} style={{ border: '1px solid #ddd', padding: '10px', marginBottom: '10px', borderRadius: '4px' }}>
                <TextControl
                    label={`النص المعروض ${index + 1}`}
                    value={option.label}
                    onChange={(value) => updateSelectOption('areaOptions', index, 'label', value)}
                />
                <TextControl
                    label={`القيمة ${index + 1}`}
                    value={option.value}
                    onChange={(value) => updateSelectOption('areaOptions', index, 'value', value)}
                />
                <Button
                    isDestructive
                    isSmall
                    onClick={() => removeSelectOption('areaOptions', index)}
                >
                    حذف الخيار
                </Button>
            </div>
        ))}
        <Button
            isSecondary
            onClick={() => addSelectOption('areaOptions')}
        >
            إضافة خيار جديد
        </Button>
    </PanelBody>
)}


{showJobField && (
  <PanelBody title="إعدادات حقل الوظيفة" initialOpen={false}> {/* NEW */}
    <TextControl
      label="تسمية الحقل"
      value={jobLabel}
      onChange={(value) => setAttributes({ jobLabel: value })}
    />
    <TextControl
      label="النص الافتراضي"
      value={jobPlaceholder}
      onChange={(value) => setAttributes({ jobPlaceholder: value })}
    />
  </PanelBody>
)}


                    {/* ألوان القسم */}
                    <PanelBody title="ألوان القسم" initialOpen={false}>
                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>لون خلفية القسم</label>
                            <ColorPalette
                                value={sectionBgColor}
                                onChange={(color) => setAttributes({ sectionBgColor: color || '#000' })}
                                colors={[
                                    { name: 'أسود', color: '#000000' },
                                    { name: 'رمادي غامق', color: '#1a202c' },
                                    { name: 'أزرق غامق', color: '#1e3a8a' },
                                    { name: 'أخضر غامق', color: '#166534' },
                                    { name: 'بنفسجي غامق', color: '#581c87' }
                                ]}
                            />
                        </div>
                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>لون نص القسم</label>
                            <ColorPalette
                                value={sectionTextColor}
                                onChange={(color) => setAttributes({ sectionTextColor: color || '#ffffff' })}
                                colors={[
                                    { name: 'أبيض', color: '#ffffff' },
                                    { name: 'رمادي فاتح', color: '#f7fafc' },
                                    { name: 'أصفر', color: '#f6e05e' }
                                ]}
                            />
                        </div>
                    </PanelBody>

                    {/* ألوان الفورم */}
                    <PanelBody title="ألوان صندوق الفورم" initialOpen={false}>
                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>لون خلفية الفورم</label>
                            <ColorPalette
                                value={formBgColor}
                                onChange={(color) => setAttributes({ formBgColor: color || '#13171f' })}
                                colors={[
                                    { name: 'رمادي متوسط', color: '#13171f' },
                                    { name: 'أسود', color: '#000000' },
                                    { name: 'أبيض', color: '#ffffff' },
                                    { name: 'أزرق فاتح', color: '#ebf8ff' }
                                ]}
                            />
                        </div>
                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>لون حدود الفورم</label>
                            <ColorPalette
                                value={formBorderColor}
                                onChange={(color) => setAttributes({ formBorderColor: color || '#4a5568' })}
                                colors={[
                                    { name: 'رمادي', color: '#4a5568' },
                                    { name: 'أبيض', color: '#ffffff' },
                                    { name: 'أزرق', color: '#3182ce' }
                                ]}
                            />
                        </div>
                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>لون نص الفورم</label>
                            <ColorPalette
                                value={formTextColor}
                                onChange={(color) => setAttributes({ formTextColor: color || '#ffffff' })}
                                colors={[
                                    { name: 'أبيض', color: '#ffffff' },
                                    { name: 'أسود', color: '#000000' },
                                    { name: 'رمادي غامق', color: '#13171f' }
                                ]}
                            />
                        </div>
                    </PanelBody>

                    {/* ألوان الحقول */}
                    <PanelBody title="ألوان الحقول" initialOpen={false}>
                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>لون خلفية الحقول</label>
                            <ColorPalette
                                value={fieldBgColor}
                                onChange={(color) => setAttributes({ fieldBgColor: color || '#000' })}
                                colors={[
                                    { name: 'رمادي غامق', color: '#1a202c' },
                                    { name: 'أسود', color: '#000000' },
                                    { name: 'أبيض', color: '#ffffff' },
                                    { name: 'رمادي فاتح', color: '#f7fafc' }
                                ]}
                            />
                        </div>
                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>لون نص الحقول</label>
                            <ColorPalette
                                value={fieldTextColor}
                                onChange={(color) => setAttributes({ fieldTextColor: color || '#ffffff' })}
                                colors={[
                                    { name: 'أبيض', color: '#ffffff' },
                                    { name: 'أسود', color: '#000000' },
                                    { name: 'رمادي غامق', color: '#13171f' }
                                ]}
                            />
                        </div>
                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>لون حدود الحقول</label>
                            <ColorPalette
                                value={fieldBorderColor}
                                onChange={(color) => setAttributes({ fieldBorderColor: color || '#4a5568' })}
                                colors={[
                                    { name: 'رمادي', color: '#4a5568' },
                                    { name: 'أبيض', color: '#ffffff' },
                                    { name: 'أزرق', color: '#3182ce' }
                                ]}
                            />
                        </div>
                    </PanelBody>

                    {/* ألوان الزر */}
                    <PanelBody title="ألوان زر الإرسال" initialOpen={false}>
                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>لون خلفية الزر</label>
                            <ColorPalette
                                value={buttonBgColor}
                                onChange={(color) => setAttributes({ buttonBgColor: color || '#007cba' })}
                                colors={[
                                    { name: 'أصفر', color: '#d69e2e' },
                                    { name: 'أخضر', color: '#48bb78' },
                                    { name: 'أزرق', color: '#007cba' },
                                    { name: 'أحمر', color: '#f56565' },
                                    { name: 'بنفسجي', color: '#9f7aea' }
                                ]}
                            />
                        </div>
                        <div style={{ marginBottom: '15px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>لون نص الزر</label>
                            <ColorPalette
                                value={buttonTextColor}
                                onChange={(color) => setAttributes({ buttonTextColor: color || '#fff' })}
                                colors={[
                                    { name: 'أسود', color: '#1a202c' },
                                    { name: 'أبيض', color: '#ffffff' },
                                    { name: 'رمادي غامق', color: '#13171f' }
                                ]}
                            />
                        </div>

                    </PanelBody>

                </InspectorControls>

                {/* معاينة الفورم */}
                
                <div className="advanced-form-wrapper" style={{ 
                        backgroundColor: sectionBgColor,
                        color: sectionTextColor,
                    }}>
                    <div className="form-container" >
                        <div className="form-wrapper" >
                            <div className="form-card" style={{
                                backgroundColor: formBgColor,
                                border: `1px solid ${formBorderColor}`,
                            }}>
                                <div className="form-header" style={{
                                    borderBottom: `1px solid ${formBorderColor}`
                                }}>
                                    <h2 className="pjc-title" style={{ 
                                        color: formTextColor 
                                    }}>
                                        {formTitle}
                                    </h2>
                                    <p className="pjc-subtitle" style={{ 
                                        color: formTextColor 
                                    }}>
                                        {formSubtitle}
                                    </p>
                                </div>

                                <div className="form-content" >
                                    <form className="registration-form" >
                                        
                                        {/* الصف الأول */}
                                        {(showNameField || showPhoneField) && (
                                            <div className="form-row" >
                                                {showNameField && (
                                                    <div className="form-field">
                                                        <label className="field-label" style={{ color: formTextColor,}}>
                                                            {nameLabel}
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            placeholder={namePlaceholder}
                                                            className="field-input"
                                                            style={{
                                                                backgroundColor: fieldBgColor,
                                                                border: `1px solid ${fieldBorderColor}`,
                                                                color: fieldTextColor,
                                                            }}
                                                        />
                                                    </div>
                                                )}

                                                {showPhoneField && (
                                                    <div className="form-field">
                                                        <label className="field-label" style={{ color: formTextColor, }}>
                                                            {phoneLabel}
                                                        </label>
                                                        <input 
                                                            type="tel" 
                                                            placeholder={phonePlaceholder}
                                                            className="field-input"
                                                            style={{
                                                                backgroundColor: fieldBgColor,
                                                                border: `1px solid ${fieldBorderColor}`,
                                                                color: fieldTextColor,
                                                            }}
                                                        />
                                                    </div>
                                                )}
                                            </div>
                                        )}

                                        {/* الصف الثاني */}
                                        {(showUnitTypeField || showPriceField) && (
                                            <div className="form-row" >
                                                {showUnitTypeField && (
                                                    <div className="form-field">
                                                        <label className="field-label" style={{ color: formTextColor, }}>
                                                            {unitTypeLabel}
                                                        </label>
                                                        {unitTypeOptions && unitTypeOptions.length > 0 ? (
                                                            <select 
                                                                className="field-select" 
                                                                defaultValue=""
                                                                style={{
                                                                    backgroundColor: fieldBgColor,
                                                                    border: `1px solid ${fieldBorderColor}`,
                                                                    color: fieldTextColor,
                                                                }}
                                                            >
                                                                {unitTypeOptions.map((option, index) => {
                                                                    // التحقق من وجود value فارغ أو undefined
                                                                    const isEmpty = !option.value || option.value === '';
                                                                    
                                                                    if (isEmpty) {
                                                                        return (
                                                                            <option 
                                                                                key={index} 
                                                                                value="" 
                                                                                disabled 
                                                                                style={{ display: 'none' }}
                                                                            >
                                                                                {option.label}
                                                                            </option>
                                                                        );
                                                                    }
                                                                    return (
                                                                        <option key={index} value={option.value}>
                                                                            {option.label}
                                                                        </option>
                                                                    );
                                                                })}
                                                            </select>
                                                        ) : (
                                                            <div style={{
                                                                backgroundColor: fieldBgColor,
                                                                border: `1px solid ${fieldBorderColor}`,
                                                                color: fieldTextColor,
                                                            }}>
                                                                لا توجد خيارات متاحة - أضف خيارات من الإعدادات
                                                            </div>
                                                        )}
                                                    </div>
                                                )}

                                                {showPriceField && (
                                                    <div className="form-field">
                                                        <label className="field-label" style={{ 
                                                            color: formTextColor, 
                                                        }}>
                                                            {priceLabel}
                                                        </label>
                                                        <div className="price-field">
                                                            <input 
                                                                type="text" 
                                                                placeholder={pricePlaceholder}
                                                                className="field-input"
                                                                style={{
                                                                    backgroundColor: fieldBgColor,
                                                                    border: `1px solid ${fieldBorderColor}`,
                                                                    color: fieldTextColor,
                                                                }}
                                                            />
                                                            <small className="price-helper" style={{ color: formTextColor, }}>
                                                                {priceMinText}
                                                            </small>
                                                        </div>
                                                    </div>
                                                )}
                                            </div>
                                        )}

                                        {/* حقل وقت الاتصال */}
                                        {showTimeField && (
                                            <div className="form-field">
                                                <label className="field-label" style={{ 
                                                    color: formTextColor, 
                                                }}>
                                                    {timeLabel}
                                                </label>
                                                {timeOptions && timeOptions.length > 0 ? (
                                                    <select 
                                                        className="field-select" 
                                                        defaultValue=""
                                                        style={{
                                                            backgroundColor: fieldBgColor,
                                                            border: `1px solid ${fieldBorderColor}`,
                                                            color: fieldTextColor,
                                                        }}
                                                    >
                                                        {timeOptions.map((option, index) => {
                                                            // التحقق من وجود value فارغ أو undefined
                                                            const isEmpty = !option.value || option.value === '';
                                                            
                                                            if (isEmpty) {
                                                                return (
                                                                    <option 
                                                                        key={index} 
                                                                        value="" 
                                                                        disabled 
                                                                        style={{ display: 'none' }}
                                                                    >
                                                                        {option.label}
                                                                    </option>
                                                                );
                                                            }
                                                            return (
                                                                <option key={index} value={option.value}>
                                                                    {option.label}
                                                                </option>
                                                            );
                                                        })}
                                                    </select>
                                                ) : (
                                                    <div style={{
                                                        backgroundColor: fieldBgColor,
                                                        border: `1px solid ${fieldBorderColor}`,
                                                        color: fieldTextColor,
                                                    }}>
                                                        لا توجد خيارات متاحة - أضف خيارات من الإعدادات
                                                    </div>
                                                )}
                                            </div>
                                        )}

{showAreaField && (
    <div className="form-field">
        <label className="field-label" style={{ 
            color: formTextColor, 
        }}>
            {areaLabel}
        </label>
        {areaOptions && areaOptions.length > 0 ? (
            <select 
                className="field-select" 
                defaultValue=""
                style={{
                    backgroundColor: fieldBgColor,
                    border: `1px solid ${fieldBorderColor}`,
                    color: fieldTextColor,
                }}
            >
                {areaOptions.map((option, index) => {
                    const isEmpty = !option.value || option.value === '';
                    if (isEmpty) {
                        return (
                            <option 
                                key={index} 
                                value="" 
                                disabled 
                                style={{ display: 'none' }}
                            >
                                {option.label}
                            </option>
                        );
                    }
                    return (
                        <option key={index} value={option.value}>
                            {option.label}
                        </option>
                    );
                })}
            </select>
        ) : (
            <div style={{
                backgroundColor: fieldBgColor,
                border: `1px solid ${fieldBorderColor}`,
                color: fieldTextColor,
            }}>
                لا توجد خيارات متاحة - أضف خيارات من الإعدادات
            </div>
        )}
    </div>
)}

{/* الصف الخاص بالوظيفة */} {/* NEW */}
{showJobField && (
  <div className="form-row">
    <div className="form-field">
      <label className="field-label" style={{ color: formTextColor }}>
        {jobLabel}
      </label>
      <input
        type="text"
        placeholder={jobPlaceholder}
        className="field-input"
        style={{
          backgroundColor: fieldBgColor,
          border: `1px solid ${fieldBorderColor}`,
          color: fieldTextColor,
        }}
      />
    </div>
  </div>
)}



                                        {/* زر الإرسال */}
                                        <span 
                                            // type="submit" 
                                            className="submit-button"
                                            style={{
                                                backgroundColor: buttonBgColor,
                                                color: buttonTextColor,
                                                border: `2px solid ${buttonBgColor}`,
                                            }}
                                        >
                                            {submitButtonText}
                                        </span>
                                    </form>
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