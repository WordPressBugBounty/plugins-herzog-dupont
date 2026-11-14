<?php

/* Herzog Dupont for YOOtheme Pro Copyright (C) 2020-2026 Thomas Weidlich GNU GPL v3 */

if ($props['image_before']) : ?>
<figure>
	<img src="<?php echo $props['image_before'] ?>" alt="<?php echo $props['image_before_alt'] ?>">
	<?php if ($props['show_image_labels'] && $props['image_before_label']) : ?>
	<figcaption><?php echo $props['image_before_label'] ?></figcaption>
	<?php endif ?>
</figure>
<?php endif ?>
<?php if ($props['image_after']) : ?>
<figure>
	<img src="<?php echo $props['image_after'] ?>" alt="<?php echo $props['image_after_alt'] ?>">
	<?php if ($props['show_image_labels'] && $props['image_after_label']) : ?>
	<figcaption><?php echo $props['image_after_label'] ?></figcaption>
	<?php endif ?>
</figure>
<?php endif ?>