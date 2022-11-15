<?php
if (!isset($widgets)) {
    exit('The $widgets is not set!');
}
?>
<p>Loaded widgets:</p>
<?php foreach ($widgets as $widget) { ?>
    <p><?php $widget->draw() ?></p>
<?php } ?>
