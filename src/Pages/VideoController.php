<?php

namespace Dynamic\HTML5Video\Pages;

use SilverStripe\View\Requirements;

/**
 * Class VideoController
 * @package Dynamic\HTML5Video\Pages
 */
class VideoController extends \PageController
{
    public function init()
    {
        parent::init();

        Requirements::css(VIDEO_DIR . '/thirdparty/video-js/video-js.min.css');
        Requirements::javascript(VIDEO_DIR . '/thirdparty/video-js/video.min.js');
    }
}
