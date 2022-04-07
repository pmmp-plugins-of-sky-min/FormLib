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

use function is_int;
use function is_float;
use function is_string;
use function is_numeric;

final class Input extends Element{

	public const TYPE_INT = 'int';
	public const TYPE_FLOAT = 'float';
	public const TYPE_STRING = 'string';

	public function __construct(
		string $text,
		private int|float|string $default = '',
		private string $hint = '',
		private string $type = self::TYPE_STRING,
		/**
		 * @see Input::changeData()
		 * @see Input::getDefault()
		 */
		private bool $canReturnDefault = false
	){
		parent::__construct($text);
	}

	protected function elementData() : array{
		$default = $this->default;
		return [
			'type' => 'input',
			'placeholder' => $this->hint,
			'default' => is_string($default) ? $default : (string) $default
		];
	}

	public function getDefault() : null|int|float|string{
		if(!$this->canReturnDefault) return null;
		$default = $this->default;
		if(trim($default) === ''){
			return null;
		}
		return match($this->type){
			self::TYPE_STRING => is_string($default) ? $default : (string) $default,
			self::TYPE_INT => is_numeric($default) ? (int) $default : null,
			self::TYPE_FLOAT => is_numeric($default) ? (float) $default : null,
			default => null
		};
	}

	public function changeData(string $data) : false|int|float|string{
		return match($this->type){
			self::TYPE_STRING => $data,
			self::TYPE_INT => $this->changeInt($data),
			self::TYPE_FLOAT => $this->changeFloat($data),
			default => false
		};
	}

	private function changeInt(string $data) : false|int{
		if(is_numeric($data)){
			return (int) $data;
		}
		if($this->canReturnDefault){
			$default = $this->default;
			if(is_int($default)){
				return $default;
			}
			if(is_numeric($default)){
				return (int) $default;
			}
		}
		return false;
	}

	private function changeFloat(string $data) : false|float{
		if(is_numeric($data)){
			return (float) $data;
		}
		if($this->canReturnDefault){
			$default = $this->default;
			if(is_float($default)){
				return $default;
			}
			if(is_numeric($default)){
				return (float) $default;
			}
		}
		return false;
	}

}
