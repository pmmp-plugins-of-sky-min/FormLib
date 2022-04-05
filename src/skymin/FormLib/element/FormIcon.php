<?php
declare(strict_types = 1);

namespace skymin\FormLib\element;

final class FormIcon implements \JsonSerializable{

	public const IMAGE_TYPE_URL = 'url';
	public const IMAGE_TYPE_PATH = 'path';

	public function __construct(
		private string $image,
		private string $type = self::IMAGE_TYPE_URL
	){}

	public function jsonSerialize(){
		return [
			'type' => $this->type,
			'data' => $this->image
		];
	}

}
