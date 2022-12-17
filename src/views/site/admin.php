<?php

/** @var yii\web\View $this */
/** @var $decisions */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Admin panel';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-responsive">
    <h1 class="mt-5 mb-3">Решения</h1>
    <table class="table table-bordered table-hover text-nowrap"
           style="line-height: 18px;">
        <thead>
        <tr>
            <th>ID фото</th>
            <th>проверка</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($decisions as $decision): ?>
                <tr>
                    <td><a href=https://picsum.photos/id/<?= $decision->picture_id ?>/600/400><?= $decision->picture_id ?></a></td>
                    <td><?= $decision->decision === 'approve' ? 'Одобрено (approve)' : 'Отклонено (reject)' ?></td>
                    <td><form action="<?= Url::toRoute(['site/delete']) ?>" method="post">
                            <input type="hidden" name="picture_id" value ="<?= $decision->picture_id ?>">
                            <input type="hidden" name="method" value ="delete">
                            <input
                                    type="submit"
                                    value="отменить"
                                    name="отменить"

                            >
                        </form></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
