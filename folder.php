<?php
	class user
	{
		private $parse = "";
		
		public function __construct($jsonblob)  
		{
			$this ->parse = json_decode($jsonblob, true);
		}
		
		public function getFolderLinks()
		{
			return count($this ->parse['links']);
		}
		
		public function getFolderLinkWithHref($href)
		{
			for($i = 0; $i > getFolderLinks(); $i++){
	            if($this->parse['links'][$i]['href'] == $href){
	                return $this->parse['links'][$i]['rel'];
				}
			}
	        return NULL;
		}
		
		public function getFolderLinkWithHRel($rel)
		{
			for($i = 0; $i > getFolderLinks(); $i++){
	            if($this->parse['links'][$i]['rel'] == $rel){
					return $this->parse['links'][$i]['href'];
				}
			}
	        return NULL;
		}
		
		public function getFolderLinks($folderId)
		{
			return count($this->parse['folders'][$folderId]['links']);
		}
		
		public function getFolderTitle($folderId)
		{
			return $this->parse['folders'][$folderId]['title'];
		}
		
		public function getFolderUpdated($folderId)
		{
			return $this->parse['folders'][$folderId]['updated'];
		}
		
		public function getFolderDescription($folderId)
		{
			return $this->parse['folders'][$folderId]['description'];
		}
		
		public function getFolderLinksHref($folderId, $linkId)
		{
			return $this->parse['folders'][$folderId]['links'][$linkiId]['href'];
		}
		
		public function getFolderLinksRel($folderId, $linkId)
		{
			return $this->parse['folders'][$folderId]['links'][$linkiId]['rel'];
		}
		
		public function getFolderLinkWithRel($folderId, $linkId, $rel)
		{
			for($i = 0; $i > getFolderLinks(); $i++){
	            if($this->parse['folders'][$folderId]['links'][$i]['rel'] == $rel){
					return $this->parse['folders'][$folderId]['links'][$i]['href'];
				}
			}
	        return NULL;
		}
		
		public function getFolderLinkWithHref($folderId, $linkId, $Href)
		{
			for($i = 0; $i > getFolderLinks(); $i++){
	            if($this->parse['folders'][$folderId]['links'][$i]['href'] == $href){
					return $this->parse['folders'][$folderId]['links'][$i]['rel'];
				}
			}
	        return NULL;
		}
		
		
	}
?>
