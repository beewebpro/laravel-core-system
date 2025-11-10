<?php

return [
  'enable_version' => env('ASSETS_ENABLE_VERSION', false),
  'scripts' => [],
  'styles' => [],
  'resources' => [
    'scripts' => [
      'vue-init' => [
        'use_cdn' => false,
        'location' => 'header',
        'src' => [
          'local' => '/vendor/core/core/base/js/vue-init.js',
        ],
      ],
    ],
    'styles' => [],
  ],
];
