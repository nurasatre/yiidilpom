<?php
/** @var $item array */
?>
<a class="nav-link collapsed" href="<?= $item['url'] ?>"
   data-toggle="collapse" data-target="#collapse_<?= $item['slug'] ?>" aria-expanded="false"
   aria-controls="collapse_<?= $item['slug'] ?>">
	<div class="sb-nav-link-icon"><i class="<?= $item['icon'] ?>"></i></div>
	Pages
	<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapse_<?= $item['slug'] ?>" aria-labelledby="headingTwo"
     data-parent="#sidenavAccordion">
	<nav class="sb-sidenav-menu-nested nav accordion">
		<?php foreach ( $item['children'] as $link ): ?>
			<a class="nav-link" href="<?= $link['url'] ?>">
				<?= $link['label'] ?>
			</a>
		<?php endforeach; ?>
	</nav>
</div>