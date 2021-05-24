<?php

/* @var $this View */

/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;
use common\helpers\BreadCrumbsModify;

AppAsset::register( $this );
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode( $this->title ) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	<?php
	$menuItems = [
		[ 'label' => 'Головна', 'url' => [ '/site/index' ] ],
		[ 'label' => 'Про нас', 'url' => [ '/pages/view/33' ] ],
		[ 'label' => 'Послуги', 'url' => [ '/site/service' ] ],
		[ 'label' => 'Блог', 'url' => [ '/posts' ] ],
		[ 'label' => 'Контакти', 'url' => [ '/site/contact' ] ],
	];
	if ( Yii::$app->user->isGuest ) {
		$menuItems[] = [ 'label' => 'Signup', 'url' => [ '/site/signup' ] ];
		$menuItems[] = [ 'label' => 'Login', 'url' => [ '/site/login' ] ];
	} else {
		$menuItems[] = '<li>'
		               . Html::beginForm( [ '/site/logout' ], 'post' )
		               . Html::submitButton(
				'Вийти (' . Yii::$app->user->identity->username . ')',
				[ 'class' => 'btn btn-link logout' ]
			)
		               . Html::endForm()
		               . '</li>';
	}
	?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>"><?= Yii::$app->name ?></a>
            <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavAltMarkup">
                <div class="navbar-nav d-flex align-items-center">
					<?php foreach ( $menuItems as $menuItem ): ?>
						<?php if ( isset( $menuItem['url'] ) ): ?>
                            <a class="nav-link <?= $menuItem['url'] === $this->context->route ? 'active' : '' ?>"
                               href="<?= \Yii::$app->urlManager->createAbsoluteUrl( $menuItem['url'] ) ?>">
								<?= $menuItem['label'] ?>
                            </a>
						<?php else: echo $menuItem; ?>
						<?php endif; ?>
					<?php endforeach; ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
		<?= BreadCrumbsModify::widget( [
			                         'links'    => isset( $this->params['breadcrumbs'] ) ? $this->params['breadcrumbs'] : [],
			                         'homeLink' => [
				                         'label' => 'Головна',
				                         'url'   => \yii\helpers\Url::to( '/' )
			                         ],
		                         ] ) ?>
		<?= Alert::widget() ?>
		<?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode( Yii::$app->name ) ?> <?= date( 'Y' ) ?></p>

        <p class="pull-right">Powered by noora</p>
    </div>
</footer>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>
