<?php
declare(strict_types = 1);

namespace skymin\FormLib\element;

final class Input extends Element{

	public function __construct(
		string $text,
		private string $hint = '',
		private string $default = ''
	){
		parent::__construct($text);
	}

	protected function elementData() : array{
		return [
			'type' => 'input',
			'placeholder' => $this->hint,
			'default' => $this->default
		]
	}

}
