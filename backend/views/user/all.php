<?php

/**
 * @var $this yii\web\View
 * @var $model User
 * @var $users array[]
 */

use common\models\User;

$this->title = 'Users';
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
					<?php foreach ( $model->iterateAttributes() as $name ): ?>
                        <th scope="col"><?= $model->getAttributeLabel( $name ) ?></th>
					<?php endforeach; ?>
                </tr>
                </thead>
                <tfoot>
                <tr>
					<?php foreach ( $model->iterateAttributes() as $name ): ?>
                        <th scope="col"><?= $model->getAttributeLabel( $name ) ?></th>
					<?php endforeach; ?>
                </tr>
                </tfoot>
                <tbody>
				<?php foreach ( $users as $post ): ?>
                    <tr>
						<?php foreach ( $model->iterateAttributes() as $name ): ?>
                            <td><?= $model->formatAttribute( $name, $post ) ?></td>
						<?php endforeach; ?>
                    </tr>
				<?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>