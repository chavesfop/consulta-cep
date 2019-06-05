<?php
namespace App;

class CEPWebManiaBR 
{
	private $_appKey;
	private $_appSecret;
	private static $_instance = false;

	private function __construct(){
		$this->_appKey = getenv("CEP_KEY");
		$this->_appSecret = getenv("CEP_PASSWORD");
	}

	public static function singleton(){
		if (!self::$_instance)
			self::$_instance = new self();
		return self::$_instance;
	}

	public function buscar($cep){
		//aqui os CEPs tem formato 00000-000
		$sanitizedCep = $cep;
		if (strlen($cep) != 9 || strpos("-", $cep) === false){
			if (strlen($cep) != 8)
				return [];
			$sanitizedCep = substr($cep, 0, 5)."-".substr($cep, 5);
		}

		$clienteHttp = new \GuzzleHttp\Client();
		$res = $clienteHttp->request('GET', "https://webmaniabr.com/api/1/cep/{$sanitizedCep}/?app_key={$this->_appKey}&app_secret={$this->_appSecret}");
		$ret = json_decode($res->getBody()->__toString(), true);
		if (isset($ret['error']))
			return [];
		return [$sanitizedCep,
			$ret['endereco'],
			$ret['cidade'],
			$ret['uf'],
			'webmaniabr.com'
		];
	}
}
