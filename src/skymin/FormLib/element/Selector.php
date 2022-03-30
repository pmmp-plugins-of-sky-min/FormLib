<?php
declare(strict_types = 1);

namespace skymin\FormLib\element;

abstract class Selector extends Element{

	public function __construct(
		string $text,
		protected array $options,
		protected int $default = 0
	){
		parent::__construct($text);
	}

	public final function getOption(int $index) : ?string{
		return $this->options[$index] ?? null
	}

}
