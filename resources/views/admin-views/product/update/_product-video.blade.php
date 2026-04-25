<div class="card mt-3 rest-part">
    <div class="card-header">
        <div class="d-flex gap-2">
            <i class="fi fi-sr-user"></i>
            <h3 class="mb-0">{{ translate('product_video') }}</h3>
            <span class="tooltip-icon cursor-pointer" data-bs-toggle="tooltip"
                  aria-label="{{ translate('add_the_YouTube_video_link_here._Only_the_YouTube-embedded_link_is_supported.') }}"
                  data-bs-title="{{ translate('add_the_YouTube_video_link_here._Only_the_YouTube-embedded_link_is_supported.') }}"
            >
                <i class="fi fi-sr-info"></i>
            </span>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label mb-0">{{ translate('video_provider') }}</label>
            <select name="video_provider" class="form-control" onchange="updateVideoPlaceholder(this.value)">
                <option value="youtube" {{ $product['video_provider'] == 'youtube' ? 'selected' : '' }}>{{ translate('youtube') }}</option>
                <option value="tiktok" {{ $product['video_provider'] == 'tiktok' ? 'selected' : '' }}>{{ translate('tiktok') }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label mb-0">
                {{ translate('video_link') }}
            </label>
            <span class="text-info"> ({{ translate('optional_please_provide_embed_link_not_direct_link.') }})</span>
        </div>
        <input type="text" name="video_url" id="video_url_input" value="{{ $product['video_url'] }}"
               placeholder="{{ translate('ex').': https://www.youtube.com/embed/5R06LRdUCSE' }}"
               class="form-control" required>
        <script>
            function updateVideoPlaceholder(provider) {
                const input = document.getElementById('video_url_input');
                if (provider === 'tiktok') {
                    input.placeholder = "{{ translate('ex') }} : https://www.tiktok.com/embed/v2/1234567890123456789";
                } else {
                    input.placeholder = "{{ translate('ex') }} : https://www.youtube.com/embed/5R06LRdUCSE";
                }
            }
            // Set initial placeholder
            document.addEventListener('DOMContentLoaded', function() {
                const select = document.querySelector('select[name="video_provider"]');
                updateVideoPlaceholder(select.value);
            });
        </script>
    </div>
</div>
