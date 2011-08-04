<?php
/**
 * @date Mon, 08 Sep 2008 08:51:19 +0000
 * @package modules.GetBOIframe
 */
class markergmaps_GetBOIframeGmarkerSuccessView extends change_View
{
	/**
	 * @param change_Context $context
	 * @param change_Request $request
	 */
	public function _execute($context, $request)
	{
		$this->setTemplateName('Markergmaps-Gmarker');

		$this->setAttributes($request->getParameters());
	}
}