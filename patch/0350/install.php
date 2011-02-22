<?php
/**
 * markergmaps_patch_0350
 * @package modules.markergmaps
 */
class markergmaps_patch_0350 extends patch_BasePatch
{
	/**
	 * Entry point of the patch execution.
	 */
	public function execute()
	{
		$this->log("compile-locales markergmaps");
		$this->execChangeCommand("compile-locales", array("markergmaps"));
		
		$this->log("compile-blocks");
		$this->execChangeCommand("compile-blocks");
		
		$this->log("migrage page contents");
		$rc = RequestContext::getInstance();
		$pageService = website_PageService::getInstance();
		$scriptPath = "modules/markergmaps/patch/0350/migratePageContent.php";
		foreach ($rc->getSupportedLanguages() as $lang)
		{
			$rc->beginI18nWork($lang);
			$ids = $pageService->createQuery()
				->setProjection(Projections::property("id", "i"))
				->add(Restrictions::orExp(Restrictions::like("content", "modules_markergmaps_position", MatchMode::ANYWHERE()),
					Restrictions::like("content", "modules_markergmaps_folder", MatchMode::ANYWHERE())))
				->findColumn("i");
		
			$idsCount = count($ids);
			$offset = 0;
			$chunkLength = 10;
			while ($offset < $idsCount)
			{
				$subIds = array_slice($ids, $offset, $chunkLength);
				$ret = f_util_System::execHTTPScript($scriptPath, array($lang, $subIds));
				if (!is_numeric($ret))
				{
					$this->logError("Error while processing " . $offset  . " - " . ($offset + $chunkLength) . ": $ret");
				}
				else
				{
					$this->log($offset . " - " . ($offset + $chunkLength) . " processed: " . $ret . " content updated ($lang)");
				}
				$offset += $chunkLength;
			}
			
			$rc->endI18nWork();
		}
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
		return '0350';
	}
}