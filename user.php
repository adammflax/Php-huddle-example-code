<?php
	class user
	{
		private $parse = "";
		
		public function __construct($jsonblob)  
		{
			$this ->parse = json_decode($jsonblob, true);
		}
		
		public function getWorkSpaceCount()
		{
			return count($this ->parse['membership']['workspaces']);
		}
		
		public function getWorkSpaceLinksCount($workspaceIndex)
		{
			return count($this->parse['membership']['workspaces'][$workspaceIndex]['links']);
		}
		
		public function getWorkSpaceTitle($workspaceIndex)
		{
			return $this->parse['membership']['workspaces'][$workspaceIndex]['title'];
		}
		
		public function getWorkSpaceType($workspaceIndex)
		{
			return $this->parse['membership']['workspaces'][$workspaceIndex]['type'];
		}
		
		public function getWorkSpaceSettingsName($workspaceIndex, $settingIndex)
		{
			return $this->parse['membership']['workspaces'][$workspaceIndex]['settings']['name'];
		}

		public function getWorkSpaceLinkHref($workspaceIndex, $linkIndex)
		{
			return $this->parse['membership']['workspaces'][$workspaceIndex]['links'][$linkIndex]['href'];
		}
		
		public function getWorkSpaceLinkRel($workspaceIndex, $linkIndex)
		{
			return $this->parse['membership']['workspaces'][$workspaceIndex]['links'][$linkIndex]['rel'];
		}
		
		public function getLinkWhereHrefIs($workspaceIndex, $href)
		{
	        for($i = 0; $i <  $this->getWorkSpaceLinksCount($workspaceIndex); $i++){
	            if($this->parse['membership']['workspaces'][$workspaceIndex]['links'][i]['href'] == $href){
	                return $this->parse['membership']['workspaces'][$workspaceIndex]['links'][i]['rel'];
				}
			}
	        return NULL;
		}

		public function getLinkWhereRelIs($workspaceIndex, $rel)
		{
	        for($i = 0; $i <  $this->getWorkSpaceLinksCount($workspaceIndex); $i++){
	            if($this->parse['membership']['workspaces'][$workspaceIndex]['links'][i]['rel'] == $rel){
	                return $this->parse['membership']['workspaces'][$workspaceIndex]['links'][i]['href'];
				}
			}
	        return NULL;
		}
		
	}
?>
