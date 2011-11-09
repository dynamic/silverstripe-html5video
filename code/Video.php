<?php

class Video extends Page { 
   
   static $has_one = array ( 
      'Video' => 'FLV' ,
      //'VideoGroup' => 'VideoGroup'
   ); 
   
   public function getCMSFields() {
   
   	$fields = parent::getCMSFields();
   	
   	$fields->addFieldToTab('Root.Content.Video', new FileUploadField('Video'));
   	
   	return $fields;
   }
    
}

class Video_Controller extends Page_Controller {

	

}
 
?>