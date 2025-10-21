<script>
    "use strict";
    var MEDIA_URL = {{ Js::from(Media::getUrls()) }}
    var MEDIA_CONFIG =
        {{ Js::from([
            'permissions' => Media::getPermissions(),
            'translations' => trans('core/media::media.javascript'),
            'pagination' => [
                'paged' => Media::getConfig('pagination.paged'),
                'posts_per_page' => Media::getConfig('pagination.per_page'),
                'in_process_get_media' => false,
                'has_more' => true,
            ],
            'chunk' => Media::getConfig('chunk'),
            'random_hash' => null,
            'default_image' => Media::getDefaultImage(),
        ]) }}

    MEDIA_CONFIG.translations.actions_list.other.properties =
        '{{ trans('core/media::media.javascript.actions_list.other.properties') }}';
</script>
