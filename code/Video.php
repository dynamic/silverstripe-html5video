<?php

class Video extends Page { 
   
   static $has_one = array ( 
      'MP4Video' => 'File' ,
      'OggVideo' =>  'File',
      'WebMVideo' => 'File',
      'Poster' => 'Image'
      //'VideoGroup' => 'VideoGroup'
   ); 
   
   static $description = 'Single Video Detail Page';
   
   static $default_sort = 'Title ASC';
   
   public function getCMSFields() {
   
   	$fields = parent::getCMSFields();
   	
   	// mp4 upload
   	$MP4Field = new UploadField('MP4Video', 'MP4 Video');
   	$MP4Field->getValidator()->setAllowedExtensions(array('mp4', 'm4v'));
   	$MP4Field->setFolderName('Uploads/video');
   	$MP4Field->setConfig('allowedMaxFileNumber', 1);
   	
   	// ogg upload
   	$OggField = new UploadField('OggVideo', 'Ogg Video');
   	$OggField->getValidator()->setAllowedExtensions(array('ogv', 'ogg'));
   	$OggField->setFolderName('Uploads/video');
   	$OggField->setConfig('allowedMaxFileNumber', 1);
   	
   	// mp4 upload
   	$WebMField = new UploadField('WebMVideo', 'WebM Video');
   	$WebMField->getValidator()->setAllowedExtensions(array('webm'));
   	$WebMField->setFolderName('Uploads/video');
   	$WebMField->setConfig('allowedMaxFileNumber', 1);
   	
   	// poster
   	$PosterField = new UploadField('Poster', 'Poster Image');
   	$PosterField->allowedExtensions = array('jpg', 'gif', 'png');
   	$PosterField->setFolderName('Uploads/videoposters');
   	$PosterField->setConfig('allowedMaxFileNumber', 1);
   	
   	$fields->addFieldsToTab('Root.Video', array(
   		$MP4Field,
   		$OggField,
   		$WebMField,
   		$PosterField
   	));
   	
   	return $fields;
   }
   
   public function getRelatedVideos() {
		
		if ($this->Parent()) {
		
			$Videos = $this->Parent()->getVideoList();
			foreach ($Videos as $Video) {
				if ($Video->ID = $this->ID) $Videos->remove($Video);
			}
			return $Videos;
		}
		
		return false;
	}
	
	

}

class Video_Controller extends Page_Controller {

	

}
 
?>