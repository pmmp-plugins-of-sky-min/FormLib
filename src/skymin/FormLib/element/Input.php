<?php
declare(strict_types = 1);

namespace skymin\FormLib\element;

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
		private string $type = self::TYPE_STRING
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

	public function changeData(string $data) : false|int|float|string{
		return match($this->type){
			self::TYPE_STRING => $data,
			self::TYPE_INT => is_numeric($data) ? (int) $data : false,
			self::TYPE_FLOAT => is_numeric($data) ? (float) $data : false,
			default => false
		};
	}

}
