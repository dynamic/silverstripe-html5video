<?php

namespace Dynamic\HTML5Video\Tests\Pages;

use Dynamic\HTML5Video\Pages\Video;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\RequiredFields;

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
    public function testPopulateDefaults()
    {
        /** @var Video $object */
        $object = Injector::inst()->create(Video::class);
        $this->assertEquals(0, $object->ShowInMenus);
    }

    /**
     *
     */
    public function testGetCMSFields()
    {
        /** @var Video $object */
        $object = Injector::inst()->create(Video::class);
        $this->assertInstanceOf(FieldList::class, $object->getCMSFields());
    }

    /**
     *
     */
    public function testGetCMSValidator()
    {
        /** @var Video $object */
        $object = Injector::inst()->create(Video::class);
        $validator = $object->getCMSValidator();
        $this->assertInstanceOf(RequiredFields::class, $validator);
        $this->assertContains('MP4Video', $validator->getRequired());
    }

    public function testGetRelatedVideos()
    {
        /** @var Video $object */
        $object = Injector::inst()->create(Video::class);
        $this->assertFalse($object->getRelatedVideos());

        // TODO

        $this->markTestSkipped();
    }
}
