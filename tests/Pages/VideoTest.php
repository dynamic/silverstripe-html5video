<?php

namespace Dynamic\HTML5Video\Tests\Pages;

use Dynamic\HTML5Video\Pages\Video;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;

/**
 * Class VideoTest
 */
class VideoTest extends SapphireTest
{

    /**
     * @var string
     */
    protected static $fixture_file = '../html5video.yml';

    /**
     *
     */
    public function testGetCMSFields()
    {
        /** @var Video $object */
        $object = Injector::inst()->create(Video::class);
        $this->assertInstanceOf(FieldList::class, $object->getCMSFields());
    }
}
