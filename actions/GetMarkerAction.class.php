<?php
class markergmaps_GetMarkerAction extends f_action_BaseAction
{
	/**
	 * @param Context $context
	 * @param Request $request
	 */
	public function _execute($context, $request)
	{
		$parameters = $request->getParameter('gmapsParam');
		$documentId = $parameters[K::COMPONENT_ID_ACCESSOR];
		
		if (!$documentId)
		{
			return View::NONE;
		}
		
		$document = DocumentHelper::getDocumentInstance($documentId);
		
		if (!$document || !$document instanceof markergmaps_Marker)
		{
			return View::NONE;
		}
		
		$request->setAttribute('marker', $document);
		return View::SUCCESS;
	}
	
	public function isSecure()
	{
		return false;
	}
}