<?php
namespace Starlabs\Project\Ajax\Controller;

use Starlabs\Tools\Ajax\Controller\Prototype;

class WebHook extends Prototype
{
	public function TestAction()
	{
//		$this->returnAsIs = true;
		return 'TestAction';
	}
}