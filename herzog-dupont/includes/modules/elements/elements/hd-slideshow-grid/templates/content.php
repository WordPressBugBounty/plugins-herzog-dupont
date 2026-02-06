<?php

/* Herzog Dupont for YOOtheme Pro Copyright (C) 2016-2026 YOOtheme GmbH, 2021-2026 Thomas Weidlich GNU GPL v3 */

if (count($children) > 1) : ?>
<ul>
    <?php foreach ($children as $child) : ?>
    <li>

        <?php echo $builder->render($child, ['element' => $props]) ?>

    </li>
    <?php endforeach ?>
</ul>
<?php elseif (count($children) == 1) : ?>
<div>

    <?php echo $builder->render($children[0], ['element' => $props]) ?>

</div>
<?php endif ?>
