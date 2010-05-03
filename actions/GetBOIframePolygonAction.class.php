<?php
/**
 * @date Mon, 08 Sep 2008 08:51:19 +0000
 * @package modules.markergmaps
 */
class markergmaps_GetBOIframePolygonAction extends f_action_BaseAction
{
	/**
	 * @param Context $context
	 * @param Request $request
	 */
	public function _execute($context, $request)
	{
		$url = GmapsHelper::getGmapsUrlForDefaultWebsite();

		if($url === null)
		{
			return View::NONE ;
		}

		$request->setParameter('url', $url);
		$request->setParameter('country', f_Locale::translate('&modules.markergmaps.bo.country.'.RequestContext::getInstance()->getLang().';'));
		$request->setParameter('color', $request->getParameter('color', 'ff0000'));
		$request->setParameter('fillcolor', $request->getParameter('fillcolor', 'ff0000'));
		$request->setParameter('points', $request->getParameter('points', ''));
		$request->setParameter('weight', $request->getParameter('weight', 5));
		$request->setParameter('opacity', $request->getParameter('opacity', 0.5));
		$request->setParameter('fillopacity', $request->getParameter('fillopacity', 0.3));

		return View::SUCCESS ;
	}
}