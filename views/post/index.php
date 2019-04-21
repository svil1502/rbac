<?php
/**
 * Created by PhpStorm.
 * User: svetlanailina
 * Date: 2019-04-19
 * Time: 18:46
 */
if (count($model)): ?>
<?php foreach($model as $item): ?>
<div class="well">
    <h3><?= $item->title ?></h3>
    <p><?= $item->description ?></p>
</div>
<?php endforeach; ?>
<?php endif; ?>

