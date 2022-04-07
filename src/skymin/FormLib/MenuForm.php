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

use pocketmine\player\Player;

final class MenuForm extends BaseForm{

	/**
	 * @param Button[] $buttons
	 * @param \Closure|null $closeHandler signature `function(Player $player)`
	 */
	public function __construct(
		string $title,
		private string $content,
		private array $buttons,
		?\Closure $closeHandler = null
	){
		parent::__construct($title, $closeHandler);
	}

	protected function formData() : array{
		return[
			'type' => 'form',
			'content' => $this->content,
			'buttons' => $this->buttons
		];
	}

	public function handleResponse(Player $player, $data) : void{
		if($this->isClosed($player, $data)) return;
		($this->buttons[$data])->handle($player);
	}

}
