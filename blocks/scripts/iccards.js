import { registerBlockType } from '@wordpress/blocks';
import { TextControl, Button, IconButton } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

registerBlockType('custom/units-grid', {
    title: 'كروت الوحدات',
    icon: 'building',
    category: 'custom-CTA',

    attributes: {
        sectionTitle: {
            type: 'string',
            default: ''
        },
        units: {
            type: 'array',
            default: []
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { units, sectionTitle } = attributes;

        const updateUnit = (value, index, field) => {
            const newUnits = [...units];
            newUnits[index][field] = value;
            setAttributes({ units: newUnits });
        };

        const addUnit = () => {
            const newUnits = [...units];
            newUnits.push({
                title: '',
                icon: '',
                area: '',
                price: '',
                down: '',
                extra1: '', // خانة إضافية 1
                extra2: ''  // خانة إضافية 2
            });
            setAttributes({ units: newUnits });
        };


        const removeUnit = (index) => {
            const newUnits = [...units];
            newUnits.splice(index, 1);
            setAttributes({ units: newUnits });
        };

        return (
            <Fragment>
                <div className="shortcodesection">
                    <div className="container">

                        {/* ===== عنوان القسم ===== */}
                        <TextControl
                            label="عنوان القسم"
                            value={sectionTitle}
                            onChange={(value) => setAttributes({ sectionTitle: value })}
                            className="section-title-control"
                        />

                        {sectionTitle && (
                            <div className="headline sm_title shorttitle">
                                <span>{sectionTitle}</span>
                            </div>
                        )}

                        {units.length === 0 && (
                            <p className="no-units-msg">لم يتم إضافة أي وحدات بعد.</p>
                        )}

                        <div className="property-grid invew">
                            {units.map((unit, index) => (
                                <div key={index} className="property-card">
                                    <TextControl
                                        label="عنوان الوحدة"
                                        value={unit.title}
                                        onChange={(value) => updateUnit(value, index, 'title')}
                                    />
                                    <TextControl
                                        label="أيقونة"
                                        value={unit.icon}
                                        onChange={(value) => updateUnit(value, index, 'icon')}
                                    />
                                    <TextControl
                                        label="المساحة "
                                        value={unit.area}
                                        onChange={(value) => updateUnit(value, index, 'area')}
                                    />
                                    <TextControl
                                        label="السعر"
                                        value={unit.price}
                                        onChange={(value) => updateUnit(value, index, 'price')}
                                    />
                                    <TextControl
                                        label="المقدم "
                                        value={unit.down}
                                        onChange={(value) => updateUnit(value, index, 'down')}
                                    />
                                    <TextControl
                                        value={unit.extra1}
                                        onChange={(value) => updateUnit(value, index, 'extra1')}
                                    />
                                    <TextControl
                                        value={unit.extra2}
                                        onChange={(value) => updateUnit(value, index, 'extra2')}
                                    />
                                    <span className='moana'>معاينة</span>
                                    <div className="property-preview">
                                        {unit.icon && (
                                            <div className="property-icon">
                                                <i className={`fa fa-${unit.icon}`}></i>
                                            </div>
                                        )}
                                        {unit.title && (
                                            <h3 className="property-title">{unit.title}</h3>
                                        )}
                                        <div className='propitems'>
                                            {unit.area && (
                                                <p className="property-area"><strong>المساحة:</strong> {unit.area} م²</p>
                                            )}
                                            {unit.price && (
                                                <p className="property-price"><strong>السعر:</strong> {unit.price}</p>
                                            )}
                                            {unit.down && (
                                                <p className="property-down"><strong>المقدم:</strong> {unit.down}</p>
                                            )}
                                            {unit.extra1 && (
                                                <p className="property-extra1">{unit.extra1}</p>
                                            )}
                                            {unit.extra2 && (
                                                <p className="property-extra2">{unit.extra2}</p>
                                            )}
                                        </div>
                                        <div className="property-cta">احجز الان</div>
                                    </div>

                                    <IconButton
                                        icon="no-alt"
                                        label="حذف"
                                        onClick={() => removeUnit(index)}
                                        className="remove-btn"
                                    />
                                </div>
                            ))}
                        </div>

                        <div className="add-unit-wrapper">
                            <Button isPrimary onClick={addUnit}>إضافة وحدة</Button>
                        </div>
                    </div>
                </div>
            </Fragment>
        );
    },

    save: () => null
});
