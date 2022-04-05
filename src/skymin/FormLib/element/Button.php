<?php
declare(strict_types = 1);

namespace skymin\FormLib\element;

use pocketmine\utils\Utils;
use pocketmine\player\Player;

final class Button implements \JsonSerializable{

	/**
	 * @param \Closure $handler signature `function(Player $player)`
	 */
	public function __construct(
		private \Closure $handler,
		private string $text,
		private ?FormIcon $icon = null
	){
		Utils::validateCallableSignature(function(Player $player) : void{}, $this->handler);
	}

	public function jsonSerialize() : array{
		$button = ['text' => $this->text];
		if($this->icon !== null){
			$button['image'] = $this->icon;
		}
		return $button;
	}

	public function handle(Player $player) : void{
		($this->handler)($player);
	} 

}
