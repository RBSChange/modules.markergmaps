<?php
class markergmaps_GetMarkersAction extends f_action_BaseAction
{

	/**
	 * @param Context $context
	 * @param Request $request
	 */
	public function _execute($context, $request)
	{
		$parameters = $request->getParameter('gmapsParam');
		$documentIds = $parameters[K::COMPONENT_ID_ACCESSOR];
		
		if(is_null($documentIds) || f_util_ArrayUtils::isEmpty($documentIds))
		{
			return View::NONE;
		}
		
		foreach($documentIds as $documentId)
		{
			$document = DocumentHelper::getDocumentInstance($documentId);
		
			if($document instanceof markergmaps_Marker)
			{
				$documents[] = $document;
			}
		}

		$request->setAttribute('markers', $documents);
		return View::SUCCESS;
	}
	
	public function isSecure()
	{
		return false;
	}
}