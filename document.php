<?php
	class document
	{
		private $parse = "";
		
		public function __construct($jsonblob)  
		{
			$this ->parse = json_decode($jsonblob, true);
		}
		
		public function getLinks()
		{
			return count($this->parse['links']);
		}
		
		public function getLinkWithHref($href)
		{
			for($i = 0; $i < $this->getLinks(); $i++){
	            if($this->parse['links'][$i]['href'] == $href){
	                return $this->parse['links'][$i]['rel'];
				}
			}
	        return NULL;
		}
		
		public function getLinkWithRel($rel)
		{
			for($i = 0; $i < $this->getLinks(); $i++){
	            if($this->parse['links'][$i]['rel'] == $rel){
					return $this->parse['links'][$i]['href'];
				}
			}
	        return NULL;
		}
	}
?>
