<?php
/** 
 * @author michal.olexa
 * @date 23 juin 08
 */
class markergmaps_GetNearestMarkersErrorView extends change_View
{
	/**
	 * @param change_Context $context
	 * @param change_Request $request
	 */
    public function _execute($context, $request)
    {
		$this->setTemplateName('Gmaps-Markers-Error', 'xml');
		$this->setAttribute('errors', $request->getAttribute('errors'));
    }
}