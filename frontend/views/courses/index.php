<?php
/**
 * @var View $this
 * @var array $courses
 */

use yii\web\View;

$this->registerCssFile( '@web/css/courses/index.css' );
?>

<div class="nur-container">
    <div class="nur-title">Матеріали курсів</div>
    <div class="nur-line"></div>
    <div class="nur-cards">
		<?php foreach ( $courses as $course ): ?>
            <div class="nur-cards-item">
                <div class="nur-card-item-top">
                    <div class="nur-card-title"><?= $course['title'] ?></div>
                    <div class="nur-card-text"><?= $course['desc'] ?></div>
                </div>
				<?php if ( isset( $course['__download_link'] ) ): ?>
                    <div class="nur-card-item-bottom">
                        <div class="nur-card-line"></div>
                        <a href="<?= $course['__download_link'] ?>" class="nur-card-link">Завантажити матеріал</a>
                    </div>
				<?php endif; ?>
            </div>
		<?php endforeach; ?>
    </div>
</div>
