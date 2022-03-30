<?php
declare(strict_types = 1);

namespace skymin\FormLib\element;

final class Toggle extends Element{

	public function __construct(string $text, private bool $default = false){
		parent::__construct($text);
	}

	protected function elementData() : array{
		return [
			'type' => 'toggle',
			'default' => $this->default
		];
	}

}
