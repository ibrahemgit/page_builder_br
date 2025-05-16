<?php 
function youtube_gallery_block_render($attributes) {
    $gallery_title = isset($attributes['galleryTitle']) ? esc_html($attributes['galleryTitle']) : 'فيديوهات المشروع';
    $videos = isset($attributes['videos']) ? $attributes['videos'] : [];

    if (!function_exists('get_youtube_id')) {
        function get_youtube_id($url) {
            // دعم watch?v= و youtu.be و shorts
            $parsed_url = parse_url($url);
            if (!isset($parsed_url['host'])) return null;

            if (strpos($parsed_url['host'], 'youtu.be') !== false) {
                return ltrim($parsed_url['path'], '/');
            }

            if (strpos($parsed_url['host'], 'youtube.com') !== false) {
                parse_str($parsed_url['query'] ?? '', $query_vars);

                // watch?v=xxx
                if (isset($query_vars['v'])) {
                    return $query_vars['v'];
                }

                // shorts/xxx
                if (strpos($parsed_url['path'], '/shorts/') === 0) {
                    return explode('/', $parsed_url['path'])[2] ?? null;
                }
            }

            return null;
        }
    }

    ob_start();
    ?>
    <div class='section_gallry'>
        <div class='container'>
            <div class="pjc-title"><?php echo $gallery_title; ?></div>
            <div class='gallery_images youtube-lazy-wrapper'>
                <?php
                if (!empty($videos)) {
                    foreach ($videos as $video_url) {
                        $video_id = get_youtube_id($video_url);
                        if ($video_id) {
                            $thumbnail = "https://img.youtube.com/vi/{$video_id}/hqdefault.jpg";

                            // هل هو شورتس؟
                            $is_shorts = strpos($video_url, '/shorts/') !== false;
                            $aspect_class = $is_shorts ? 'shorts-aspect' : 'regular-aspect';
                            ?>
                            <div class="video-item lazy-youtube <?php echo esc_attr($aspect_class); ?>" data-id="<?php echo esc_attr($video_id); ?>">
                                <div class="thumbnail" style="cursor:pointer;position:relative;">
                                    <img src="<?php echo esc_url($thumbnail); ?>" alt="فيديو يوتيوب" loading="lazy" decoding="async" />
                                    <div class="play-button" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:40px;color:white;">▶</div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                } else {
                    echo '<p>لا توجد فيديوهات لعرضها.</p>';
                }
                ?>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const videos = document.querySelectorAll(".lazy-youtube");
            videos.forEach(video => {
                video.addEventListener("click", function () {
                    const id = video.getAttribute("data-id");
                    const iframe = document.createElement("iframe");
                    iframe.setAttribute("src", "https://www.youtube.com/embed/" + id + "?autoplay=1");
                    iframe.setAttribute("frameborder", "0");
                    iframe.setAttribute("allowfullscreen", "1");
                    iframe.setAttribute("loading", "lazy");
                    iframe.setAttribute("width", "100%");
                    iframe.setAttribute("height", "100%");
                    video.innerHTML = "";
                    video.appendChild(iframe);
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

register_block_type('custom/youtube-gallery', array(
    'render_callback' => 'youtube_gallery_block_render',
    'attributes' => array(
        'galleryTitle' => array('type' => 'string', 'default' => 'فيديوهات المشروع'),
        'videos' => array('type' => 'array', 'default' => [])
    ),
));
