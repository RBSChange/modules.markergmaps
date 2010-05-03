<?php
/**
 * markergmaps_patch_0302
 * @package modules.markergmaps
 */
class markergmaps_patch_0302 extends patch_BasePatch
{
//  by default, isCodePatch() returns false.
//  decomment the following if your patch modify code instead of the database structure or content.
    /**
     * Returns true if the patch modify code that is versionned.
     * If your patch modify code that is versionned AND database structure or content,
     * you must split it into two different patches.
     * @return Boolean true if the patch modify code that is versionned.
     */
	public function isCodePatch()
	{
		$moduleWebapp = f_util_FileUtils::buildAbsolutePath(WEBEDIT_HOME, "modules", "markergmaps", "webapp", "media", "frontoffice");
		$webapp = f_util_FileUtils::buildAbsolutePath(WEBEDIT_HOME, "media", "frontoffice");

		f_util_FileUtils::cp($moduleWebapp.'/gmaps-close.png', 	$webapp.'/gmaps-close.png', 	f_util_FileUtils::OVERRIDE);
		f_util_FileUtils::cp($moduleWebapp.'/gmaps-drag.gif', 	$webapp.'/gmaps-drag.gif', 		f_util_FileUtils::OVERRIDE);
		f_util_FileUtils::cp($moduleWebapp.'/gmaps-flyman.png', $webapp.'/gmaps-flyman.png', 	f_util_FileUtils::OVERRIDE);
		f_util_FileUtils::cp($moduleWebapp.'/gmaps-man.png', 		$webapp.'/gmaps-man.png', 		f_util_FileUtils::OVERRIDE);

		return true;
	}

	/**
	 * Entry point of the patch execution.
	 */
	public function execute()
	{
		// Implement your patch here.
	}

	/**
	 * @return String
	 */
	protected final function getModuleName()
	{
		return 'markergmaps';
	}

	/**
	 * @return String
	 */
	protected final function getNumber()
	{
		return '0302';
	}
}