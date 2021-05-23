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

$this->title                   = $model->title;
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

<section class="page-comments-form">
	<?php if ( \Yii::$app->user->isGuest ): ?>
        <p>Please log in to leave a comment.</p>
	<?php else: ?>
        <form action="<?= $url->createAbsoluteUrl( [ 'comments/add-new' ] ) ?>" method="post">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>"
                   value="<?= Yii::$app->request->getCsrfToken(); ?>"/>
            <input type="hidden" name="comment[post_id]" value="<?= $model->id ?>">
            <input type="hidden" name="comment[author]" value="<?= \Yii::$app->user->getId() ?>">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="comment_text">Leave your comment</label>
                    <input type="text" id="comment_text" name="comment[comment_text]"
                           class="form-control form-control-lg">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="submit" value="Save" class="btn btn-primary btn-lg px-5">
                </div>
            </div>
        </form>
	<?php endif; ?>
</section>

<section class="page-comments-list">

</section>

<section class="page-meta">

</section>

