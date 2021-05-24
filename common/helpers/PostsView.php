<?php


namespace common\helpers;


use yii\web\View;

class PostsView extends View {

	public function renderPost( $source ) {
		if ( $source['__image_url'] ) : ?>
            <a href="<?= $source['__view_url'] ?>" class="img-link mr-4">
                <img src="<?= $source['__image_url'] ?>" alt="<?= $source['__image_title'] ?>"
                     class="img-fluid post-attachment">
            </a>
		<?php endif; ?>
        <div class="post-content">
            <div class="post-meta">
                <a href="#"><?= $source['created_at'] ?></a>
                <span class="mx-1">/</span>
                <a href="#"><?= $source['author'] ?></a>
            </div>
            <h3 class="post-heading"><a href="<?= $source['__view_url'] ?>"><?= strip_tags( $source['title'] ) ?></a></h3>
        </div>
		<?php
	}
}