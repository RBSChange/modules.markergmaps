<?php
/**
 * @author michal.olexa
 * @date 23 juin 08
 */
class markergmaps_GetMarkerSuccessView extends f_view_BaseView
{
	/**
	 * @param Context $context
	 * @param Request $request
	 */
    public function _execute($context, $request)
    {
		$this->setTemplateName('Gmaps-Markers-KML', K::XML);
		
		$marker = $request->getAttribute('marker');
		$this->setAttribute('markers', array($marker));
		
		$website = website_WebsiteModuleService::getInstance()->getCurrentWebsite();
		$this->setAttribute('website', $website);
		
     }
}