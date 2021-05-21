<?php


namespace common\helpers;


use yii\widgets\Breadcrumbs;

class BreadCrumbsModify extends Breadcrumbs {

	public $tag = 'ol';

	/**
	 * @var string the template used to render each inactive item in the breadcrumbs. The token `{link}`
	 * will be replaced with the actual HTML link for each inactive item.
	 */
	public $itemTemplate = "<li class=\"breadcrumb-item\">{link}</li>\n";
	/**
	 * @var string the template used to render each active item in the breadcrumbs. The token `{link}`
	 * will be replaced with the actual HTML link for each active item.
	 */
	public $activeItemTemplate = "<li class=\"breadcrumb-item active\">{link}</li>\n";
}