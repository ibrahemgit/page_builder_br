import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/block-editor';
import {
    PanelBody,
    TextControl,
    TextareaControl,
    SelectControl,
    Button,
    IconButton
} from '@wordpress/components';
import { Fragment } from '@wordpress/element';

registerBlockType('custom/review-block', {
    title: 'بلوك التقييمات',
    icon: 'star-filled',
    category: 'custom-CTA',

    attributes: {
        titleText: {
            type: 'string',
            default: 'عنوان التقييمات'
        },
        reviews: {
            type: 'array',
            default: []
        }
    },

    edit: ({ attributes, setAttributes }) => {
        const { titleText, reviews } = attributes;

        const updateReview = (index, field, value) => {
            const updated = [...reviews];
            updated[index][field] = value;
            setAttributes({ reviews: updated });
        };

        const addReview = () => {
            const updated = [...reviews, {
                name: '',
                time: '',
                message: '',
                stars: '5'
            }];
            setAttributes({ reviews: updated });
        };

        const removeReview = (index) => {
            const updated = reviews.filter((_, i) => i !== index);
            setAttributes({ reviews: updated });
        };

        return (
            <Fragment>
                <InspectorControls>
                    <PanelBody title="إدارة التقييمات" initialOpen={true}>
                        <TextControl
                            label="عنوان القسم"
                            value={titleText}
                            onChange={(value) => setAttributes({ titleText: value })}
                        />

                        <Button isPrimary onClick={addReview} style={{ marginBottom: '10px' }}>
                            + إضافة تقييم
                        </Button>

                        {reviews.map((review, index) => (
                            <div
                                key={index}
                                style={{
                                    borderBottom: '1px solid #ccc',
                                    marginBottom: '15px',
                                    paddingBottom: '10px'
                                }}
                            >
                                <TextControl
                                    label="اسم المستخدم"
                                    value={review.name}
                                    onChange={(value) => updateReview(index, 'name', value)}
                                />
                                <TextControl
                                    label="منذ (مثال: منذ دقيقة)"
                                    value={review.time}
                                    onChange={(value) => updateReview(index, 'time', value)}
                                />
                                <TextareaControl
                                    label="نص التقييم"
                                    value={review.message}
                                    onChange={(value) => updateReview(index, 'message', value)}
                                />
                                <SelectControl
                                    label="عدد النجوم"
                                    value={review.stars}
                                    options={[
                                        { label: '1', value: '1' },
                                        { label: '2', value: '2' },
                                        { label: '3', value: '3' },
                                        { label: '4', value: '4' },
                                        { label: '5', value: '5' },
                                    ]}
                                    onChange={(value) => updateReview(index, 'stars', value)}
                                />
                                <IconButton
                                    icon="no-alt"
                                    label="حذف التقييم"
                                    onClick={() => removeReview(index)}
                                />
                            </div>
                        ))}
                    </PanelBody>
                </InspectorControls>
                <div className="shortcodesection">
                    <div className="container">
                        {/* عرض العنوان داخل البلوك */}
                        {titleText && (
                            <div className="headline sm_title shorttitle" >
                                <span>{titleText}</span>
                            </div>
                        )}
                        <div className="custom-reviews-grid">
                            {reviews.length === 0 && <p>لا توجد تقييمات بعد.</p>}
                            {reviews.map((review, index) => {
                                const firstLetter = review.name?.charAt(0)?.toUpperCase() || '?';
                                return (
                                    <div key={index} className="review-card">
                                        <div className="review-header">
                                            <div className="review-avatar">{firstLetter}</div>
                                            <div className="review-meta">
                                                <div className="review-name">{review.name}</div>
                                                <div className="review-time">{review.time}</div>
                                            </div>
                                        </div>
                                        <div className="review-stars">
                                            {[...Array(parseInt(review.stars))].map((_, i) => (
                                                <span key={i}>⭐</span>
                                            ))}
                                        </div>
                                        <div className="review-message">{review.message}</div>
                                    </div>
                                );
                            })}
                        </div>
                    </div>
                </div>
            </Fragment>
        );
    },

    save: () => null
});
