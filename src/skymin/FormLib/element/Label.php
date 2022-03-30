<?php
declare(strict_types = 1);

namespace skymin\FormLib\element;

final class Label extends Element{

	protected function elementData() : array{
		return ['type' => 'label'];
	}

}
