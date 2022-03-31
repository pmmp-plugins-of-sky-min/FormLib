<?php
declare(strict_types = 1);

namespace skymin\FormLib;


use pocketmine\player\Player;

use \Closure;

final class ModalForm extends BaseForm{

	/**
	 * @param Closure $submit signature `function(Player $player, bool $data)`
	 * @param Closure|null $closeHandler signature `function(Player $player)`
	 */
	public function __construct(
		string $title,
		private string $content,
		private Closure $submit,
		private string $trueButton = 'gui.yes',
		private string $falseButton = 'gui.no',
		?Closure $closeHandler = null
	){
		parent::__construct($title, $closeHandler);
	}

	public function formData() : array{
		return [
			'type' => 'modal',
			'content' => $this->content,
			'button1' => $this->trueForm,
			'button2' => $this->falseForm
		];
	}

	public function handleResponse(Player $player, $data) : void{
		if($this->isClosed($player)) return;
		($this->closeHandler)($player, $data);
	}

}
