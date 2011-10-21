<?php
/**
 * @author michal.olexa
 * @date 23 juin 08
 */
class markergmaps_GetNearestMarkersSuccessView extends change_View
{
	/**
	 * @param change_Context $context
	 * @param change_Request $request
	 */
    public function _execute($context, $request)
    {
		$this->setTemplateName('Gmaps-Markers-KML', 'xml');
    	
		$markers = $request->getAttribute('markers');
		
		$this->setAttribute('markers', $markers);
		
		$iconUrl = markergmaps_MarkerService::getInstance()->getMarkerIconUrl($markers[0]);
		if($iconUrl)
		{
			$this->setAttribute('iconUrl', $iconUrl);
		}
		
		$website = website_WebsiteService::getInstance()->getCurrentWebsite();
		$this->setAttribute('website', $website);
    }
}