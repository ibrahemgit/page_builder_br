import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button, IconButton } from '@wordpress/components';

registerBlockType('custom/gallery-block', {
    title: 'معرض الصور',
    icon: 'format-gallery',
    category: 'custom-blocks',

    attributes: {
        galleryTitle: { type: 'string', default: 'أهم المطورين' },
        images: { type: 'array', default: [] }
    },

    example: {
        attributes: {
            galleryTitle: 'شركاؤنا في النجاح',
            images: [
                'https://via.placeholder.com/150',
                'https://via.placeholder.com/150',
                'https://via.placeholder.com/150'
            ]
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { galleryTitle, images } = attributes;

        // تحديث الصور بعد الاختيار
        const onSelectImages = (newImages) => {
            const imageUrls = newImages.map(img => img.url);
            setAttributes({ images: imageUrls });
        };

        // حذف صورة معينة
        const removeImage = (index) => {
            const updatedImages = images.filter((_, i) => i !== index);
            setAttributes({ images: updatedImages });
        };

        // مسح كل الصور
        const clearGallery = () => {
            setAttributes({ images: [] });
        };

        return (
            <div className="gallery-block-editor">
                <InspectorControls>
                    <PanelBody title="إعدادات المعرض">
                        <TextControl
                            label="عنوان المعرض"
                            value={galleryTitle}
                            onChange={(value) => setAttributes({ galleryTitle: value })}
                        />
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={onSelectImages}
                                allowedTypes={['image']}
                                multiple
                                gallery
                                value={images}
                                render={({ open }) => (
                                    <Button onClick={open} isPrimary>
                                        اختر الصور
                                    </Button>
                                )}
                            />
                        </MediaUploadCheck>
                        {images.length > 0 && (
                            <Button onClick={clearGallery} isDestructive>
                                مسح جميع الصور
                            </Button>
                        )}
                    </PanelBody>
                </InspectorControls>

                <div className="section_gallry">
                    <div className="container">
                        <div className="pjc-title">{galleryTitle}</div>
                        <div className="gallry_imgs cusclass">
                            {images.length > 0 ? (
                                images.map((img, index) => (
                                    <div key={index} className="image-container">
                                        <img src={img} alt="معاينة الصورة" style={{ maxWidth: '100px', margin: '5px' }} />
                                        <IconButton
                                            icon="no-alt"
                                            label="حذف الصورة"
                                            onClick={() => removeImage(index)}
                                            className="remove-image-btn"
                                        />
                                    </div>
                                ))
                            ) : (
                                <p>لم يتم تحديد صور بعد.</p>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        );
    },

    save: () => {
        return null; // سيتم عرض المحتوى عبر PHP
    }
});
