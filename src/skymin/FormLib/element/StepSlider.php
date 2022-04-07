<?php
declare(strict_types = 1);

namespace skymin\FormLib\element;

final class StepSlider extends Selector{

	public function elementData() : array{
		return [
			'type' => 'step_slider',
			'text' => $this->text,
			'steps' => $this->options,
			'default' => $this->default
		];
	}

}
