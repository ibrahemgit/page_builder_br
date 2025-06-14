import { registerBlockType } from '@wordpress/blocks';
import { TextControl, Button, IconButton, PanelBody } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import { Editor } from '@tinymce/tinymce-react'; // ✅ هذا هو المحرر الرسمي

registerBlockType('custom/faq-accordion', {
    title: 'FAQ Accordion',
    icon: 'editor-help',
    category: 'custom-Faq',

    attributes: {
        widgetTitle: {
            type: 'string',
            default: 'الأسئلة الشائعة'
        },
        items: {
            type: 'array',
            default: []
        }
    },


    edit: ({ attributes, setAttributes }) => {
        const { items } = attributes;

        const updateItem = (index, field, value) => {
            const updatedItems = [...items];
            updatedItems[index][field] = value;
            setAttributes({ items: updatedItems });
        };

        const addItem = () => {
            setAttributes({
                items: [
                    ...items,
                    {
                        id: Date.now(),
                        title: 'عنوان السؤال',
                        content: ''
                    }
                ]
            });
        };

        const removeItem = (index) => {
            const updated = items.filter((_, i) => i !== index);
            setAttributes({ items: updated });
        };

        return (
            <Fragment>
                <div style={{ margin: '20px 0' }}></div>

                <InspectorControls>
                    <PanelBody title="إعدادات الأسئلة">
                        <Button isPrimary onClick={addItem}>+ إضافة سؤال</Button>
                    </PanelBody>
                </InspectorControls>

                <TextControl
                    label="عنوان الويدجت"
                    value={attributes.widgetTitle}
                    onChange={(value) => setAttributes({ widgetTitle: value })}
                />

                <div className="faq-editor">
                    {items.map((item, index) => (
                        <div key={item.id} style={{ border: '1px solid #ccc', padding: '15px', marginBottom: '20px' }}>
                            <TextControl
                                label={`عنوان السؤال ${index + 1}`}
                                value={item.title}
                                onChange={(value) => updateItem(index, 'title', value)}
                            />
                            <Editor
                                value={item.content}
                                init={{
                                    height: 200,
                                    menubar: false,
                                    plugins: 'lists link',
                                    directionality: 'rtl', // ✅ تفعيل RTL افتراضيًا
                                    content_style: 'body { direction: rtl; text-align: right; }', // ✅ تنسيق المحتوى داخل المحرر
                                    toolbar: 'formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link | undo redo ',
                                    block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4',
                                }}
                                onEditorChange={(content) => updateItem(index, 'content', content)}
                            />
                            <IconButton
                                icon="trash"
                                label="حذف"
                                onClick={() => removeItem(index)}
                                style={{ marginTop: '10px' }}
                            />
                        </div>
                    ))}

                    <Button isSecondary onClick={addItem}>+ إضافة سؤال</Button>
                </div>
                <div style={{ margin: '20px 0' }}></div>

            </Fragment>
        );
    },

    save: () => null
});
