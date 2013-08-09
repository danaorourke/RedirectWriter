<?php
// I make redirects, once you give me the right file.
class redirectWriter {
	
}

// I'm sure you can't tell what I do by the name of the class
class formMe {
	private $data = array();
	private $reqFields = array();
	private $errors = array();
	
	// all of formMe
	public function gatherCleanedData() {
		if (!empty($_POST)) {
			return true;
		} else {return false;}
	}
	// check that required fields have data in them. individual tests still need to be performed
	public function testReqFields() {
		if (!empty($this->reqFields)) {
			foreach ($this->reqFields as $r) {
				if (array_key_exists($r, $this->data) && !empty($this->data[$r])) {
					
				} else {
					array_push($this->errors, $r);
				}
			}
			if (empty($this->errors)) {return true;} else {return false;}
		} else {return true;} // no req fields, so it's all good!
	}
	// unique to this instance
	public function testFile() {
		return false;
	}
	public function testPermalinks() {
		return false;
	}
	public function testUrl() {
		return false;
	}

	// construct pulls the whole thing together.	
	public function __construct($fields,$reqFields='') {
	
		if ($reqFields != '') {
			if (is_bool($reqFields) && $reqFields == true) {
				foreach ($fields as $f) {
					$this->reqFields[] = $f;
				}
			} elseif (is_string($reqFields)) {
				$this->reqFields = $reqFields;
			} elseif (is_array($reqFields)) {
				foreach($reqFields as $r) {
					$this->reqFields[] = $r;
				}
			}
		}		
		// put fields as array keys
		foreach ($fields as $f ) {
			$this->data[$f] = '';
		}
		
		// instance view
		$view = new viewMaker();
		
		// check for submit
		if (isset($_POST['submit'])) {
		} else {	
			// display form for first time
			$view->displayForm($this->data, false);
		}
	}
}

// I assemble the pretty views. Yeah, that's right.
class viewMaker {
	private $viewPath = 'views/';
	
	// for form
	public $data = array();
	public $alert = array();

	// view module specific
	private function getTemplate($fname,$type) {
		$file = $this->viewPath . $fname;
		if (file_exists($file)) {
			// get file
			ob_start();
			$template = include($file);
			$output = ob_get_clean();
			return $output;
		} else { throw new Exception("Form '$path' could not be found.");}
	}
	public function tagWrap($tag,$text) {
		if (is_string($text) && is_string($tag)) {
			$v = "<$tag>$text</$tag>";
			return $v;
		} elseif (is_array($text) && is_string($tag)) {
			$v = '';
			foreach ($text as $t) {
				$v .= "<$tag>$t</$tag>";
			}
			return $v;
		} else {
			throw new Exception('tagWrap called without proper arguments. Check documentation.');
		}
	}
	// all the displays
	public function displayError($var) {
		if (isset($this->alert['error']) && in_array($var, $this->alert['error'])) echo ' class="error"';
	}
	// make the form sticky
	public function formStick($var,$opt=false) {
		// var is the data piece you're looking for. opt is optional
		if (is_string($var)) {
			if (is_bool($opt) && $opt == false) {
				if (array_key_exists($var, $this->data)) {
					echo $this->data[$var];
				}
			} elseif (is_string($opt) && !empty($opt)) {
				if (array_key_exists($var, $this->data) && $this->data[$var] == $opt) {
					echo ' checked="checked"';
				}
			} else {throw new Exception("Option '$opt' given to '$var' formStick does not conform to requirements. Should be bool false or nonempty string.");}
		} else {throw new Exception('Variable given to formStick does not conform to requirement. Should be string.');}
	}
	// show that alert box! $alert['msg'] $alert['type'] $alert[error]
 	private function displayAlert() {
	 	// check alert
	 	if (empty($this->alert) || $this->alert == false) {
		 	// do nothing!
	 	} else {
		 	if (array_key_exists('msg', $this->alert) && array_key_exists('type', $this->alert)) {
			 	// create message
			 	$v = '<div class="alert-box ' . $this->alert['type'] . '">';
			 	$v .= $this->alert['msg'];
			 	if (array_key_exists('error', $this->alert) && !empty($this->alert['error'])) {
				 	$enum = count($this->alert['error']);
				 	if ($enum == 1) {
					 	$e = 'The following field has been highlighted for you: ' . $this->alert['error'][0] . '.';
				 	} elseif ($enum == 2) {
					 	$e = 'The following fields have been highlighted for you: ' . $this->alert['error'][0] . ' and ' . $this->alert['error'][1] . '.';
				 	} else {
					 	$e = 'The following fields have been highlighted for you: ';
					 	for ($i=0;$i<$enum;$i++) {
							switch ($i) {
								case (0);
								$e .= str_replace('_',' ',$this->alert['error'][$i]) . ', ';
								break;
								
								case ($enum-1);
								$e .= ' and ' . str_replace('_',' ',$this->alert['error'][$i]) . '.';
								break;
								
								default;
								$e .= str_replace('_',' ',$this->alert['error'][$i]) . ', ';
								break;
							}
					 	}
				 	}
				 	$v .= $this->tagWrap('p', $e); unset($e);
			 	}
			 	$v .= '</div>';
			 	// send message
			 	return $v;
		 	} else {throw new Exception('Alert contains neither message nor type.');}
	 	}
	}
	public function displayForm($data,$alert) {
		$this->data = $data;
		$this->alert = $alert;
		$v = $this->displayAlert();
		$v .= $this->getTemplate('form.php','form');
		echo $v;		
	}
//	public function displaySuccess($data) {}
}
?>