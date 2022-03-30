<?php
declare(strict_types = 1);

namespace skymin\FormLib\element;

final class Dropdown extends Selector{

	protected function elementData() : array{
		return [
			'type' => 'dropdown',
			"options" => $this->options,
			"default" => $this->default
		];
	}

}
