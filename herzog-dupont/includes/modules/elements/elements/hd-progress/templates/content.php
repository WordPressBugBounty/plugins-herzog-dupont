<?php

/* Herzog Dupont for YOOtheme Pro Copyright (C) 2018-2026 Thomas Weidlich GNU GPL v3 */

if ($props['content']) : ?>
<div><?php echo $props['content'] ?></div>
<?php endif ?>
<progress value="<?php echo (float) $props['stop'] ?>" max="<?php echo (float) $props['max'] ?>"><?php echo (float) $props['stop'] ?>/<?php echo (float) $props['max'] ?></progress>
