<?php

/**
 * @var $this yii\web\View
 * @var $model BaseModel
 */

use common\models\BaseModel;

$this->title = 'Posts Index';

$this->registerCssFile(
	'https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css'
);
$this->registerJsFile(
	'https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js',
	[ 'depends' => [ \yii\web\JqueryAsset::class ] ]
);
$this->registerJsFile(
	'https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js',
	[ 'depends' => [ \yii\web\JqueryAsset::class ] ]
);
$this->registerJsFile(
	'@web/js/dist/pages.index.js',
	[ 'depends' => [ \yii\web\JqueryAsset::class ] ]
);
$url = \Yii::$app->urlManager;
?>
<div class="site-index">
    <div class="body-content">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th scope="col">Actions</th>
					<?php foreach ( $model as $name => $value ): ?>
                        <th scope="col"><?= $model->getAttributeLabel( $name ) ?></th>
					<?php endforeach; ?>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th scope="col">Actions</th>
					<?php foreach ( $model as $name => $value ): ?>
                        <th scope="col"><?= $model->getAttributeLabel( $name ) ?></th>
					<?php endforeach; ?>
                </tr>
                </tfoot>
                <tbody>
				<?php foreach ( $posts as $post ): ?>
                    <tr>
                        <td style="display: flex; justify-content: space-evenly; align-items: flex-start;">
                            <a href="<?= $url->createAbsoluteUrl( [ "posts/edit/{$post['id']}" ] ) ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="" onclick="if ( confirm( 'Are you sure?' ) ) {
                                    this.href = '<?= $url->createAbsoluteUrl( [ "posts/delete/{$post['id']}" ] ) ?>';
                                    }">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
						<?php foreach ( $model as $name => $value ): ?>
                            <td><?= $model->formatAttribute( $name, $post ) ?></td>
						<?php endforeach; ?>
                    </tr>
				<?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>