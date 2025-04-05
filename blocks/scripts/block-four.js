import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button, ToggleControl } from '@wordpress/components';
import { useEffect, useRef } from '@wordpress/element';

registerBlockType('custom/project-content-block', {
    title: 'محتوى المشروع',
    icon: 'editor-alignleft',
    category: 'custom-blocks',

    attributes: {
        sectionTitle: { type: 'string', default: 'عنوان القسم' },
        content: { type: 'string', default: '' },
        imageUrl: { type: 'string', default: '' },
        reverseImage: { type: 'boolean', default: false }
    },

    example: {
        attributes: {
            sectionTitle: 'عنوان المعاينة',
            content: '<ul><li>مثال 1</li><li>مثال 2</li><li>مثال 3</li></ul>',
            imageUrl: 'https://via.placeholder.com/500',
            reverseImage: false
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { sectionTitle, content, imageUrl, reverseImage } = attributes;
        const blockProps = useBlockProps();
        const editorId = `custom-editor-${Math.random().toString(36).substr(2, 9)}`;
        const editorRef = useRef(null);

        useEffect(() => {
            if (window.tinymce) {
                window.tinymce.remove(`#${editorId}`); // ❌ إزالة أي محرر سابق لمنع التكرار
                
                setTimeout(() => {
                    window.tinymce.init({
                        selector: `#${editorId}`, // ✅ تعيين محرر خاص بكل بلوك
                        menubar: false,
                        plugins: 'lists', // ❌ إزالة code, preview
                        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link',
                        setup: (editor) => {
                            editorRef.current = editor;
                            editor.on('init', () => {
                                editor.setContent(content); // ✅ تحميل المحتوى الحالي داخل المحرر عند التهيئة
                            });
                            editor.on('change keyup paste', () => {
                                setAttributes({ content: editor.getContent() });
                            });
                        }
                    });
                }, 300); // ⏳ تأخير التهيئة لضمان تحميل القائمة الجانبية بالكامل
            }
        }, [editorId]); // ✅ التأكد من تحميل المحرر عند تغيير البلوك

        return (
            <div {...blockProps} className={`project_content ${reverseImage ? 'reversimg' : ''}`}>
                {/* القائمة الجانبية */}
                <InspectorControls>
                    <PanelBody title="إعدادات القسم">
                        <TextControl
                            label="عنوان القسم"
                            value={sectionTitle}
                            onChange={(value) => setAttributes({ sectionTitle: value })}
                        />
                        <MediaUpload
                            onSelect={(media) => setAttributes({ imageUrl: media.url })}
                            allowedTypes={['image']}
                            render={({ open }) => (
                                <Button onClick={open} isPrimary>{imageUrl ? 'تغيير الصورة' : 'رفع صورة'}</Button>
                            )}
                        />
                        {imageUrl && (
                            <div style={{ marginTop: '10px' }}>
                                <img src={imageUrl} alt="معاينة الصورة" style={{ maxWidth: '100%', height: 'auto' }} />
                            </div>
                        )}
                        <ToggleControl
                            label="عكس الصورة (reversimg)"
                            checked={reverseImage}
                            onChange={(value) => setAttributes({ reverseImage: value })}
                        />
                    </PanelBody>

                    {/* ✅ TinyMCE يعمل بشكل صحيح داخل القائمة الجانبية */}
                    <PanelBody title="تحرير المحتوى">
                        <textarea id={editorId} defaultValue={content} />
                    </PanelBody>
                </InspectorControls>

                {/* ✅ المحتوى يظهر مباشرة أثناء التعديل */}
                <div className='container'>
                    <h2 className='pjc-title'>{sectionTitle}</h2>
                    <div className='pjc-flx' style={{ display: 'flex', alignItems: 'center', gap: '20px' }}>
                        {imageUrl && (
                            <div className='pjc-imgbx' style={{ flex: '1' }}>
                                <img src={imageUrl} loading="lazy" width="500" height="400" decoding="async" alt="صورة القسم" />
                            </div>
                        )}
                        <div className='ph-content' style={{ padding: '10px', border: '1px solid #eee', minHeight: '100px', backgroundColor: '#fff' }}>
                            <div dangerouslySetInnerHTML={{ __html: content }} />
                        </div>
                    </div>
                </div>
            </div>
        );
    },

    save: () => null
});
