<?php
/**
 * @var $this View
 * @var $model Pages
 * @var $image Files
 */

use common\models\Files;
use common\models\Pages;
use yii\helpers\Url;
use yii\web\View;

$this->title                   = strip_tags( $model->title );
$this->params['breadcrumbs'][] = array(
	'label' => 'Сторінки',
	'url'   => Url::toRoute( '/pages/' )
);
$this->params['breadcrumbs'][] = array(
	'label' => $this->title,
	'url'   => Url::toRoute( "/pages/view/{$model->id}" )
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

