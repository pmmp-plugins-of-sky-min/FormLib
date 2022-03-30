<?php
declare(strict_types = 1);

namespace skymin\FormLib\element;

final class Slider extends Element{

	public function __construct(
		string $text,
		private float $min,
		private float $max,
		private float $step = 1.0,
		private ?float $default = null
	){
		parent::__construct($text);
	}

	protected function elenmentData() : array{
		return [
			'type' => 'slider',
			'min' => $this->min,
			'max' => $this->max,
			'step' => $this->step,
			'default' => $this->default
		];
	}

}
