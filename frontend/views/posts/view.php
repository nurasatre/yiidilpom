<?php
/**
 * @var $this View
 * @var $model Posts
 * @var $image Files
 */

use common\models\Files;
use common\models\Posts;
use yii\helpers\Url;
use yii\web\View;

$this->title                   = strip_tags( $model->title );
$this->params['breadcrumbs'][] = array(
	'label' => 'Блог',
	'url'   => Url::toRoute( '/posts' )
);
$this->params['breadcrumbs'][] = array(
	'label' => $this->title,
);

[ $urlImage, $image ] = $model->attachment_url();
$url = \Yii::$app->urlManager;


?>

<div class="page-title">
    <h1><?= $model->title ?></h1>
</div>
<section class="page-wrapper">
	<?php if ( $urlImage ) : ?>
        <section class="page-attachment">
            <h2>
                <i class="date"><?= $image->formatAttribute( 'title' ) ?></i>
            </h2>
            <img src="<?= $urlImage ?>" alt="attachment-image"/>
        </section>
	<?php endif; ?>

    <section class="page-content">
		<?= $model->content ?>
    </section>
</section>

<section class="page-comments">
	<?php if ( \Yii::$app->user->isGuest ): ?>
        <p>Please log in to leave a comment.</p>
	<?php else:
		$this->registerJsVar( 'currentPageConfig', $comments );
		$this->registerJsFile(
			'@web/js/dist/post-view.bundle.js',
			[ 'depends' => [ \yii\web\JqueryAsset::class ] ]
		);
		?>
        <div id="commentsForm"></div>
	<?php endif; ?>
</section>

<section class="page-meta">

</section>

