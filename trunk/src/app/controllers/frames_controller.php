<?php 
class FramesController extends AppController {
	var $name = 'Frames';
	var $helpers = array('Html');

	function top() {
		$this->layout = 'blank';
	}

	function head() {
		$this->layout = 'blank';
	}

	function status_bar() {
		$this->layout = 'blank';
	}

	function desktop() {
		$this->layout = 'blank';
	}
}
?>