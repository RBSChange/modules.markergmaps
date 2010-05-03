<?php
/**
 * @date Mon, 08 Sep 2008 08:51:19 +0000
 * @package modules.markergmaps
 */
class markergmaps_GetBOIframeGmarkerAction extends f_action_BaseAction
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
		$request->setParameter('longitude', $request->getParameter('longitude'));
		$request->setParameter('latitude', $request->getParameter('latitude'));
		$request->setParameter('colormarker', $request->getParameter('colormarker'));
		if(f_util_StringUtils::isNotEmpty($request->getParameter('picto')))
		{
			try
			{
				$request->setParameter('picto', MediaHelper::getPublicResizedUrl(DocumentHelper::getDocumentInstance($request->getParameter('picto')), $request->getParameter('width'), $request->getParameter('height')));
				$request->setParameter('width', $request->getParameter('width'));
				$request->setParameter('height', $request->getParameter('height'));
			}
			catch (Exception $e)
			{
			}
		}
		if(f_util_StringUtils::isNotEmpty($request->getParameter('shadow')))
		{
			try
			{
				$request->setParameter('shadow', MediaHelper::getPublicResizedUrl(DocumentHelper::getDocumentInstance($request->getParameter('shadow')), $request->getParameter('swidth'), $request->getParameter('sheight')));
				$request->setParameter('swidth', $request->getParameter('swidth'));
				$request->setParameter('sheight', $request->getParameter('sheight'));
			}
			catch (Exception $e)
			{
			}
		}

		return View::SUCCESS ;
	}
}