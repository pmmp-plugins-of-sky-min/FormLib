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

use pocketmine\form\Form;
use pocketmine\utils\Utils;
use pocketmine\player\Player;

use \Closure;

abstract class BaseForm implements Form{

	protected ?Closure $closeHandler = null;

	/** @param Closure|null $closeHandler signature `function(Player $player)` */
	public function __construct(protected string $title, ?Closure $closeHandler = null){
		if($closeHandler !== null){
			Utils::validateCallableSignature(function(Player $player) : void{}, $closeHandler);
			$this->closeHandler = $closeHandler;
		}
	}

	abstract protected function formData() : array;

	public final function jsonSerialize() : array{
		$data = $this->formData();
		$data['title'] = $this->title;
		return $data;
	}

	protected function isClosed(Player $player, $data) : bool{
		if($data === null){
			if($this->closeHandler !== null){
				($this->closeHandler)($player);
			}
			return true;
		}
		return false;
	}

}
