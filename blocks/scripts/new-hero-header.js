import {
  MediaUpload,
  InspectorControls
} from '@wordpress/block-editor';
import {
  TextControl,
  ToggleControl,
  PanelBody,
  Button,
  SelectControl
} from '@wordpress/components';

import { registerBlockType } from '@wordpress/blocks';
import { Fragment } from '@wordpress/element';

function getYoutubeId(url) {
  try {
    const match = url.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([a-zA-Z0-9_-]{11})/);
    return match && match[1] ? match[1] : '';
  } catch (error) {
    return '';
  }
}



registerBlockType('custom/hero-header', {
  title: 'Ultimate Hero Header',
  icon: 'format-image',
  category: 'custom-blocks',

  attributes: {
    backgroundType: { type: 'string', default: 'image' },         // image | youtube
    backgroundImage: { type: 'string', default: '' },
    backgroundVideo: { type: 'string', default: '' },              // YouTube link
    backgroundVideoUpload: { type: 'string', default: '' },

    logoImage: { type: 'string', default: '' },
    title: { type: 'string', default: 'عنوان الهيدر' },
    description: { type: 'string', default: 'وصف الهيدر هنا' },
    enableForm: { type: 'boolean', default: false },
    logoAlign: { type: 'string', default: 'center' },
    logoAbsolute: { type: 'boolean', default: false },
    formTitle: { type: 'string', default: 'تواصل معنا' },
    enableFormStyle: { type: 'boolean', default: true },
    // class 100%
    fullbort: { type: 'boolean', default: false },

    // CTA buttons
    enableCTAWhatsapp: { type: 'boolean', default: true },
    enableCTACall: { type: 'boolean', default: true },
    enableCTAPopup: { type: 'boolean', default: true },
    ctaWhatsappText: { type: 'string', default: 'واتساب' },
    ctaCallText: { type: 'string', default: 'اتصال' },
    ctaPopupText: { type: 'string', default: 'احجز وحدتك' },

    // Cards
    cards: { type: 'array', default: [] }
  },

  edit: ({ attributes, setAttributes }) => {
    const {
      backgroundImage,
      logoImage,
      title,
      description,
      enableForm,
      logoAlign,
      logoAbsolute,
      formTitle,
      enableFormStyle,
      enableCTAWhatsapp,
      enableCTACall,
      enableCTAPopup,
      ctaWhatsappText,
      ctaCallText,
      ctaPopupText,
      cards
    } = attributes;

    return (
      <Fragment>
        <InspectorControls>
          <PanelBody title="إعدادات الهيدر" initialOpen={false}>

<SelectControl
  label="نوع الخلفية"
  value={attributes.backgroundType}
  options={[
    { label: 'صورة', value: 'image' },
    { label: 'رابط يوتيوب', value: 'youtube' },
    { label: 'رفع فيديو', value: 'upload' } // ✅ جديدة
  ]}
  onChange={(value) => setAttributes({ backgroundType: value })}
/>


{attributes.backgroundType === 'image' && (
  <>
    {attributes.backgroundImage && (
      <div style={{ marginBottom: '10px' }}>
        <img src={attributes.backgroundImage} alt="Background" style={{ maxWidth: '100%', borderRadius: '4px' }} />
        <Button
          isDestructive
          isSmall
          onClick={() => setAttributes({ backgroundImage: '' })}
          style={{ marginTop: '5px' }}
        >
          حذف الخلفية
        </Button>
      </div>
    )}
    <MediaUpload
      onSelect={(media) => setAttributes({ backgroundImage: media.url })}
      allowedTypes={['image']}
      render={({ open }) => (
        <Button onClick={open} isSecondary>
          {attributes.backgroundImage ? 'تغيير الخلفية' : 'اختيار خلفية'}
        </Button>
      )}
    />
  </>
)}

{attributes.backgroundType === 'upload' && (
  <>
    {attributes.backgroundVideoUpload && (
      <div style={{ marginBottom: '10px' }}>
        <video
          src={attributes.backgroundVideoUpload}
          controls
          style={{ width: '100%', borderRadius: '4px' }}
        />
        <Button
          isDestructive
          isSmall
          onClick={() => setAttributes({ backgroundVideoUpload: '' })}
          style={{ marginTop: '5px' }}
        >
          حذف الفيديو
        </Button>
      </div>
    )}
    <MediaUpload
      onSelect={(media) => setAttributes({ backgroundVideoUpload: media.url })}
      allowedTypes={['video']}
      render={({ open }) => (
        <Button onClick={open} isSecondary>
          {attributes.backgroundVideoUpload ? 'تغيير الفيديو' : 'رفع فيديو'}
        </Button>
      )}
    />
  </>
)}

{attributes.backgroundType === 'youtube' && (
  <TextControl
    label="رابط يوتيوب"
    value={attributes.backgroundVideo}
    onChange={(value) => setAttributes({ backgroundVideo: value })}
  />
)}

            <TextControl
              label="عنوان الهيدر"
              value={title}
              onChange={(value) => setAttributes({ title: value })}
            />
            <TextControl
              label="وصف الهيدر"
              value={description}
              onChange={(value) => setAttributes({ description: value })}
            />
            <ToggleControl
              label="تفعيل 100%"
              checked={attributes.fullbort}
              onChange={(value) => setAttributes({ fullbort: value })}
            />

          </PanelBody>

          <PanelBody title="إعدادات اللوجو" initialOpen={false}>
            {logoImage && (
              <div style={{ marginBottom: '10px' }}>
                <img src={logoImage} alt="Logo" style={{ maxWidth: '100%', borderRadius: '4px', background: '#fff', padding: '5px' }} />
                <Button
                  isDestructive
                  isSmall
                  onClick={() => setAttributes({ logoImage: '' })}
                  style={{ marginTop: '5px' }}
                >
                  حذف اللوجو
                </Button>
              </div>
            )}
            <MediaUpload
              onSelect={(media) => setAttributes({ logoImage: media.url })}
              allowedTypes={['image']}
              render={({ open }) => (
                <Button onClick={open} isSecondary>
                  {logoImage ? 'تغيير اللوجو' : 'اختيار لوجو'}
                </Button>
              )}
            />
            <ToggleControl
              label="عرض اللوجو بوضع مطلق (Absolute)"
              checked={logoAbsolute}
              onChange={(value) => setAttributes({ logoAbsolute: value })}
            />
            {logoAbsolute && (
              <SelectControl
                label="محاذاة اللوجو"
                value={logoAlign}
                options={[
                  { label: 'يمين', value: 'right' },
                  { label: 'منتصف', value: 'center' },
                  { label: 'يسار', value: 'left' }
                ]}
                onChange={(value) => setAttributes({ logoAlign: value })}
              />
            )}
          </PanelBody>

          <PanelBody title="إعدادات CTA" initialOpen={false}>
            <PanelBody title="[Form]" initialOpen={false}>
              <ToggleControl
                label="تفعيل الفورم"
                checked={enableForm}
                onChange={(value) => setAttributes({ enableForm: value })}
              />
              <ToggleControl
                label="فورم شفاف"
                checked={enableFormStyle}
                onChange={(value) => setAttributes({ enableFormStyle: value })}
              />
              <TextControl
                label="عنوان الفورم"
                value={formTitle}
                onChange={(value) => setAttributes({ formTitle: value })}
              />
            </PanelBody>

            <PanelBody title="[Buttons]" initialOpen={false}>
              <ToggleControl
                label="إظهار زر واتساب"
                checked={enableCTAWhatsapp}
                onChange={(value) => setAttributes({ enableCTAWhatsapp: value })}
              />
              <TextControl
                label="نص زر واتساب"
                value={ctaWhatsappText}
                onChange={(value) => setAttributes({ ctaWhatsappText: value })}
              />

              <ToggleControl
                label="إظهار زر الاتصال"
                checked={enableCTACall}
                onChange={(value) => setAttributes({ enableCTACall: value })}
              />
              <TextControl
                label="نص زر الاتصال"
                value={ctaCallText}
                onChange={(value) => setAttributes({ ctaCallText: value })}
              />

              <ToggleControl
                label="إظهار زر الحجز"
                checked={enableCTAPopup}
                onChange={(value) => setAttributes({ enableCTAPopup: value })}
              />
              <TextControl
                label="نص زر الحجز"
                value={ctaPopupText}
                onChange={(value) => setAttributes({ ctaPopupText: value })}
              />
            </PanelBody>
          </PanelBody>

          <PanelBody title="البطاقات" initialOpen={false}>
            {cards.map((card, index) => (
              <div key={index} style={{ border: '1px solid #ddd', padding: '10px', marginBottom: '10px', borderRadius: '6px', background: '#fafafa' }}>
                <TextControl
                  label={`عنوان البطاقة ${index + 1}`}
                  value={card.title}
                  onChange={(value) => {
                    const newCards = [...cards];
                    newCards[index].title = value;
                    setAttributes({ cards: newCards });
                  }}
                />
                <TextControl
                  label={`وصف البطاقة ${index + 1}`}
                  value={card.description}
                  onChange={(value) => {
                    const newCards = [...cards];
                    newCards[index].description = value;
                    setAttributes({ cards: newCards });
                  }}
                />
                <Button
                  isDestructive
                  isSmall
                  onClick={() => {
                    const newCards = cards.filter((_, i) => i !== index);
                    setAttributes({ cards: newCards });
                  }}
                  style={{ marginTop: '5px' }}
                >
                  حذف البطاقة
                </Button>
              </div>
            ))}

            <Button
              isSecondary
              onClick={() => setAttributes({ cards: [...cards, { title: 'New Card', description: 'Card description here.' }] })}
            >
              إضافة بطاقة جديدة
            </Button>
          </PanelBody>
        </InspectorControls>

        
          <div className="msvh_hero-section">
          
{/* صورة كخلفية */}
{attributes.backgroundType === 'image' && attributes.backgroundImage && (
  <div
    className="background-image"
    style={{
      backgroundImage: `url(${attributes.backgroundImage})`,
      position: 'absolute',
      top: 0,
      left: 0,
      right: 0,
      bottom: 0,
      backgroundSize: 'cover',
      backgroundPosition: 'center',
      zIndex: 0
    }}
  />
)}

{/* فيديو مرفوع */}
{attributes.backgroundType === 'upload' && attributes.backgroundVideoUpload && (
  <video
    className="background-video"
    src={attributes.backgroundVideoUpload}
    autoPlay
    muted
    loop
    playsInline
    style={{
      position: 'absolute',
      top: 0,
      left: 0,
      width: '100%',
      height: '100%',
      objectFit: 'cover',
      zIndex: 0
    }}
  />
)}

{/* يوتيوب */}
{attributes.backgroundType === 'youtube' &&
  attributes.backgroundVideo &&
  getYoutubeId(attributes.backgroundVideo) && (
    <div className="background-youtube" style={{ position: 'absolute', top: 0, left: 0, right: 0, bottom: 0, zIndex: 0 }}>
      <iframe
        src={`https://www.youtube.com/embed/${getYoutubeId(attributes.backgroundVideo)}?autoplay=1&mute=1&loop=1&playlist=${getYoutubeId(attributes.backgroundVideo)}&controls=0&showinfo=0&modestbranding=1&rel=0&disablekb=1`}
        frameBorder="0"
        allow="autoplay; encrypted-media"
        allowFullScreen
        style={{
          width: '100%',
          height: '100%',
          pointerEvents: 'none'
        }}
      ></iframe>
    </div>
)}

          <div className="msvh_overlay"></div>
          <div className="container msvh_content">
            {logoImage && (
              <div className={`msvh_logo ${logoAbsolute ? `logo-absolute logo-align-${logoAlign}` : ''}`}>
                <img src={logoImage} alt="Logo" />
              </div>
            )}

            {(title || description) && (
              <div className="msvh_content_sm">
                {title && <h1 className="msvh_headline">{title}</h1>}
                {description && <p className="msvh_description">{description}</p>}
              </div>
            )}

            {enableForm && (
              <div className={`form_header_msvh ${enableFormStyle ? '' : 'WitBg'}`}>
                {formTitle && <h3 className="msvh_form-title">{formTitle}</h3>}
                <form className="msvh_form" onSubmit={(e) => e.preventDefault()}>
                  <input type="text" placeholder="الاسم بالكامل" required />
                  <input type="tel" placeholder="رقم الهاتف" required />
                  <button type="submit" className="msvh_submit-btn">إرسال</button>
                </form>
              </div>
            )}

            {(enableCTAWhatsapp || enableCTACall || enableCTAPopup) && (
              <div className="custom_cta_shortcode cta_block2 msvh_cta_buttons">
                <div className="towitem">
                  {enableCTAWhatsapp && (
                    <a id="cta_whats" target="_blank" className="whatsapp">
                      <i className="fa fa-whatsapp" aria-hidden="true"></i> {ctaWhatsappText}
                    </a>
                  )}
                  {enableCTACall && (
                    <a id="cta_call" className="phone">
                      <i className="fa fa-phone" aria-hidden="true"></i> {ctaCallText}
                    </a>
                  )}
                  {enableCTAPopup && (
                    <span id="cta_pop" className="formpopub">
                      <i className="fa fa-envelope-open-o" aria-hidden="true"></i> {ctaPopupText}
                    </span>
                  )}
                </div>
              </div>
            )}

            {cards.length > 0 && (
              <div className="msvh_cards-wrapper">
                {cards.map((card, index) => (
                  <div className="msvh_card" key={index}>
                    <h3 className="msvh_card-title">{card.title}</h3>
                    <p className="msvh_card-desc">{card.description}</p>
                  </div>
                ))}
              </div>
            )}
          </div>
        </div>
      </Fragment>
    );
  },

  save: () => null // render_callback PHP
});
