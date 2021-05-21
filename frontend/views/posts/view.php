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

<section class="page-meta">

</section>

