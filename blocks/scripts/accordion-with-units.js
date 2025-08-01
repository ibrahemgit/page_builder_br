import { registerBlockType } from '@wordpress/blocks';
import { TextControl, Button, IconButton, PanelBody, SelectControl, ToggleControl } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import { Editor } from '@tinymce/tinymce-react';

registerBlockType('custom/accordion-with-units', {
    title: 'أكورديون مع كروت الوحدات',
    icon: 'list-view',
    category: 'custom-Faq',

    attributes: {
        sectionTitle: {
            type: 'string',
            default: 'عنوان القسم'
        },
        accordions: {
            type: 'array',
            default: []
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { sectionTitle, accordions } = attributes;

        const updateAccordion = (index, field, value) => {
            const updated = [...accordions];
            updated[index][field] = value;
            setAttributes({ accordions: updated });
        };

        const updateAccordionUnit = (accordionIndex, unitIndex, field, value) => {
            const updated = [...accordions];
            if (!updated[accordionIndex].units) {
                updated[accordionIndex].units = [];
            }
            updated[accordionIndex].units[unitIndex][field] = value;
            setAttributes({ accordions: updated });
        };

        const addAccordion = () => {
            setAttributes({
                accordions: [
                    ...accordions,
                    {
                        id: Date.now(),
                        title: 'عنوان الأكورديون',
                        content: '',
                        unitsTitle: 'الوحدات المتاحة', // عنوان الوحدات
                        units: []
                    }
                ]
            });
        };

        const removeAccordion = (index) => {
            const updated = accordions.filter((_, i) => i !== index);
            setAttributes({ accordions: updated });
        };

        const addUnitToAccordion = (accordionIndex) => {
            const updated = [...accordions];
            if (!updated[accordionIndex].units) {
                updated[accordionIndex].units = [];
            }
            updated[accordionIndex].units.push({
                title: '',
                icon: '',
                area: '',
                price: '',
                down: ''
            });
            setAttributes({ accordions: updated });
        };

        const removeUnitFromAccordion = (accordionIndex, unitIndex) => {
            const updated = [...accordions];
            updated[accordionIndex].units.splice(unitIndex, 1);
            setAttributes({ accordions: updated });
        };

        return (
            <Fragment>
                <div className="shortcodesection invew">
                    <div className="container">
                        <InspectorControls>
                            <PanelBody title="إعدادات الأكورديون">
                                <Button isPrimary onClick={addAccordion}>+ إضافة أكورديون</Button>
                            </PanelBody>
                        </InspectorControls>

                        <TextControl
                            label="عنوان القسم"
                            value={sectionTitle}
                            onChange={(value) => setAttributes({ sectionTitle: value })}
                        />

                        <div className="accordion-items">
                            {accordions.map((item, index) => (
                                <div key={item.id} className="accordion-item">
                                    <div className="accordion-header">
                                        <TextControl
                                            label={`عنوان الأكورديون ${index + 1}`}
                                            value={item.title}
                                            onChange={(value) => updateAccordion(index, 'title', value)}
                                        />
                                    </div>

                                    {/* المحتوى النصي */}
                                    <div className="accordion-text-content">
                                        <h4>المحتوى النصي</h4>
                                        <Editor
                                            value={item.content}
                                            init={{
                                                height: 200,
                                                menubar: false,
                                                plugins: 'lists link',
                                                directionality: 'rtl',
                                                content_style: 'body { direction: rtl; text-align: right; }',
                                                toolbar: 'formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link | undo redo',
                                                block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4',
                                            }}
                                            onEditorChange={(content) => updateAccordion(index, 'content', content)}
                                        />
                                    </div>

                                    {/* كروت الوحدات */}
                                    <div className="accordion-units-content">
                                        <div className="units-header">
                                            <TextControl
                                                label="عنوان قسم الوحدات"
                                                value={item.unitsTitle || 'الوحدات المتاحة'}
                                                onChange={(value) => updateAccordion(index, 'unitsTitle', value)}
                                                help="عنوان يظهر فوق كروت الوحدات"
                                            />
                                            <Button 
                                                isSecondary 
                                                onClick={() => addUnitToAccordion(index)}
                                                style={{ marginTop: '10px' }}
                                            >
                                                + إضافة وحدة
                                            </Button>
                                        </div>

                                        {(!item.units || item.units.length === 0) && (
                                            <p className="no-units-msg">لم يتم إضافة أي وحدات بعد.</p>
                                        )}

                                        <div className="units-grid">
                                            {item.units && item.units.map((unit, unitIndex) => (
                                                <div key={unitIndex} className="unit-card-editor ">
                                                    <div className="unit-fields">
                                                        <TextControl
                                                            label="عنوان الوحدة"
                                                            value={unit.title}
                                                            onChange={(value) => updateAccordionUnit(index, unitIndex, 'title', value)}
                                                        />
                                                        <TextControl
                                                            label="أيقونة (fa-icon-name)"
                                                            value={unit.icon}
                                                            onChange={(value) => updateAccordionUnit(index, unitIndex, 'icon', value)}
                                                            help="مثال: home، building، key"
                                                        />
                                                        <TextControl
                                                            label="المساحة"
                                                            value={unit.area}
                                                            onChange={(value) => updateAccordionUnit(index, unitIndex, 'area', value)}
                                                        />
                                                        <TextControl
                                                            label="السعر"
                                                            value={unit.price}
                                                            onChange={(value) => updateAccordionUnit(index, unitIndex, 'price', value)}
                                                        />
                                                        <TextControl
                                                            label="المقدم"
                                                            value={unit.down}
                                                            onChange={(value) => updateAccordionUnit(index, unitIndex, 'down', value)}
                                                        />
                                                    </div>

                                                    <div className="unit-preview">
                                                        <span className="preview-label">معاينة:</span>
                                                        <div className="property-preview">
                                                            {unit.icon && (
                                                                <div className="property-icon">
                                                                    <i className={`fa fa-${unit.icon}`}></i>
                                                                </div>
                                                            )}
                                                            {unit.title && (
                                                                <h3 className="property-title">{unit.title}</h3>
                                                            )}
                                                            <div className="propitems">
                                                                {unit.area && (
                                                                    <p className="property-area"><strong>المساحة:</strong> {unit.area} م²</p>
                                                                )}
                                                                {unit.price && (
                                                                    <p className="property-price"><strong>السعر:</strong> {unit.price}</p>
                                                                )}
                                                                {unit.down && (
                                                                    <p className="property-down"><strong>المقدم:</strong> {unit.down}</p>
                                                                )}
                                                            </div>
                                                            <div className="property-cta">احجز الان</div>
                                                        </div>
                                                    </div>

                                                    <IconButton
                                                        icon="no-alt"
                                                        label="حذف الوحدة"
                                                        onClick={() => removeUnitFromAccordion(index, unitIndex)}
                                                        className="remove-unit-btn"
                                                        style={{ marginTop: '10px' }}
                                                    />
                                                </div>
                                            ))}
                                        </div>
                                    </div>

                                    <IconButton
                                        icon="trash"
                                        label="حذف الأكورديون"
                                        onClick={() => removeAccordion(index)}
                                        className="remove-accordion-btn"
                                        style={{ marginTop: '15px', backgroundColor: '#dc3232', color: 'white' }}
                                    />
                                </div>
                            ))}

                            <div className="add-accordion-wrapper">
                                <Button isSecondary onClick={addAccordion}>+ إضافة أكورديون</Button>
                            </div>
                        </div>
                    </div>
                </div>

                <style jsx>{`
                    .accordion-item {
                        border: 2px solid #ddd;
                        padding: 20px;
                        margin-bottom: 20px;
                        border-radius: 8px;
                        background: #f9f9f9;
                    }
                    
                    .accordion-header {
                        margin-bottom: 15px;
                        padding-bottom: 15px;
                        border-bottom: 1px solid #ddd;
                    }
                    
                    .units-header {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        margin-bottom: 15px;
                    }
                    
                    .units-grid {
                        display: grid;
                        gap: 15px;
                    }
                    
                    .unit-card-editor {
                        border: 1px solid #ccc;
                        padding: 15px;
                        border-radius: 5px;
                        background: white;
                    }
                    
                    .unit-fields {
                        margin-bottom: 15px;
                    }
                    
                    .unit-preview {
                        margin-top: 15px;
                        padding-top: 15px;
                        border-top: 1px solid #eee;
                    }
                    
                    .preview-label {
                        font-weight: bold;
                        color: #666;
                        display: block;
                        margin-bottom: 10px;
                    }
                    
                    .property-preview {
                        border: 1px solid #ddd;
                        padding: 15px;
                        border-radius: 5px;
                        background: #f8f8f8;
                        text-align: center;
                    }
                    
                    .property-icon i {
                        font-size: 2em;
                        color: #007cba;
                        margin-bottom: 10px;
                    }
                    
                    .property-title {
                        margin: 10px 0;
                        color: #333;
                    }
                    
                    .propitems p {
                        margin: 5px 0;
                        font-size: 14px;
                    }
                    
                    .property-cta {
                        background: #007cba;
                        color: white;
                        padding: 8px 15px;
                        border-radius: 5px;
                        margin-top: 10px;
                        cursor: pointer;
                        display: inline-block;
                    }
                    
                    .no-units-msg {
                        text-align: center;
                        color: #666;
                        font-style: italic;
                        padding: 20px;
                        background: #f0f0f0;
                        border-radius: 5px;
                    }
                    
                    .add-accordion-wrapper {
                        text-align: center;
                        margin-top: 20px;
                    }
                    
                    .remove-accordion-btn {
                        display: block;
                        margin: 15px auto 0;
                    }
                    
                    .remove-unit-btn {
                        background: #dc3232 !important;
                        color: white !important;
                    }
                `}</style>
            </Fragment>
        );
    },

    save: () => null // سيتم العرض في PHP
});