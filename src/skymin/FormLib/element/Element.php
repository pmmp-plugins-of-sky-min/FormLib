<?php
declare(strict_types = 1);

namespace skymin\FormLib\element;

abstract class Element implements \JsonSerialize{

	public function __construct(protected string $text){}

	abstract protected function elementData() : array;

	public final function jsonSerialize() : array{
		$data = $this->elementData();
		$data['text'] = $this->text;
		return $data;
	}

}
