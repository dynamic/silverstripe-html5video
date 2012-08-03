<?php

class Video extends Page { 
   
	static $has_one = array ( 
		'Video' => 'FLV' ,
	); 
   
	public static $many_many = array(
		'Groups' => 'VideoGroup'
	);
	
	public static $singular_name = 'Video';

	public static $plural_name = 'Videos';

	static $default_parent = 'VideoGroup';
		
	static $can_be_root = false;

	static $default_sort = '"Title" ASC';
   

	public function getCMSFields() {
   
	   	$fields = parent::getCMSFields();
	   	
	   	$fields->addFieldToTab('Root.Content.Video', new FileUploadField('Video'));
	   	
	   	$fields->addFieldsToTab(
			'Root.Content.Groups',
			array(
				new HeaderField('ProductGroupsHeader', _t('Product.ALSOAPPEARS')),
				$this->getVideoGroupsTable()
			)
		);
	   	
	   	return $fields;

	}
   
   protected function getVideoGroupsTable() {
		$tableField = new ManyManyComplexTableField(
			$this,
			'Groups',
			'VideoGroup',
			array(
				'Title' => 'Video Group Page Title'
			)
		);

		$tableField->setPageSize(30);
		$tableField->setPermissions(array());

		//TODO: use a tree structure for selecting groups
		//$field = new TreeMultiselectField('ProductGroups','Product Groups','ProductGroup');

		return $tableField;
	}
    
}

class Video_Controller extends Page_Controller {

	/**
	return related Videos for sidebar
	@return DataObjectSet Videos
	*/
	public function relatedVideos() {
		
		$Group = DataObject::get_by_id('VideoGroup', $this->ParentID);		
		$Videos = $Group->ShowVideos();
		//debug::show($Videos);
		
		return $Videos;
	}	

}
 
?>