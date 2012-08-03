<?php

class Video extends Page { 
   
   static $has_one = array ( 
      'MP4Video' => 'File' ,
      'OggVideo' =>  'File',
      'WebMVideo' => 'File',
      'Poster' => 'Image'
      //'VideoGroup' => 'VideoGroup'
   ); 
   
<<<<<<< HEAD
   static $description = 'Single Video Detail Page';
   
=======
>>>>>>> 6aa4933ce2368a5e1d98bd2835cd1f39af28e2aa
   public function getCMSFields() {
   
   	$fields = parent::getCMSFields();
   	
   	// mp4 upload
   	$MP4Field = new UploadField('MP4Video', 'MP4 Video');
   	$MP4Field->getValidator()->setAllowedExtensions(array('mp4', 'm4v'));
   	$MP4Field->setFolderName('Uploads/video');
   	
   	// ogg upload
   	$OggField = new UploadField('OggVideo', 'Ogg Video');
   	$OggField->getValidator()->setAllowedExtensions(array('ogv', 'ogg'));
   	$OggField->setFolderName('Uploads/video');
   	
   	// mp4 upload
   	$WebMField = new UploadField('WebMVideo', 'WebM Video');
   	$WebMField->getValidator()->setAllowedExtensions(array('webm'));
   	$WebMField->setFolderName('Uploads/video');
   	
   	// poster
   	$PosterField = new UploadField('Poster', 'Poster Image');
   	$PosterField->allowedExtensions = array('jpg', 'gif', 'png');
   	$PosterField->setFolderName('Uploads/videoposters');
   	
   	$fields->addFieldsToTab('Root.Video', array(
   		$MP4Field,
   		$OggField,
   		$WebMField,
   		$PosterField
   	));
   	
   	return $fields;
   }
    
}

class Video_Controller extends Page_Controller {

	

}
 
?>