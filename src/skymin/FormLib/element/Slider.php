<?php
/**
 *      _                    _       
 *  ___| | ___   _ _ __ ___ (_)_ __  
 * / __| |/ / | | | '_ ` _ \| | '_ \ 
 * \__ \   <| |_| | | | | | | | | | |
 * |___/_|\_\\__, |_| |_| |_|_|_| |_|
 *           |___/ 
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the MIT License. see <https://opensource.org/licenses/MIT>.
 * 
 * @author skymin
 * @link   https://github.com/sky-min
 * @license https://opensource.org/licenses/MIT MIT License
 * 
 *   /\___/\
 * 　(∩`・ω・)
 * ＿/_ミつ/￣￣￣/
 * 　　＼/＿＿＿/
 *
 */

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

	protected function elementData() : array{
		return [
			'type' => 'slider',
			'min' => $this->min,
			'max' => $this->max,
			'step' => $this->step,
			'default' => $this->default
		];
	}

}
