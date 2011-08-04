<?php
/**
 * @date Mon, 08 Sep 2008 08:51:19 +0000
 * @author intessit
 * @package modules.markergmaps
 */
class markergmaps_GetBOIframeAction extends change_Action
{
	/**
	 * @param change_Context $context
	 * @param change_Request $request
	 */
	public function _execute($context, $request)
	{
		$url = GmapsHelper::getGmapsUrlForDefaultWebsite();

		if($url === null)
		{
			return change_View::NONE ;
		}
		
		$request->setParameter('url', $url);
		$request->setParameter('country', f_Locale::translate('&modules.markergmaps.bo.country.'.RequestContext::getInstance()->getLang().';'));
		$request->setParameter('lat', $request->getParameter('lat'));
		$request->setParameter('lng', $request->getParameter('lng'));
		$request->setParameter('zoom', $request->getParameter('zoom'));
		$request->setParameter('maptype', $request->getParameter('maptype'));
		$request->setParameter('address', str_replace('"', '\"', $request->getParameter('address')));
		$request->setParameter('colormarker', $request->getParameter('colormarker', 'red-dot.png'));

		return change_View::SUCCESS ;
	}
}