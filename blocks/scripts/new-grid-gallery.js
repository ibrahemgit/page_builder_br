import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, MediaUpload, MediaUploadCheck, ColorPalette } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button, IconButton } from '@wordpress/components';

registerBlockType('custom/gallery-images-grid', {
    title: 'معرض الصور جريد',
    icon: 'format-gallery',
    category: 'custom-Gallry',

    attributes: {
        galleryTitle: { type: 'string', default: 'معرض الصور' },
        gallerySubtitle: { type: 'string', default: 'مجموعة مختارة من أجمل الصور' },
        images: { type: 'array', default: [] },
        backgroundColor: { type: 'string', default: '#fff' }, // ✅ لون خلفية البلوك
        textColor: { type: 'string', default: '#000' } // ✅ لون النص
    },

    example: {
        attributes: {
            galleryTitle: 'معرض الصور',
            gallerySubtitle: 'مجموعة مختارة من أجمل الصور',
            backgroundColor: '#fff',
            textColor: '#000',
            images: [
                'https://via.placeholder.com/150',
                'https://via.placeholder.com/150',
                'https://via.placeholder.com/150'
            ]
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { galleryTitle, gallerySubtitle, images, backgroundColor, textColor } = attributes;

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
                            label="العنوان الرئيسي"
                            value={galleryTitle}
                            onChange={(value) => setAttributes({ galleryTitle: value })}
                        />
                        {/* ✅ إضافة حقل الـ Subtitle */}
                        <TextControl
                            label="العنوان الفرعي"
                            value={gallerySubtitle}
                            onChange={(value) => setAttributes({ gallerySubtitle: value })}
                            placeholder="وصف قصير للمعرض"
                            help="نص وصفي يظهر تحت العنوان الرئيسي"
                        />
                        
                        {/* ✅ التحكم في لون الخلفية */}
                        <div style={{ marginBottom: '20px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>
                                لون خلفية البلوك
                            </label>
                            <ColorPalette
                                value={backgroundColor}
                                onChange={(color) => setAttributes({ backgroundColor: color || '#fff' })}
                                colors={[
                                    { name: 'أبيض', color: '#ffffff' },
                                    { name: 'رمادي فاتح', color: '#f9f9f9' },
                                    { name: 'رمادي', color: '#e5e7eb' },
                                    { name: 'أزرق فاتح', color: '#dbeafe' },
                                    { name: 'أخضر فاتح', color: '#dcfce7' },
                                    { name: 'أصفر فاتح', color: '#fefce8' },
                                    { name: 'وردي فاتح', color: '#fdf2f8' },
                                    { name: 'بنفسجي فاتح', color: '#f3e8ff' },
                                    { name: 'أزرق غامق', color: '#1e40af' },
                                    { name: 'أسود', color: '#000000' }
                                ]}
                            />
                        </div>

                        {/* ✅ التحكم في لون النص */}
                        <div style={{ marginBottom: '20px' }}>
                            <label style={{ display: 'block', marginBottom: '8px', fontWeight: '600' }}>
                                لون النص
                            </label>
                            <ColorPalette
                                value={textColor}
                                onChange={(color) => setAttributes({ textColor: color || '#000' })}
                                colors={[
                                    { name: 'أسود', color: '#000000' },
                                    { name: 'رمادي غامق', color: '#333333' },
                                    { name: 'رمادي متوسط', color: '#6b7280' },
                                    { name: 'أبيض', color: '#ffffff' },
                                    { name: 'أزرق غامق', color: '#1e40af' },
                                    { name: 'أخضر غامق', color: '#166534' },
                                    { name: 'أحمر غامق', color: '#991b1b' },
                                    { name: 'بنفسجي غامق', color: '#581c87' },
                                    { name: 'برتقالي غامق', color: '#c2410c' },
                                    { name: 'وردي غامق', color: '#be185d' }
                                ]}
                            />
                        </div>

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

                <div className="section_gallry" style={{ 
                    backgroundColor: backgroundColor,
                    color: textColor,
                    padding: '40px 0',
                    minHeight: '200px'
                }}>
                    <div className="container">
                        <div className="pjc-title" style={{ color: textColor }}>
                            {galleryTitle}
                        </div>
                        {/* ✅ إضافة عرض الـ Subtitle */}
                        {gallerySubtitle && (
                            <div className="pjc-subtitle" style={{ 
                                fontSize: '16px', 
                                color: textColor,
                                opacity: 0.8,
                                marginBottom: '20px',
                                textAlign: 'center'
                            }}>
                                {gallerySubtitle}
                            </div>
                        )}
                        <div className="gallery_images cusclass">
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
                                <p style={{ color: textColor }}>لم يتم تحديد صور بعد.</p>
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