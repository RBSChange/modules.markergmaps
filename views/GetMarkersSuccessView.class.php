<?php
/**
 * @author michal.olexa
 * @date 23 juin 08
 */
class markergmaps_GetMarkersSuccessView extends change_View
{
	/**
	 * @param change_Context $context
	 * @param change_Request $request
	 */
    public function _execute($context, $request)
    {
		$this->setTemplateName('Gmaps-Markers-KML', K::XML);
		
		$markers = $request->getAttribute('markers');
		$this->setAttribute('markers', $markers);
		
		$website = website_WebsiteModuleService::getInstance()->getCurrentWebsite();
		$this->setAttribute('website', $website);
		
     }
}