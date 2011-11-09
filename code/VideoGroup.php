<?php
class VideoGroup extends Page { 
   
   /*static $has_many = array ( 
      'Videos' => 'Video' 
   );*/ 
    
   public function getCMSFields() 
   { 
      $fields = parent::getCMSFields(); 
      /*$fields->addFieldToTab("Root.Content.Videos", new FileDataObjectManager( 
         $this, 
         'Videos', 
         'Video', 
         'Video', 
         array('Title' => 'Title', 'Description' => 'Description'), 
         new FieldSet( 
            new TextField('Title'), 
            new TextareaField('Description') 
         ) 
      )); */
      return $fields; 
   } 
}

class VideoGroup_Controller extends Page_Controller {

}
?>