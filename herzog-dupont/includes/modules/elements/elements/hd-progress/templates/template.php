<?php

/* Herzog Dupont for YOOtheme Pro Copyright (C) 2018-2026 Thomas Weidlich GNU GPL v3 */

// The colours are printed into a style block. Only characters that a CSS colour needs are
// kept, so a value cannot end the declaration or the block.
foreach (['progress_value_color', 'progress_background_color'] as $key) {
    $props[$key] = preg_replace('/[^#\w\s(),.%\/+-]/', '', (string) $props[$key]);
}

$uniqid = false;

if ($props['progress_value_color'] || $props['progress_background_color'])
    $uniqid = uniqid('hd-progress-');

$el = $this->el('div', [

    'class' => [
        'hd-progress',
    ],

]);

$progress = $this->el('progress', [

    'id' => [
        $uniqid => $uniqid,
    ],

    'class' => [
        'uk-progress',
    ],

    // Start and stop value are passed as they are. An expression such as '{start}' is
    // dropped when its value is 0, which is a valid value for both.
    'value' => $props['start'],

    'max' => [
        '{max}',
    ],

    'data-stop' => $props['stop'],

    'data-step' => [
        '{animation_step}',
    ],

    'data-speed' => [
        '{animation_speed}',
    ]

]);

?>

<?php echo $el($props, $attrs) ?>

    <?php if ($uniqid) : ?>
    <style>
    <?php if ($props['progress_value_color']) : ?>
    #<?php echo $uniqid ?>.uk-progress::-webkit-progress-value {
        background-color: <?php echo $props['progress_value_color'] ?>;
    }

    #<?php echo $uniqid ?>.uk-progress::-moz-progress-bar {
        background-color: <?php echo $props['progress_value_color'] ?>;
    }

    #<?php echo $uniqid ?>.uk-progress::-ms-fill {
        background-color: <?php echo $props['progress_value_color'] ?>;
    }
    <?php endif ?>

    <?php if ($props['progress_background_color']) : ?>
    #<?php echo $uniqid ?>.uk-progress {
        background-color: <?php echo $props['progress_background_color'] ?>;
    }

    #<?php echo $uniqid ?>.uk-progress::-webkit-progress-bar {
        background-color: <?php echo $props['progress_background_color'] ?>;
    }
    <?php endif ?>
    </style>
    <?php endif ?>

    <?php if ($props['content']) : ?>
    <div><?php echo $props['content'] ?></div>
    <?php endif ?>

    <?php echo $progress($props) ?>
        <?php echo (float) $props['stop'] ?>/<?php echo (float) $props['max'] ?>
    <?php echo $progress->end() ?>

</div>
