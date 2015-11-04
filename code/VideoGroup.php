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
    protected static $page_length = 12;

    /**
     * @var bool
     */
    protected static $include_child_groups = true;

    /**
     * @var string
     */
    private static $description = 'Videos Landing Page';


    /**
     * loadDescendantVideoGroupIDListInto function.
     *
     * @access public
     * @param mixed &$idList
     * @return void
     */
    public function loadDescendantVideoGroupIDListInto(&$idList)
    {
        if ($children = $this->AllChildren()) {
            foreach ($children as $child) {
                if (in_array($child->ID, $idList)) {
                    continue;
                }

                if ($child instanceof VideoGroup) {
                    $idList[] = $child->ID;
                    $child->loadDescendantVideoGroupIDListInto($idList);
                }
            }
        }
    }


    /**
     * VideoGroupIDs function.
     *
     * @access public
     * @return void
     */
    public function VideoGroupIDs()
    {
        $holderIDs = array();
        $this->loadDescendantVideoGroupIDListInto($holderIDs);
        return $holderIDs;
    }

    /**
     * Videos function.
     *
     * @access public
     * @return PaginatedList
     */
    public function getVideoList()
    {

        $filter = '"ParentID" = ' . $this->ID;
        $limit = 3;

        // Build a list of all IDs for VideoGroups that are children
        $holderIDs = $this->VideoGroupIDs();

        if ($holderIDs) {
            if ($filter) {
                $filter .= ' OR ';
            }
            $filter .= '"ParentID" IN (' . implode(',', $holderIDs) . ")";
        }

        $order = '"SiteTree"."Title" ASC';

        $entries = Video::get()->where($filter)->sort($order);

        $list = new PaginatedList($entries, Controller::curr()->request);
        $list->setPageLength($limit);
        return $list;

    }


    /**
     * old display function
     *
     * @return DataList
     */
    public function ShowVideos()
    {

        $filter = '';

        $limit = (isset($_GET['start']) && (int)$_GET['start'] > 0) ? (int)$_GET['start'] . "," . self::$page_length : "0," . self::$page_length;
        $sort = (isset($_GET['sortby'])) ? Convert::raw2sql($_GET['sortby']) : "\"Title\"";

        $groupids = array($this->ID);

        if (self::$include_child_groups && $childgroups = $this->ChildGroups(true)) {
            $groupids = array_merge($groupids, $childgroups->map('ID', 'ID'));
        }

        $groupidsimpl = implode(',', $groupids);

        $join = $this->getManyManyJoin('Videos', 'Video');
        $multicatfilter = $this->getManyManyFilter('Videos', 'Video');

        //TODO: get products that appear in child groups (make this optional)

        $products = DataObject::get('Video', "(\"ParentID\" IN ($groupidsimpl) OR $multicatfilter) $filter", $sort,
            $join, $limit);

        $allproducts = DataObject::get('Video', "\"ParentID\" IN ($groupidsimpl) $filter", "", $join);

        if ($allproducts) {
            $products->TotalCount = $allproducts->Count();
        } //add total count to returned data for 'showing x to y of z products'
        if ($products && $products instanceof DataObjectSet) {
            $products->removeDuplicates();
        }


        return $products;

    }

    /**
     * @param bool|false $recursive
     * @return DataList|mixed|null
     */
    public function ChildGroups($recursive = false)
    {
        if ($recursive) {
            if ($children = DataObject::get('VideoGroup', "\"ParentID\" = '$this->ID'")) {
                $output = unserialize(serialize($children));
                foreach ($children as $group) {
                    $output->merge($group->ChildGroups($recursive));
                }
                return $output;
            }
            return null;
        } else {
            return DataObject::get('VideoGroup', "\"ParentID\" = '$this->ID'");
        }
    }

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        /*$fields->addFieldToTab("Root.Content.Videos", new FileDataObjectManager(
           $this,
           'Videos',
           'Video',
           'Video',
           array('Title' => 'Title', 'Description' => 'Description'),
           new FieldSet(
              new TextField('Title'),
              new TextareaField('Description')
           )
        )); */
        return $fields;
    }


}

class VideoGroup_Controller extends Page_Controller
{

    /**
     *
     */
    public function GroupVideos()
    {

        //return $this->ShowVideos();
    }

    /**
     * @return mixed
     */
    public function SubGroups()
    {
        return $this->ChildGroups();
    }


}