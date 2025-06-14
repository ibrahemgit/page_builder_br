import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, MediaUpload } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button, ToggleControl } from '@wordpress/components';
import { Editor } from '@tinymce/tinymce-react'; // ✅ محرر TinyMCE الرسمي

registerBlockType('custom/project-content-block', {
    title: 'محتوى المشروع',
    icon: 'editor-alignleft',
    category: 'custom-blocks',

    attributes: {
        sectionTitle: { type: 'string', default: 'عنوان القسم' },
        content: { type: 'string', default: '' },
        imageUrl: { type: 'string', default: '' },
        reverseImage: { type: 'boolean', default: false },
        pricetbda: { type: 'string', default: '' },
        mkadmybda: { type: 'string', default: '' },
        tkseetybda: { type: 'string', default: '' },
    },

    example: {
        attributes: {
            sectionTitle: 'عنوان المعاينة',
            content: '<ul><li>مثال 1</li><li>مثال 2</li><li>مثال 3</li></ul>',
            imageUrl: 'https://via.placeholder.com/500',
            reverseImage: false,
            pricetbda: '',
            mkadmybda: '',
            tkseetybda: '',
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { sectionTitle, content, imageUrl, reverseImage, pricetbda, mkadmybda, tkseetybda } = attributes;
        const blockProps = useBlockProps();

        return (
            <div {...blockProps} className={`project_content ${reverseImage ? 'reversimg' : ''}`}>
                {/* القائمة الجانبية */}
                <InspectorControls>
                    <PanelBody title="إعدادات المحتوي" initialOpen={false}>
                        <TextControl
                            label="عنوان السكشن"
                            value={sectionTitle}
                            onChange={(value) => setAttributes({ sectionTitle: value })}
                        />
                        

                        {/* ✅ TinyMCE Editor */}
                        <Editor
                            value={content}
                            init={{
                                height: 200,
                                menubar: false,
                                plugins: 'lists link',
                                directionality: 'rtl', // ✅ تفعيل RTL افتراضيًا
                                content_style: 'body { direction: rtl; text-align: right; }', // ✅ تنسيق المحتوى داخل المحرر
                                toolbar: 'formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link | undo redo ',
                                block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4',
                            }}
                            onEditorChange={(newContent) => setAttributes({ content: newContent })}
                        />
                    </PanelBody>

                    <PanelBody title="إعدادات الصورة" initialOpen={false}>
                        <MediaUpload
                            onSelect={(media) => setAttributes({ imageUrl: media.url })}
                            allowedTypes={['image']}
                            render={({ open }) => (
                                <Button onClick={open} isPrimary>
                                    {imageUrl ? 'تغيير الصورة' : 'رفع صورة'}
                                </Button>
                            )}
                        />

                        {imageUrl && (
                            <>
                                <div style={{ marginTop: '10px', marginBottom: '10px' }}>
                                    <img
                                        src={imageUrl}
                                        alt="معاينة الصورة"
                                        style={{ maxWidth: '100%', height: 'auto', display: 'block', marginBottom: '10px' }}
                                    />
                                    <Button
                                        isDestructive
                                        onClick={() => setAttributes({ imageUrl: '' })}
                                    >
                                        حذف الصورة
                                    </Button>
                                </div>

                                <div style={{ margin: '10px 0' }}></div>
                                
                                <ToggleControl
                                    label="عكس الصورة (reversimg)"
                                    checked={reverseImage}
                                    onChange={(value) => setAttributes({ reverseImage: value })}
                                />
                            </>
                        )}
                        
                    </PanelBody>

                    <PanelBody title="خطط الدفع" initialOpen={false}>
                        <TextControl
                            label="الأسعار تبدأ من"
                            value={pricetbda}
                            onChange={(value) => setAttributes({ pricetbda: value })}
                        />
                        <TextControl
                            label="مقدم يبدأ من"
                            value={mkadmybda}
                            onChange={(value) => setAttributes({ mkadmybda: value })}
                        />
                        <TextControl
                            label="تقسيط يصل حتى"
                            value={tkseetybda}
                            onChange={(value) => setAttributes({ tkseetybda: value })}
                        />
                    </PanelBody>

                </InspectorControls>

                {/* ✅ المحتوى يظهر مباشرة أثناء التعديل */}
                <div className='container'>
                    <h2 className='pjc-title'>{sectionTitle}</h2>
                    <div className='pjc-flx' style={{ display: 'flex', alignItems: 'center', gap: '20px' }}>
                        {imageUrl && (
                            <div className='pjc-imgbx inprev'>
                                <img src={imageUrl} loading="lazy" width="500" height="400" decoding="async" alt="صورة القسم" />
                            </div>
                        )}
                        <div className='contentsection'>
                            <div className='ph-content' style={{ padding: '10px', border: '1px solid #eee', minHeight: '100px', backgroundColor: '#fff' }}>
                                <Editor
                                    value={content}
                                    init={{
                                        height: 200,
                                        menubar: false,
                                        plugins: 'lists link',
                                        directionality: 'rtl', // ✅ تفعيل RTL افتراضيًا
                                        content_style: 'body { direction: rtl; text-align: right; }', // ✅ تنسيق المحتوى داخل المحرر
                                        toolbar: 'formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link | undo redo ',
                                        block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4',
                                    }}
                                    onEditorChange={(newContent) => setAttributes({ content: newContent })}
                                />
                            </div>

                            {(pricetbda || mkadmybda || tkseetybda) && (
                                <div className="head_section_payplan">
                                    {pricetbda && (
                                        <div className="item_plan">
                                            <div className="plantext">الأسعار تبدأ من</div>
                                            <div className="plantitle">{pricetbda}</div>
                                        </div>
                                    )}
                                    {mkadmybda && (
                                        <div className="item_plan">
                                            <div className="plantext">مقدم يبدأ من</div>
                                            <div className="plantitle">{mkadmybda}</div>
                                        </div>
                                    )}
                                    {tkseetybda && (
                                        <div className="item_plan">
                                            <div className="plantext">تقسيط يصل حتى</div>
                                            <div className="plantitle">{tkseetybda}</div>
                                        </div>
                                    )}
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        );
    },

    save: () => null
});
