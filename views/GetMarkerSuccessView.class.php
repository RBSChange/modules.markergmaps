<?php
/**
 * @author michal.olexa
 * @date 23 juin 08
 */
class markergmaps_GetMarkerSuccessView extends change_View
{
	/**
	 * @param change_Context $context
	 * @param change_Request $request
	 */
    public function _execute($context, $request)
    {
		$this->setTemplateName('Gmaps-Markers-KML', 'xml');
		
		$marker = $request->getAttribute('marker');
		$this->setAttribute('markers', array($marker));
		
		$website = website_WebsiteModuleService::getInstance()->getCurrentWebsite();
		$this->setAttribute('website', $website);
		
     }
}