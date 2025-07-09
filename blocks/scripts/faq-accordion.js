import { registerBlockType } from '@wordpress/blocks';
import { TextControl, Button, IconButton, PanelBody } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import { Editor } from '@tinymce/tinymce-react';

registerBlockType('custom/accordion-section', {
    title: 'قسم الأكورديون',
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

        const addAccordion = () => {
            setAttributes({
                accordions: [
                    ...accordions,
                    {
                        id: Date.now(),
                        title: 'عنوان الأكورديون',
                        content: ''
                    }
                ]
            });
        };

        const removeAccordion = (index) => {
            const updated = accordions.filter((_, i) => i !== index);
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
                                    <TextControl
                                        label={`عنوان ${index + 1}`}
                                        value={item.title}
                                        onChange={(value) => updateAccordion(index, 'title', value)}
                                    />
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
                                    <IconButton
                                        icon="trash"
                                        label="حذف"
                                        onClick={() => removeAccordion(index)}
                                        style={{ marginTop: '10px' }}
                                    />
                                </div>
                            ))}

                            <Button isSecondary onClick={addAccordion}>+ إضافة أكورديون</Button>
                        </div>
                    </div>
                </div>
            </Fragment>
        );
    },

    save: () => null // سيتم العرض في PHP
});
