<?php
namespace FormForge;

interface FormForge_Interface{
	const DEFAULT_FORM_NAME = 'form';
	public function __construct();
	public function textBox();
}

interface FF_Text_Interface{
	const DEFAULT_TEXT_NAME = 'text';
}

class FormForge implements FormForge_Interface{
	private $name = self::FF_DEFAULT_FORM_NAME;
	private $elements = array();
	private $text = array();
	private $check = array();
	private $radio = array();
	private $select = array();
	private $textbox = array();
	private $current_element = NULL;
	
	public function __construct($name = '', $attributes = array()){
		if(is_scalar($name) && !empty($name)) $this->name = $name;
	}
	
	public static function init($name = '', $attributes = array()){
		$self = get_called_class();
		return new $self($name, $attributes);
	}
	
	private function new_element(){
		return ($this->current_element = &$this->elements[]);
	}
	
	public function textBox($name = '', $attributes = array(), $ispw = false){
		$this->text[] = $this->new_element();
		$this->current_element = new FF_Text($name, $attributes);
		return $this->current_element;
	}
	
	public function __toString(){
		$out = '';
	}
}

class FF_Text implements FF_Text_Interface{
	private $name = self::DEFAULT_TEXT_NAME;
	private $attrs;
	private $html;
	
	public function __construct($name, $attributes = array()){
		$this->name = $name;
		$this->attrs = $attributes;
		if(!empty($name)){
			$this->html = "<input type=\"text\" name=\"$name\"";
			if(!empty($attributes)){
				$this->html .= ' ';
				foreach($attributes as $attr => $value) $this->html .= "$attr=\"$value\"";
			}
			$this->html = " />";
		}else $this->html = '';
	}
}
?>
