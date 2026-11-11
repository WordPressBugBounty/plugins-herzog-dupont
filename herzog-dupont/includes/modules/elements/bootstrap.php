<?php

/* Herzog Dupont for YOOtheme Pro Copyright (C) 2021-2026 Thomas Weidlich GNU GPL v3 */

namespace HerzogDupont;



use YOOtheme\Builder;
use YOOtheme\Config;
use YOOtheme\Path;
use YOOtheme\Theme\Styler\StylerConfig;

include_once __DIR__ . '/src/SettingsListener.php';
include_once __DIR__ . '/src/StyleListener.php';

return [

    'theme' => [
        'styles' => [
            'components' => [
                'hd-timeline' => Path::get('./assets/less/hd-timeline.less'),
            ],
        ],
    ],

    'events' => [

        // Add settings Panels
        'customizer.init' => [
            SettingsListener::class => 'initCustomizer',
        ],

        // Recompile LESS style on installation
        StylerConfig::class => [StyleListener::class => 'config'],

    ],

    'extend' => [

        Builder::class => function (Builder $builder, $app) {
            $knownElements = [
                'hd-counter',
                'hd-flipcard',
                'hd-image-comparison',
                'hd-lottie',
                'hd-progress',
                'hd-slideshow-grid',
                'hd-timeline',
                'hd-toggle',
            ];

            // Legacy elements ship element.json plus a companion element.php (transforms and
            // updates only) that YOOtheme merges automatically. Migrated elements ship a full
            // element.php and no element.json, so the JSON file decides which form is registered.
            $addElementType = function (string $key) use ($builder) {
                $dir = __DIR__ . '/elements/' . $key;

                if (is_file($dir . '/element.json')) {
                    $builder->addTypePath(Path::get('./elements/' . $key . '/element.json'));
                } elseif (is_file($dir . '/element.php')) {
                    $builder->addTypePath(Path::get('./elements/' . $key . '/element.php'));
                }
            };

            $savedElements = $app->config->get('~theme.hd.elements');

            if (is_null($savedElements)) {
                foreach (glob(__DIR__ . '/elements/*', GLOB_ONLYDIR) ?: [] as $dir) {
                    $addElementType(basename($dir));
                }
            } else {
                // Config may arrive as an object, so normalise before using array functions.
                $savedElements = (array) $savedElements;

                // Missing keys (new elements after an upgrade) keep the customizer default: enabled.
                $elementKeys = array_unique(array_merge($knownElements, array_keys($savedElements)));

                foreach ($elementKeys as $key) {
                    $enabled = !array_key_exists($key, $savedElements) || $savedElements[$key] === true;

                    if ($enabled) {
                        $addElementType($key);
                        if ($key === 'hd-timeline' || $key === 'hd-slideshow-grid') {
                            $addElementType($key . '_item');
                        }
                    }
                }
            }
        }

    ]

];
