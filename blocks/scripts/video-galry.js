import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button, IconButton } from '@wordpress/components';
import { useState } from '@wordpress/element';

registerBlockType('custom/youtube-gallery', {
    title: 'معرض فيديوهات يوتيوب',
    icon: 'video-alt3',
    category: 'custom-Gallry',

    attributes: {
        galleryTitle: { type: 'string', default: 'فيديوهات المشروع' },
        videos: { type: 'array', default: [] }
    },

    edit: ({ attributes, setAttributes }) => {
        const { galleryTitle, videos } = attributes;

        // تحديث رابط الفيديو
        const updateVideoUrl = (index, newUrl) => {
            const updatedVideos = [...videos];
            updatedVideos[index] = newUrl;
            setAttributes({ videos: updatedVideos });
        };

        // إضافة فيديو جديد
        const addVideo = () => {
            setAttributes({ videos: [...videos, ''] });
        };

        // حذف فيديو
        const removeVideo = (index) => {
            const updatedVideos = videos.filter((_, i) => i !== index);
            setAttributes({ videos: updatedVideos });
        };

        // استخراج ID الفيديو من رابط اليوتيوب
        const getYouTubeID = (url) => {
            try {
                const parsedUrl = new URL(url);

                // إذا كان رابط عادي watch?v= أو فيه v=
                if (parsedUrl.hostname.includes('youtube.com')) {
                    if (parsedUrl.pathname === '/watch') {
                        return parsedUrl.searchParams.get('v');
                    }

                    // دعم shorts
                    if (parsedUrl.pathname.startsWith('/shorts/')) {
                        return parsedUrl.pathname.split('/')[2];
                    }
                }

                // دعم youtu.be
                if (parsedUrl.hostname === 'youtu.be') {
                    return parsedUrl.pathname.split('/')[1];
                }

                return null;
            } catch (e) {
                return null;
            }
        };


        return (
            <div className="youtube-gallery-editor">
                <InspectorControls>
                    <PanelBody title="إعدادات المعرض">
                        <TextControl
                            label="عنوان المعرض"
                            value={galleryTitle}
                            onChange={(value) => setAttributes({ galleryTitle: value })}
                        />
                        <Button onClick={addVideo} isPrimary>
                            + إضافة فيديو
                        </Button>
                    </PanelBody>
                </InspectorControls>

                <div className="section_gallry">
                    <div className="container">
                        <div className="pjc-title">{galleryTitle}</div>
                        <div className="videos-container">
                            {videos.length > 0 ? (
                                videos.map((videoUrl, index) => {
                                    const videoID = getYouTubeID(videoUrl);
                                    return (
                                        <div key={index} className="video-input">
                                            <TextControl
                                                label={`رابط الفيديو ${index + 1}`}
                                                value={videoUrl}
                                                onChange={(value) => updateVideoUrl(index, value)}
                                            />
                                            <IconButton
                                                icon="no-alt"
                                                label="حذف الفيديو"
                                                onClick={() => removeVideo(index)}
                                                className="remove-video-btn"
                                            />
                                            {videoID && (
                                                <div className="video-preview" style={{ marginTop: '10px' }}>
                                                    <iframe
                                                        width="300"
                                                        height="170"
                                                        src={`https://www.youtube.com/embed/${videoID}`}
                                                        frameBorder="0"
                                                        allowFullScreen
                                                    ></iframe>
                                                </div>
                                            )}
                                        </div>
                                    );
                                })
                            ) : (
                                <p>لم يتم إدخال أي فيديو بعد.</p>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        );
    },

    save: () => null // سيتم عرض المحتوى في PHP
});
