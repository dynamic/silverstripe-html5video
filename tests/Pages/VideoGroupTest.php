<?php

namespace Dynamic\HTML5VideoGroup\Tests\Pages;

use Dynamic\HTML5Video\Pages\VideoGroup;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Security\Member;

/**
 * Class VideoGroupTest
 * @package Dynamic\HTML5VideoGroup\Tests
 */
class VideoGroupTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = '../html5video.yml';

    /**
     *
     */
    public function testCanView()
    {
        /** @var VideoGroup $object */
        $object = Injector::inst()->create(VideoGroup::class);

        /** @var Member $admin */
        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canView($admin));

        /** @var Member $siteowner */
        $siteowner = $this->objFromFixture(Member::class, 'site-owner');
        $this->assertTrue($object->canView($siteowner));

        /** @var Member $member */
        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canView($member));
    }

    /**
     *
     */
    public function testCanEdit()
    {
        /** @var VideoGroup $object */
        $object = Injector::inst()->create(VideoGroup::class);

        /** @var Member $admin */
        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canEdit($admin));

        /** @var Member $siteowner */
        $siteowner = $this->objFromFixture(Member::class, 'site-owner');
        $this->assertTrue($object->canEdit($siteowner));

        /** @var Member $member */
        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canEdit($member));
    }

    /**
     *
     */
    public function testCanDelete()
    {
        /** @var VideoGroup $object */
        $object = Injector::inst()->create(VideoGroup::class);

        /** @var Member $admin */
        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canDelete($admin));

        /** @var Member $siteowner */
        $siteowner = $this->objFromFixture(Member::class, 'site-owner');
        $this->assertTrue($object->canDelete($siteowner));

        /** @var Member $member */
        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canDelete($member));
    }

    /**
     *
     */
    public function testCanCreate()
    {
        /** @var VideoGroup $object */
        $object = Injector::inst()->create(VideoGroup::class);

        /** @var Member $admin */
        $admin = $this->objFromFixture(Member::class, 'admin');
        $this->assertTrue($object->canCreate($admin));

        /** @var Member $siteowner */
        $siteowner = $this->objFromFixture(Member::class, 'site-owner');
        $this->assertTrue($object->canCreate($siteowner));

        /** @var Member $member */
        $member = $this->objFromFixture(Member::class, 'default');
        $this->assertFalse($object->canCreate($member));
    }

    /**
     *
     */
    public function testChildGroups()
    {
        /** @var VideoGroup $videoGroup */
        $videoGroup = $this->objFromFixture(VideoGroup::class, 'VideoGroupA');
        $childGroups = $videoGroup->getChildGroups()->column('ID');
        $allChildGroups = $videoGroup->getChildGroups(true)->column('ID');

        $shownChildGroups[] = $allChildGroupsManual[] = $this->objFromFixture(VideoGroup::class, 'VideoGroupC')->ID;
        $allChildGroupsManual[] = $this->objFromFixture(VideoGroup::class, 'VideoGroupD')->ID;

        $this->assertTrue(
            count($shownChildGroups) <= count($allChildGroupsManual),
            "The manual array of all child VideoGroup pages is smaller than the child VideoGroup pages. This shouldn't be the case"
        );

        $inQueriedArray = function ($ID, $groupArray, $type) {
            $this->assertTrue(
                in_array($ID, $groupArray),
                "The VideoGroup with ID: {$ID} not found in the given VideoGroup ID array for {$type}."
            );
        };

        foreach ($childGroups as $key => $val) {
            $inQueriedArray($val, $shownChildGroups, 'children');
        }

        foreach ($allChildGroups as $key => $val) {
            $inQueriedArray($val, $allChildGroupsManual, 'all children');
        }
    }

    /**
     *
     */
    public function testVideoGroupIDs()
    {
        /** @var VideoGroup $shownChild */
        $shownChild = $this->objFromFixture(VideoGroup::class, 'VideoGroupC');
        /** @var VideoGroup $hiddenChild */
        $hiddenChild = $this->objFromFixture(VideoGroup::class, 'VideoGroupD');

        $shownArray[] = $shownChild->ID;
        $hiddenArray[] = $hiddenChild->ID;
        $hiddenArray = array_merge($hiddenArray, $shownArray);

        /** @var VideoGroup $mainGroup */
        $mainGroup = $this->objFromFixture(VideoGroup::class, 'VideoGroupA');
        $shownSubGroupIDs = $mainGroup->getVideoGroupIDs();
        $hiddenSubGroupIDs = $mainGroup->getVideoGroupIDs(true);

        $checkShown = function ($ID) use (&$shownArray) {
            $this->assertTrue(
                in_array($ID, $shownArray),
                'Sub VideoGroup with ID: ' . $ID . ' not in children group array.'
            );
        };

        $checkHidden = function ($ID) use (&$hiddenArray) {
            $this->assertTrue(
                in_array($ID, $hiddenArray),
                'Sub VideoGroup with ID: ' . $ID . ' not in all children group array.'
            );
        };

        foreach ($shownSubGroupIDs as $key => $val) {
            $checkShown($val);
        }

        foreach ($hiddenSubGroupIDs as $key => $val) {
            $checkHidden($val);
        }
    }

    /**
     *
     */
    public function testGetVideoGroupList()
    {
        /** @var VideoGroup $mainGroup */
        $mainGroup = $this->objFromFixture(VideoGroup::class, 'VideoGroupA');
        $mainGroupVideoGroups = $mainGroup->getVideoGroupList()->column('ID');

        $videoList[] = $this->objFromFixture('VideoGroup', 'VideoGroup1')->ID;
        $videoList[] = $this->objFromFixture('VideoGroup', 'VideoGroup2')->ID;
        $videoList[] = $this->objFromFixture('VideoGroup', 'VideoGroup6')->ID;

        $inVideoGroupArray = function ($ID) use (&$videoList) {
            $this->assertTrue(
                in_array($ID, $videoList),
                'The video list built manually doesn\'t have the ID: ' . $ID . ' in it.'
            );
        };

        foreach ($mainGroupVideoGroups as $key => $val) {
            $inVideoGroupArray($val);
        }
    }
}
