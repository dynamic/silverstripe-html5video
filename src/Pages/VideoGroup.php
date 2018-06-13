<?php

namespace Dynamic\HTML5Video\Pages;

use Page;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataList;

/**
 * Class VideoGroup
 * @package Dynamic\HTML5Video\Pages
 */
class VideoGroup extends Page
{
	/**
	 * @var array
	 */
	private static $allowed_children = [
		VideoGroup::class,
		Video::class,
	];

	/**
	 * @var int
	 */
	private static $page_length = 12;

	/**
	 * @var string
	 */
	private static $pagination_get_var = 's';

	/**
	 * @var bool
	 */
	protected static $include_child_groups = true;

	/**
	 * @var string
	 */
	private static $description = 'Videos Landing Page';

	/**
	 * @var string
	 */
	private static $table_name = 'VideoGroup';

	/**
	 * Method that returns child VideoGroup pages.
	 * By default it only shows those with ShowInMenus
	 * set to true, but can be overridden to show all
	 * VideoGroup children regardless of ShowInMenus.
	 *
	 * @param bool $all
	 *
	 * @return ArrayList
	 */
	public function getChildGroups($all = false)
	{
		return ($all === false)
			? $this->Children()->filter('ClassName', VideoGroup::class)
			: $this->AllChildren()->filter('ClassName', VideoGroup::class);
	}

	/**
	 * Method that returns an array of ID's
	 * of the VideoGroup pages beneath the current one
	 *
	 * @access public
	 * @param bool $all
	 *
	 * @return array
	 */
	public function getVideoGroupIDs($all = false)
	{
		return $this->getChildGroups($all)->column('ID');
	}

	/**
	 * Method that returns a DataList of all
	 * Video pages in the current VideoGroup
	 * and all child VideoGroup pages.
	 * Note: this isn't recursive through child
	 * VideoGroup pages of the current VideoGroup
	 * page.
	 *
	 * @access public
	 * @param bool $all
	 *
	 * @return DataList
	 */
	public function getVideoList($all = false)
	{
		$groupIDS = $this->getVideoGroupIDS($all);
		$groupIDS[] = $this->ID;
		return Video::get()->filter('ParentID', $groupIDS);

	}
}
