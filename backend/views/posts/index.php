<?php

/* @var $this yii\web\View */

$this->title = 'Posts Index';
$this->registerCssFile(
    'https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css'
);
$this->registerJsFile(
    'https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    'https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/dist/pages.index.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$url = \Yii::$app->urlManager;
?>
<div class="site-index">
    <div class="body-content">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <?php foreach ($model as $name => $value): ?>
                        <th scope="col"><?= $model->getAttributeLabel($name) ?></th>
                    <?php endforeach; ?>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <?php foreach ($model as $name => $value): ?>
                        <th scope="col"><?= $model->getAttributeLabel($name) ?></th>
                    <?php endforeach; ?>
                    <th scope="col">Actions</th>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <?php foreach ($model as $name => $value): ?>
                            <td><?= $post[$name] ?></td>
                        <?php endforeach; ?>
                        <td><a href="<?=$url->createAbsoluteUrl(["posts/edit/{$post['id']}"])?>">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>