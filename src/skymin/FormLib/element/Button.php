<?php
declare(strict_types = 1);

namespace skymin\FormLib\element;

use pocketmine\player\Player;

class Button implements \JsonSerialize{

	/**
	 * @param \Closure $handler signature `function(Player $player)`
	 */
	public function __construct(
		private \Closure $handler,
		private string $text,
		private ?FormIcon $icon = null
	){}

	public function jsonSerialize() : array{
		$button = ['text' => $this->text];
		if($this->icon !== null){
			$button['image'] = $this->icon;
		}
		return $button;
	}

	public function getText() : string{
		return $this->text;
	}

	public final function handle(Player $player) : void{
		($this->handler)($player);
	} 

}
