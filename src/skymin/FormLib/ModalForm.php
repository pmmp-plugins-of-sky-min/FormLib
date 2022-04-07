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

namespace skymin\FormLib;

use skymin\FormLib\element\Button;

use pocketmine\utils\Utils;
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
		Utils::validateCallableSignature(function(Player $player, bool $data) : void{}, $this->submit);
	}

	public function formData() : array{
		return [
			'type' => 'modal',
			'content' => $this->content,
			'button1' => $this->trueButton,
			'button2' => $this->falseButton
		];
	}

	public function handleResponse(Player $player, $data) : void{
		if($this->isClosed($player, $data)) return;
		($this->submit)($player, $data);
	}

}
