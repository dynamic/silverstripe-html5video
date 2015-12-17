<?php

/**
 * Class VideoGroup
 * @package html5video
 */
class VideoGroup extends Page
{

    /**
     * @var array
     */
    private static $belongs_many_many = array(
        'Videos' => 'Video'
    );

    /**
     * @var array
     */
    private static $allowed_children = array(
        'VideoGroup',
        'Video'
    );

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
            ? $this->Children()->filter('ClassName', 'VideoGroup')
            : $this->AllChildren()->filter('ClassName', 'VideoGroup');
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

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();


        $this->extend('updateCMSFields', $fields);

        return $fields;
    }


}

class VideoGroup_Controller extends Page_Controller
{

    /**
     * @var array
     */
    private static $allowed_actions = array(
        'index',
    );

    /**
     *
     */
    public function init()
    {
        parent::init();

    }

    /**
     * @param SS_HTTPRequest $request
     * @return array|HTMLText
     */
    public function index(SS_HTTPRequest $request)
    {

        $videos = PaginatedList::create(
            $this->data()->getVideoList(),
            $request
        )->setPageLength(Config::inst()->get('VideoGroup', 'page_length'))
            ->setPaginationGetVar(Config::inst()->get('VideoGroup', 'pagination_get_var'));

        $data = array(
            'VideoList' => $videos
        );

        if ($request->isAjax()) {
            return $this->customise($data)->renderWith('VideoList');
        }

        return $data;
    }

    /**
     * Method called from the layout that can be passed
     * a boolean variable to override the default behavior
     * of getChildGroups().
     *
     * @param bool $all
     *
     * @return ArrayList
     */
    public function SubGroups($all = false)
    {
        return $this->data()->getChildGroups($all);
    }


}