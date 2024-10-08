<?php

/* Herzog Dupont for YOOtheme Pro Copyright (C) 2019-2023 Thomas Weidlich GNU GPL v3 */

$el = $this->el('div', [

    'class' => [
        'hd-lottie'
    ],

]);

$lottie = $this->el('div', [

    'class' => [
        'el-lottie'
    ],

    'data-name' => $props['animation-name'] ?? uniqid('hd-'),
    'data-animation-path' => realpath($props['path']) ? '/' . $props['path'] : $props['path'],
    'data-renderer' => $props['renderer'],
    'data-preserve-aspect-ratio-alignment-value' => $props['preserve-aspect-ratio-alignment-value'],
    'data-preserve-aspect-ratio-reference' => $props['preserve-aspect-ratio-reference'],
    'data-trigger' => $props['trigger'],
    'data-offset-top' => $props['offset-top'],
    'data-loop' => $props['loop'],
    'data-speed' => $props['speed'],
    'data-on-mouseleave' => $props['on-mouseleave'],
    'data-animation-start' => $props['animation-start'],
    'data-animation-end' => $props['animation-end'],

]);

// Link and Lightbox
$link = $this->el('a', [

    'class' => [
        'el-link',

    ],

    'href' => ['{link}'],
    'target' => ['_blank {@link_target: blank}'],
    'uk-scroll' => str_starts_with((string) $props['link'], '#'),

    // Target Modal?
    'uk-toggle' => $props['link_target'] === 'modal',
]);

if ($props['link'] && $props['link_target'] === 'modal') {

    $target = $this->el('image', [
        'src' => $props['link'],
        'width' => $props['lightbox_width'],
        'height' => $props['lightbox_height'],
    ]);

    if ($this->isImage($props['link'])) {

        $lightbox = $target($props, [
            'focal_point' => $props['lightbox_image_focal_point'],
            'thumbnail' => true,
        ]);

    } else {

        $video = $this->isVideo($props['link']);
        $iframe = $this->iframeVideo($props['link'], [], false);
        $lightbox = $video && !$iframe ? $target($props, [

            // Video
            'controls' => true,
            'uk-video' => true,

        ], '', 'video') : $target($props, [

            // Iframe
            'src' => $iframe ?: $props['link'],
            'frameborder' => 0,
            'uk-video' => $video || $iframe,
            'allowfullscreen' => true,
            'uk-responsive' => true,

        ], '', 'iframe');

    }

    $connect_id = "js-{$this->uid()}";
    $props['link'] = "#{$connect_id}";
}

?>

<?php echo $el($props, $attrs) ?>

    <?php if ($props['link']) : ?>
    <?php echo $link($props) ?>
    <?php endif ?>
    <?php echo $lottie($props) ?></div>
    <?php if ($props['link']) : ?>
    <?php echo $link->end() ?>

    <?php if ($props['link_target'] === 'modal') : ?>
    <?php // uk-flex-top is needed to make vertical margin work for IE11 ?>
    <div id="<?php echo $connect_id ?>" class="uk-flex-top" uk-modal>
        <div class="uk-modal-dialog uk-width-auto uk-margin-auto-vertical">
            <button class="uk-modal-close-outside" type="button" uk-close></button>
            <?php echo $lightbox ?>
        </div>
    </div>
    <?php endif ?>
    <?php endif ?>

</div>
