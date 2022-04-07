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

use skymin\FormLib\element\{Element, Label, Input, Selector};

use pocketmine\utils\Utils;
use pocketmine\player\Player;

use \Closure;
use function trim;

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
		Utils::validateCallableSignature(function(Player $player, array $data) : void{}, $this->submit);
	}

	protected function formData() : array{
		return [
			'type' => 'custom_form',
			'content' => $this->elements
		];
	}

	public function handleResponse(Player $player, $data) : void{
		if($this->isClosed($player, $data)) return;
		$newData = [];
		foreach($this->elements as $key => $element){
			if($element instanceof Label) continue;
			if(!isset($data[$key])){
				if($element instanceof Input){
					$newData[] = $element->getDefault();
					continue;
				}
				$newData[] = null;
				continue;
			}
			if($element instanceof Selector){
				$newData[] = $element->getOption($data[$key]);
				continue;
			}
			if($element instanceof Input){
				if(trim($data[$key]) === ''){
					$newData[] = $element->getDefault();
					continue;
				}
				$newData[] = $element->changeData($data[$key]);
				continue;
			}
			$newData[] = $data[$key];
		}
		($this->submit)($player, $newData);
	}

}
