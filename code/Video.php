<?php

/**
 * Class Video
 * @package html5video
 */
class Video extends Page
{
    /**
     * @var array
     */
    private static $db = array(
        'Time' => 'Varchar(100)'
    );

    /**
     * @var array
     */
    private static $has_one = array(
        'MP4Video' => 'File',
        'OggVideo' => 'File',
        'WebMVideo' => 'File',
        'Image' => 'Image',
    );

    /**
     * @var string
     */
    private static $singular_name = 'HTML5 Video';

    /**
     * @var string
     */
    private static $plural_name = 'HTML5 Vidoes';

    /**
     * @var string
     */
    private static $description = 'Single Video Detail Page';

    /**
     * @var string
     */
    private static $default_sort = 'Title ASC';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        // mp4 upload
        if (class_exists('ChunkedUploadField')) {
            $MP4Field = new ChunkedUploadField('MP4Video', 'MP4 Video');
        } else {
            $MP4Field = new UploadField('MP4Video', 'MP4 Video');
        }
        $MP4Field->getValidator()->setAllowedExtensions(array('mp4', 'm4v'));
        $MP4Field->setFolderName('Uploads/Video');
        $MP4Field->setConfig('allowedMaxFileNumber', 1);
        $MP4Field->getValidator()->setAllowedMaxFileSize(VIDEO_FILE_SIZE_LIMIT);

        // ogg upload
        if (class_exists('ChunkedUploadField')) {
            $OggField = new ChunkedUploadField('OggVideo', 'Ogg Video');
        } else {
            $OggField = new UploadField('OggVideo', 'Ogg Video');
        }
        $OggField->getValidator()->setAllowedExtensions(array('ogv', 'ogg'));
        $OggField->setFolderName('Uploads/Video');
        $OggField->setConfig('allowedMaxFileNumber', 1);
        $OggField->getValidator()->setAllowedMaxFileSize(VIDEO_FILE_SIZE_LIMIT);

        // webm upload
        if (class_exists('ChunkedUploadField')) {
            $WebMField = new ChunkedUploadField('WebMVideo', 'WebM Video');
        } else {
            $WebMField = new UploadField('WebMVideo', 'WebM Video');
        }
        $WebMField->getValidator()->setAllowedExtensions(array('webm'));
        $WebMField->setFolderName('Uploads/Video');
        $WebMField->setConfig('allowedMaxFileNumber', 1);
        $WebMField->getValidator()->setAllowedMaxFileSize(VIDEO_FILE_SIZE_LIMIT);

        // poster
        $PosterField = new UploadField('Image', 'Poster Image');
        $PosterField->allowedExtensions = array('jpg', 'gif', 'png');
        $PosterField->setFolderName('Uploads/VideoImages');
        $PosterField->setConfig('allowedMaxFileNumber', 1);
        $PosterField->getValidator()->setAllowedMaxFileSize(VIDEO_IMAGE_FILE_SIZE_LIMIT);

        $fields->addFieldsToTab('Root.Video', array(
            $PosterField,
            TextField::create('Time', 'Video Duration'),
            $MP4Field,
            $OggField,
            $WebMField,
        ));

        $this->extend('updateCMSFields', $fields);

        return $fields;
    }

    /**
     * @return DataList|bool
     */
    public function getRelatedVideos()
    {
        if ($this->Parent() && $this->Parent()->ClassName == 'VideoGroup') {
            return $this->Parent()->getVideoList()->exclude('ID', $this->ID);
        }

        return false;
    }
}

class Video_Controller extends Page_Controller
{
}
