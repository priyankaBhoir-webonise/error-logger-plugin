<?php
/* MyControllers Test cases generated on: 2013-08-27 16:13:05 : 1377600185*/
App::import('Controller', 'MyControllers');

class TestMyControllersController extends MyControllersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MyControllersControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->MyControllers =& new TestMyControllersController();
		$this->MyControllers->constructClasses();
	}

	function endTest() {
		unset($this->MyControllers);
		ClassRegistry::flush();
	}

}
?>