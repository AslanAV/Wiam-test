<?php

/** @var yii\web\View $this */
/** @var $error */
/** @var $picture_id */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Сервис выбора фотографий</h1>
        <?php if ($error !== ''): ?>
            <p class="lead"><?= $error ?></p>
        <?php else: ?>
            <img src="../../web/images/picture.jpg" alt="Картинка">
            <div class="container">
                    <div class="d-inline-block">
                        <form action="<?= Url::toRoute(['site/create']) ?>" method="post">
                            <input type="hidden" name="picture_id" value ="<?= $picture_id ?>">
                            <input type="hidden" name="decision" value ="reject">
                            <input
                                    type="submit"
                                    value="Отклонить"
                                    name="Отклонить"
                                    class="btn btn-lg btn-danger m-4 block"
                            >
                        </form>
                    </div>
                    <div class="d-inline-block">
                        <form action="<?= Url::toRoute(['site/create']) ?>" method="post">
                            <input type="hidden" name="picture_id" value ="<?= $picture_id ?>">
                            <input type="hidden" name="decision" value ="approve">
                            <input
                                    type="submit"
                                    value="Одобрить"
                                    name="Одобрить"
                                    class="btn btn-lg btn-success m-4 block"
                                >
                        </form>
                    </div>
            </div>
        <?php endif; ?>
    </div>
</div>
