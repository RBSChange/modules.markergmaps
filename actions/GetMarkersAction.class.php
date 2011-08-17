<?php
class markergmaps_GetMarkersAction extends markergmaps_Action
{

	/**
	 * @param change_Context $context
	 * @param change_Request $request
	 */
	public function _execute($context, $request)
	{
		$parameters = $request->getParameter('gmapsParam');
		$documentIds = $parameters[change_Request::DOCUMENT_ID];
		
		if(is_null($documentIds) || f_util_ArrayUtils::isEmpty($documentIds))
		{
			return change_View::NONE;
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
		return change_View::SUCCESS;
	}
	
	public function isSecure()
	{
		return false;
	}
}