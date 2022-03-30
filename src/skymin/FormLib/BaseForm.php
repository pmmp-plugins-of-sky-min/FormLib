<?php
declare(strict_types = 1);

namespace skymin\FormLib;

use pocketmine\form\Form;
use pocketmine\player\Player;

abstract class BaseForm implements Form{

	/** @param \Closure|null $closeHandler signature `function(Player $player)` */
	public function __construct(protected string $title, protected ?\Closure $closeHandler = null){}

	abstract protected function formData() : array;

	public final function jsonSerialize() : array{
		$data = $this->formData();
		$data['title'] = $this->title;
		return $data;
	}

	protected function isClosed(Player $player, $data) : bool{
		if($data === null){
			if($this->close !== null){
				($this->onClose)($player);
			}
			return true;
		}
		return false;
	}

}
