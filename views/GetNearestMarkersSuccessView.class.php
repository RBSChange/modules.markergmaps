<?php
/**
 * @author michal.olexa
 * @date 23 juin 08
 */
class markergmaps_GetNearestMarkersSuccessView extends f_view_BaseView
{
	/**
	 * @param Context $context
	 * @param Request $request
	 */
    public function _execute($context, $request)
    {
		$this->setTemplateName('Gmaps-Markers-KML', K::XML);
    	
		$markers = $request->getAttribute('markers');
		
		$this->setAttribute('markers', $markers);
		
		$iconUrl = markergmaps_MarkerService::getInstance()->getMarkerIconUrl($markers[0]);
		if($iconUrl)
		{
			$this->setAttribute('iconUrl', $iconUrl);
		}
		
		$website = website_WebsiteModuleService::getInstance()->getCurrentWebsite();
		$this->setAttribute('website', $website);
    }
}