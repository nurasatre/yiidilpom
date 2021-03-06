<?php


namespace common\helpers;


use yii\helpers\Html;

class AdminMenu {

	public static $item;

	public static function getItems(): array {
		$url        = \Yii::$app->urlManager;
		$logoutForm = Html::beginForm( [ '/site/logout' ], 'post' ) . Html::submitButton(
				'Logout (' . \Yii::$app->user->identity->username . ')',
				[ 'class' => 'nav-link' ] ) . Html::endForm();


		return [
			[
				'type'  => 'heading',
				'label' => 'Core'
			],
			[
				'type'  => 'link',
				'icon'  => 'fas fa-user-circle',
				'label' => 'Profile',
				'url'   => $url->createAbsoluteUrl( [ 'user' ] ),
			],
			[
				'type'  => 'link',
				'icon'  => 'fas fa-user-friends',
				'label' => 'Users',
				'url'   => $url->createAbsoluteUrl( [ 'user/all' ] ),
			],
			[
				'type'  => 'heading',
				'label' => 'Interface'
			],
			[
				'type'     => 'link',
				'slug'     => 'pages',
				'label'    => 'Pages',
				'icon'     => 'fas fa-book-open',
				'url'      => $url->createAbsoluteUrl( [ 'pages' ] ),
				'children' => [
					[
						'slug'  => 'pageIndex',
						'label' => 'View All',
						'url'   => $url->createAbsoluteUrl( [ 'pages' ] ),
					],
					[
						'slug'  => 'pagesCreate',
						'label' => 'Add New',
						'url'   => $url->createAbsoluteUrl( [ 'pages/create' ] ),
					],
				]
			],
			[
				'type'     => 'link',
				'slug'     => 'posts',
				'label'    => 'Posts',
				'icon'     => 'far fa-newspaper',
				'url'      => $url->createAbsoluteUrl( [ 'posts' ] ),
				'children' => [
					[
						'slug'  => 'postsIndex',
						'label' => 'View All',
						'url'   => $url->createAbsoluteUrl( [ 'posts' ] ),
					],
					[
						'slug'  => 'postsCreate',
						'label' => 'Add New',
						'url'   => $url->createAbsoluteUrl( [ 'posts/create' ] ),
					],
				]
			],
			[
				'type'  => 'link',
				'icon'  => 'fas fa-comments',
				'label' => 'Comments',
				'url'   => $url->createAbsoluteUrl( [ 'comments' ] ),
			],
			[
				'type'  => 'link',
				'icon'  => 'far fa-file-image',
				'label' => 'Files',
				'url'   => $url->createAbsoluteUrl( [ 'files' ] ),
			],
			[
				'type'     => 'link',
				'icon'     => 'fas fa-atlas',
				'slug'     => 'courses',
				'label'    => 'Courses',
				'url'      => $url->createAbsoluteUrl( [ 'courses' ] ),
				'children' => [
					[
						'slug'  => 'coursesIndex',
						'label' => 'View All',
						'url'   => $url->createAbsoluteUrl( [ 'courses' ] ),
					],
					[
						'slug'  => 'coursesCreate',
						'label' => 'Add New',
						'url'   => $url->createAbsoluteUrl( [ 'courses/create' ] ),
					],
				]
			],
		];
	}

	public static function renderItem( $item ): string {
		self::$item = $item;

		switch ( $item['type'] ) {
			case 'heading':
				return self::getView( 'heading.php' );
			case 'link':
				return isset( $item['children'] ) && $item['children']
					? self::getView( 'link-collapse.php' )
					: self::getView( 'link.php' );
			default:
				return '';
		}
	}

	public static function renderItems( $menuItems = array() ): string {
		if ( ! $menuItems ) {
			$menuItems = self::getItems();
		}
		$response = array();

		foreach ( $menuItems as $item ) {
			$response[] = self::renderItem( $item );
		}

		return implode( "\n\r", $response );
	}

	public static function getView( $name ) {
		$item = self::$item;

		ob_start();
		include __DIR__ . "/views/{$name}";

		return ob_get_clean();
	}

}