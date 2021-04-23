<?php

/**
 * @author Hendrik Hamming <info@hhamming.nl>
 * @param mixed $var
 * @param mixed $var2
 */

function debug_double($var, $var2)
{
	if(!WP_DEBUG)return;
	echo '<style>.prehead{display: block; float: left; width: 45%;}</style>';
	debug($var);
	debug($var2);
}
/**
 * 
 * @param string $var
 * @param boolean $label
 */
function debug($var, $label = false){
//	if (is_array($var) || $var instanceof ArrayAccess)
//	{
//		debug_array($var);
//		exit;
//	}
	if(!WP_DEBUG)return;
	echo '<pre style="border:1px solid #222; padding: 5px;max-width: 800px;margin: 40px 20px;" class="prehead">';
	$debug = DEBUG::i($var, $label);
	
	echo '<span style="border-bottom:1px solid #777;display:block; padding: 4px;font-style:italic; margin-bottom:10px;">'.$debug->getLabel().'</span>';
	echo '<div style="">';

//	if (is_null($var)|| is_int($var)||  is_bool($var) || $var == ''){
		var_dump($var);
//	} else {
//		print_r($var);
//	}
	echo '</div>';

	echo '<span style="font-style:italic; border-top: 1px solid #777; padding: 4px; margin-top: 10px;display:block;font-size: 12px;">' . $debug->footer .'</span>';
	echo "</pre>";
}

function debug_error($var, $label = false)
{
	if(!WP_DEBUG)return;
	echo '<pre style="border:1px solid #222; padding: 5px;max-width: 800px;margin: 40px 20px;border-color: #f00">';
	$debug = DEBUG::i($var, $label);
	$debug->addLabel('Error', '', 0);
	echo '<span style="border-bottom:1px solid #777;display:block; padding: 4px;font-style:italic; margin-bottom:10px; background: #f00">'.$debug->getLabel().'</span>';
	echo '<div style="background: #fff">';

	if (is_null($var)|| is_int($var)||  is_bool($var) || $var == ''){
		var_dump($var);
	} else {
		print_r($var);
	}
	echo '</div>';

	echo '<span style="font-style:italic; border-top: 1px solid #777; padding: 4px; margin-top: 10px;display:block;font-size: 12px;">' . $debug->footer .'</span>';
	echo "</pre>";
}

/**
 * debug view function
 * 
 * @author Hendrik Hamming <hendrik@madscripter.eu>
 *
 * @param array $array
 * @uses DEBUG
 * @return 
 */
function debug_array( $array)
{
	if(!WP_DEBUG)return;
			
	echo '<pre style="border:1px solid #222; padding: 5px;max-width: 800px;margin: 40px 20px;">';
	$debug = DEBUG::i('');
	echo '<span style="border-bottom:1px solid #777;display:block; padding: 4px;font-style:italic; margin-bottom:10px;">'.$debug->getLabel().'</span>';
	if (!function_exists('debug_row'))
	{
	function debug_row($row, $label = false)
	{
		if (is_array($row) || $row instanceof ArrayAccess)
		{
			foreach ($row as $key => $value)
			{
				debug_row($value, $key);
			}
			return; 
		}
		echo '<span style="border-bottom:1px solid #777;display:block; padding: 4px;font-style:italic; margin-bottom:10px;">'.$label.'</span>';
		echo '<div style="border:1px solid #222; padding: 5px;max-width: 800px;margin: 40px 20px;">';

		if (is_null($row)|| is_int($row)||  is_bool($row) || $row == ''){
			var_dump($row);
		} else {
			var_dump($row);
		}
		echo '</div>';
	}
	}
	foreach ($array as $key => $value)
	{
		debug_row($value, $key);
		
	}
	echo '<span style="font-style:italic; border-top: 1px solid #777; padding: 4px; margin-top: 10px;display:block;font-size: 12px;">' . $debug->footer .'</span>';
	echo "</pre>";
}

class DEBUG {
	private static $instance = false;
	private static $instances = array();
	private $label = array();
	public static $counter = 0;
	private $var;
	private $file;
	public $footer = '';
	private $contents;
	private $backtrace;

	public function __construct($var, $label = false) {
		$this->var = $var;
		$this->parse_backtrace();
		$this->setLabel($label);
		$this->setFooter();
	}

	private function parse_backtrace (){
		$b = debug_backtrace();
		$this->backtrace = $b;
		$index = $this->get_backtrace_index();
		
		$this->file = new stdClass();
		$this->file->path = str_replace(__DIR__.'/', '', $b[$index]['file']);
		$this->file->line = $b[$index]['line'];
		
		$line = trim(file($b[$index]['file'])[$b[$index]['line']-1]);
		$matches = [];
		preg_match_all('/debug(_[a-z]*){0,1}\(([^\)]+)\)/', $line, $matches);
		
		$this->contents = $matches[2][DEBUG::$counter-1];
		if(count($matches[2])==DEBUG::$counter){
			DEBUG::reset ();
		}
	}
	
	private function get_backtrace_index()
	{
		$index = 3;
		if (str_replace(__DIR__.'/', '', $this->backtrace[$index]['file']) == 'debug.php')
		{
			$index++;
		}
		return $index;
	}

	/**
	 * 
	 * @param string $value
	 * @param string $key
	 * @param int $location The location of the label. -1 means it is pushed at the end
	 */
	public function addLabel (string $value, string $key = '', int $location = -1)
	{
		if ($key == '')
			$str = '<b>'.$value.'</b>';
		else
			$str = '<b>'.$key.'</b>' . $value;
		if ($location < 0)
		{
			array_push($this->label, $str);
		}
		else
		{
			array_unshift($this->label, $str);
		}
	}
	
	private function setLabel ($label = false){
		if($label !== false){
			$this->label[] = '<b>Label:</b> ' . (string)$label;
		}
		$index = $this->get_backtrace_index() + 1;
		if(isset($this->backtrace[$index])){
			if( isset($this->backtrace[$index]['class'])){
			$this->label[] = '<b>Class:</b> ' . $this->backtrace[$index]['class'] . '';
			}
			if(isset($this->backtrace[$index]['function'])){
			$this->label[] = '<b>Function:</b> ' . $this->backtrace[$index]['function'];
			}
		}
		if(!preg_match('/^\'|^"/', substr($this->contents,0,1))){
			$this->label[] = '<b>Var:</b> ' . $this->contents;
		}
	}

	public function getLabel (){
		return (string)join("\r\n", $this->label);
	}

	private function setFooter (){
		$this->footer = $this->file->path . ' Line: ' . $this->file->line;
	}

	private static function reset(){
		self::$instances = array();
		self::$counter =0;
	}

	public static function getInstances(){
		return self::$instances;
	}
	public static function countInstances(){
		return count(self::$instances);
	}
	
	public static function i($var, $label = false){
		self::$counter++;
		self::$instance = new DEBUG($var, $label);
		self::$instances[] = self::$instance;

		return self::$instance;
	}

}
