<?

use \Bitrix\Main\EventManager;
use \Bitrix\Main\ModuleManager;

class starlabs_project extends CModule
{
	public $MODULE_ID = 'starlabs.project';
	public $MODULE_VERSION = '';
	public $MODULE_VERSION_DATE = '';
	public $MODULE_NAME = 'Проектный модуль Starlabs';
	public $MODULE_DESCRIPTION = 'Проектный модуль Starlabs';
	public $PARTNER_NAME = "StarLabs";
	public $PARTNER_URI = "http://Starlabs.su/";

	/**
	 * remark_tools constructor.
	 */
	public function __construct()
	{
		$version = include __DIR__ . '/version.php';

		$this->MODULE_VERSION = $version['VERSION'];
		$this->MODULE_VERSION_DATE = $version['VERSION_DATE'];

		$this->eventHandlers = [
			[
				'main',
				'OnPageStart',
				'\Starlabs\Project\Module',
				'onPageStart',
			]
		];
	}

	/**
	 * @return bool
	 */
	public function installFiles()
	{
		return true;
	}

	/**
	 * @return bool
	 */
	public function unInstallFiles()
	{
		return true;
	}

	/**
	 * @return bool
	 */
	public function installEvents()
	{
		$eventManager = EventManager::getInstance();
		foreach ($this->eventHandlers as $handler) {
			$eventManager->registerEventHandler($handler[0], $handler[1], $this->MODULE_ID, $handler[2], $handler[3]);
		}

		return true;
	}

	/**
	 * @return bool
	 */
	public function unInstallEvents()
	{
		$eventManager = EventManager::getInstance();
		foreach ($this->eventHandlers as $handler) {
			$eventManager->unRegisterEventHandler($handler[0], $handler[1], $this->MODULE_ID, $handler[2], $handler[3]);
		}

		return true;
	}

	/**
	 *
	 */
	public function DoInstall()
	{
		if ($this->installEvents() && $this->installFiles()) {
			ModuleManager::registerModule($this->MODULE_ID);
		}
	}

	/**
	 *
	 */
	public function DoUninstall()
	{
		if ($this->unInstallEvents() && $this->unInstallFiles()) {
			ModuleManager::unRegisterModule($this->MODULE_ID);
		}
	}


}
