<?php
/**
 * markergmaps_patch_0301
 * @package modules.markergmaps
 */
class markergmaps_patch_0301 extends patch_BasePatch
{

	/**
	 * Entry point of the patch execution.
	 */
	public function execute()
	{
		ChangeProject::getInstance()->executeTask('cd');
		ChangeProject::getInstance()->executeTask('gdb');
		ChangeProject::getInstance()->executeTask('ci18n', array('markergmaps'));
		ChangeProject::getInstance()->executeTask('cb');
		ChangeProject::getInstance()->executeTask('cec');
		ChangeProject::getInstance()->executeTask('croles');
		ChangeProject::getInstance()->executeTask('cperm');
		ChangeProject::getInstance()->executeTask('import-data', array('markergmaps', 'init.xml'));
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
		return '0301';
	}
}