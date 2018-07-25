<?php

namespace Dynamic\HTML5Video\Pages;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Config\Config;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\ORM\PaginatedList;

/**
 * Class VideoGroup_Controller
 * @package Dynamic\HTML5Video\Pages
 *
 * @mixin \Dynamic\HTML5Video\Pages\VideoGroup
 */
class VideoGroup_Controller extends \PageController
{
    /**
     * @var array
     */
    private static $allowed_actions = [
        'index',
    ];

    /**
     *
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @param HTTPRequest $request
     * @return array|DBHTMLText
     */
    public function index(HTTPRequest $request)
    {

        $videos = PaginatedList::create(
            $this->getVideoList(),
            $request
        )->setPageLength(Config::inst()->get(VideoGroup::class, 'page_length'))
            ->setPaginationGetVar(Config::inst()->get(VideoGroup::class, 'pagination_get_var'));

        $data = [
            'VideoList' => $videos,
        ];

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
        return $this->getChildGroups($all);
    }
}
