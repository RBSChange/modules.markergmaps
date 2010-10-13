<?php
/** 
 * @author michal.olexa
 * @date 23 juin 08
 */
class markergmaps_GetNearestMarkersErrorView extends f_view_BaseView
{
	/**
	 * @param Context $context
	 * @param Request $request
	 */
    public function _execute($context, $request)
    {
		$this->setTemplateName('Gmaps-Markers-Error', K::XML);
		$this->setAttribute('errors', $request->getAttribute('errors'));
    }
}