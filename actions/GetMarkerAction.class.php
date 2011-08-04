<?php
class markergmaps_GetMarkerAction extends change_Action
{
	/**
	 * @param change_Context $context
	 * @param change_Request $request
	 */
	public function _execute($context, $request)
	{
		$parameters = $request->getParameter('gmapsParam');
		$documentId = $parameters[K::COMPONENT_ID_ACCESSOR];
		
		if (!$documentId)
		{
			return change_View::NONE;
		}
		
		$document = DocumentHelper::getDocumentInstance($documentId);
		
		if (!$document || !$document instanceof markergmaps_Marker)
		{
			return change_View::NONE;
		}
		
		$request->setAttribute('marker', $document);
		return change_View::SUCCESS;
	}
	
	public function isSecure()
	{
		return false;
	}
}