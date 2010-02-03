<?php
class markergmaps_GetNearestMarkersAction extends f_action_BaseAction
{
	/**
	 * @param Context $context
	 * @param Request $request
	 */
	public function _execute($context, $request)
	{
		$latitude = $request->getParameter(GmapsConstants::LAT_PARAM_NAME);
		$longitude = $request->getParameter(GmapsConstants::LNG_PARAM_NAME);
		$modelName = $request->getParameter(GmapsConstants::MODELNAME_PARAM_NAME);
		$maxCount = $request->getParameter(GmapsConstants::MAX_COUNT_PARAM_NAME);
		$minCount = $request->getParameter(GmapsConstants::MIN_COUNT_PARAM_NAME);
		$maxDistance = $request->getParameter(GmapsConstants::MAX_DISTANCE_PARAM_NAME);
		
		if (is_null($latitude) || is_null($longitude))
		{
			$request->setAttribute('errors', array(Locale::translate('&modules.markergmaps.frontoffice.Wrong-address;')));
			return View::ERROR;
		}
		
		$markers = markergmaps_MarkerService::getInstance()->getNearestMarkers(
			$modelName,
			$latitude,
			$longitude,
			$maxCount,
			$minCount,
			$maxDistance
		);

		if (f_util_ArrayUtils::isEmpty($markers))
		{
			$request->setAttribute('errors', array(Locale::translate('&modules.markergmaps.frontoffice.No-marker-found;')));
			return View::ERROR;
		}
		
		$request->setAttribute('markers', $markers);
		
		return View::SUCCESS;
	}
	
	public function isSecure()
	{
		return false;
	}
}