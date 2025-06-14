import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, PanelColorSettings } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button, IconButton } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

registerBlockType('custom/card-section', {
    title: 'قسم الكروت',
    icon: 'screenoptions',
    category: 'custom-Faq',

    attributes: {
        sectionTitle: {
            type: 'string',
            default: 'عنوان القسم'
        },
        cards: {
            type: 'array',
            default: []
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { cards } = attributes;

        const updateCard = (index, field, value) => {
            const updatedCards = [...cards];
            updatedCards[index][field] = value;
            setAttributes({ cards: updatedCards });
        };

        const addCard = () => {
            setAttributes({
                cards: [
                    ...cards,
                    { title: 'عنوان جديد', content: 'وصف البطاقة', backgroundColor: '#1E2D2F', textColor: '#ffffff' }
                ]
            });
        };

        const removeCard = (index) => {
            const updatedCards = cards.filter((_, i) => i !== index);
            setAttributes({ cards: updatedCards });
        };

        return (
            <Fragment>
                <div style={{ margin: '20px 0' }}></div>

                <InspectorControls>
                    <PanelBody title="إعدادات الكروت">
                        <Button isPrimary onClick={addCard}>
                            + إضافة بطاقة
                        </Button>
                    </PanelBody>
                </InspectorControls>
                
                <TextControl
                    label="عنوان القسم"
                    value={attributes.sectionTitle}
                    onChange={(value) => setAttributes({ sectionTitle: value })}
                />

                <div className="cards-editor">
                    
                    {cards.length > 0 ? (
                        cards.map((card, index) => (
                            <div key={index} className="card-editor" style={{
                                backgroundColor: card.backgroundColor,
                                padding: '20px',
                                borderRadius: '10px',
                                marginBottom: '20px',
                                color: '#fff'
                            }}>
                                <TextControl
                                    label="العنوان"
                                    value={card.title}
                                    onChange={(value) => updateCard(index, 'title', value)}
                                />
                                <TextControl
                                    label="الوصف"
                                    value={card.content}
                                    onChange={(value) => updateCard(index, 'content', value)}
                                />
                                <PanelColorSettings
                                    title="الألوان"
                                    colorSettings={[
                                        {
                                            value: card.backgroundColor,
                                            onChange: (color) => updateCard(index, 'backgroundColor', color),
                                            label: 'لون الخلفية'
                                        },
                                        {
                                            value: card.textColor,
                                            onChange: (color) => updateCard(index, 'textColor', color),
                                            label: 'لون النص'
                                        }
                                    ]}
                                />
                                <IconButton
                                    icon="trash"
                                    label="حذف البطاقة"
                                    onClick={() => removeCard(index)}
                                    style={{ marginTop: '10px' }}
                                />
                            </div>
                        ))
                    ) : (
                        <p>لا توجد بطاقات مضافة.</p>
                    )}
                </div>
                <Button isPrimary onClick={addCard}>+ إضافة بطاقة</Button>
                <div style={{ margin: '20px 0' }}></div>

            </Fragment>
        );
    },

    save: () => null // سيتم العرض عبر render_callback
});
