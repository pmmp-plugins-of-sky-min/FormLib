<?php
declare(strict_types = 1);

namespace skymin\FormLib;

use skymin\FormLib\element\Element;

use pocketmine\player\Player;

use \Closure;

final class CustomForm extends BaseForm{

	/**
	 * @param Element[] $elements
	 * @param Closure $submit signature `function(Player $player, array $data)`
	 * @param Closure|null $closeHandler signature `function(Player $player)`
	 */
	public function __construct(
		string $title,
		private array $elements,
		private Closure $submit,
		?Closure $closeHandler = null
	){
		parent::__construct($title, $closeHandler);
	}

	protected function formData() : array{
		return [
			'type' => 'custom_form',
			'content' => $this->elements
		];
	}

	public function handleResponse(Player $player, $data) : void{
		if($this->isClosed($player, $data)) return;
		($this->submit)($player, $data);
	}

}
