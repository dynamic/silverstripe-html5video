<?php

class Video extends Page
{
    private static $db = array(
        'Time' => 'Varchar(100)'
    );

    public static $has_one = array(
        'MP4Video' => 'File' ,
        'OggVideo' => 'File',
        'WebMVideo' => 'File',
        'Image' => 'Image',
    );

    private static $singular_name = 'HTML5 Video';
    private static $plural_name = 'HTML5 Vidoes';
    private static $description = 'Single Video Detail Page';

    private static $default_sort = 'Title ASC';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        // mp4 upload
        $MP4Field = new UploadField('MP4Video', 'MP4 Video');
        $MP4Field->getValidator()->setAllowedExtensions(array('mp4', 'm4v'));
        $MP4Field->setFolderName('Uploads/Video');
        $MP4Field->setConfig('allowedMaxFileNumber', 1);
        $MP4Field->getValidator()->setAllowedMaxFileSize(VIDEO_FILE_SIZE_LIMIT);

        // ogg upload
        $OggField = new UploadField('OggVideo', 'Ogg Video');
        $OggField->getValidator()->setAllowedExtensions(array('ogv', 'ogg'));
        $OggField->setFolderName('Uploads/Video');
        $OggField->setConfig('allowedMaxFileNumber', 1);
        $OggField->getValidator()->setAllowedMaxFileSize(VIDEO_FILE_SIZE_LIMIT);

        // webm upload
        $WebMField = new UploadField('WebMVideo', 'WebM Video');
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

        return $fields;
    }

    public function getRelatedVideos()
    {
        if ($this->Parent() && $this->Parent()->ClassName == 'VideoGroup') {
            $Videos = $this->Parent()->getVideoList();
            foreach ($Videos as $Video) {
                if ($Video->ID == $this->ID) {
                    $Videos->remove($Video);
                }
            }

            return $Videos;
        }

        return false;
    }
}

class Video_Controller extends Page_Controller
{
}
