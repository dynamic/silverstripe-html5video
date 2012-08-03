<?php
class VideoGroup extends Page { 
   
	static $belongs_many_many = array(
		'Videos' => 'Video'
	);
	
	static $allowed_children = array(
		'Video'
	);
	
	protected static $page_length = 12;
	
	protected static $include_child_groups = true;
	
	static $description = 'Videos Landing Page';
	
	function ShowVideos() {
		
		$filter = '';
		
		
		$limit = (isset($_GET['start']) && (int)$_GET['start'] > 0) ? (int)$_GET['start'].",".self::$page_length : "0,".self::$page_length;
		$sort = (isset($_GET['sortby'])) ? Convert::raw2sql($_GET['sortby']) : "\"Title\"";
		
		$groupids = array($this->ID);

		if(self::$include_child_groups && $childgroups = $this->ChildGroups(true))
			$groupids = array_merge($groupids,$childgroups->map('ID','ID'));

		$groupidsimpl = implode(',',$groupids);

		$join = $this->getManyManyJoin('Videos','Video');
		$multicatfilter = $this->getManyManyFilter('Videos','Video');

		//TODO: get products that appear in child groups (make this optional)

		$products = DataObject::get('Video',"(\"ParentID\" IN ($groupidsimpl) OR $multicatfilter) $filter",$sort,$join,$limit);

		$allproducts = DataObject::get('Video',"\"ParentID\" IN ($groupidsimpl) $filter","",$join);
		
		if($allproducts) $products->TotalCount = $allproducts->Count(); //add total count to returned data for 'showing x to y of z products'
		if($products && $products instanceof DataObjectSet) $products->removeDuplicates();
		

		return $products;
		
	}
	
	function ChildGroups($recursive = false) {
		if($recursive){
			if($children = DataObject::get('VideoGroup', "\"ParentID\" = '$this->ID'")){
				$output = unserialize(serialize($children));
				foreach($children as $group){
					$output->merge($group->ChildGroups($recursive));
				}
				return $output;
			}
			return null;
		}else{
			return DataObject::get('VideoGroup', "\"ParentID\" = '$this->ID'");
		}
	}

    
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

	public function GroupVideos() {
		return $this->ShowVideos();
	}
	
	public function SubGroups() {
		return $this->ChildGroups();
	}

}
?>