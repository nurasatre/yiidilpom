<?php
/**
 * @var PostsView $this
 * @var array $mainPost
 * @var array $firstRightPosts
 * @var array $otherLeft
 * @var array $otherRight
 */

use common\helpers\PostsView;

?>

<div class="row posts-grid">
    <div class="section-heading">
        <h2 class="text-black">Блог</h2>
        <a href="#">Читати всi новини</a>
    </div>
    <div class="row mb-5">
        <div class="col-lg-3">
            <div class="post-entry-big main-attachment">
				<?php $this->renderPost( $mainPost ); ?>
            </div>
        </div>
        <div class="col-lg-9">
			<?php foreach ( $firstRightPosts as $firstRight ): ?>
                <div class="post-entry-big horizontal d-flex mb-4">
					<?php $this->renderPost( $firstRight ); ?>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
			<?php foreach ( $otherLeft as $left ): ?>
                <div class="post-entry-big horizontal d-flex mb-4">
					<?php $this->renderPost( $left ); ?>
                </div>
			<?php endforeach; ?>
        </div>
        <div class="col-lg-6">
			<?php foreach ( $otherLeft as $left ): ?>
                <div class="post-entry-big horizontal d-flex mb-4">
					<?php $this->renderPost( $left ); ?>
                </div>
			<?php endforeach; ?>
        </div>
    </div>
</div>