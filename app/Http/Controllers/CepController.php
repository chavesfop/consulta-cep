<?php
namespace App\Http\Controllers;

use Illuminate\Http\{
	Request,
	Response
};

use App\CEPWebManiaBR;

class CepController extends Controller
{
	private $_cep;
	private $_logradouro;
	private $_localidade;
	private $_uf;
	private $_origem = 'cep_cache';

	private $_webMania;
	
	public function __construct(){
		$this->_webMania = CEPWebManiaBR::singleton();
	}
	public function consultar(Request $request)
	{
		$this->_cep = $request->has('cep') ? str_replace([" ", "-"], "", $request->input('cep')) : false;
		$this->_termos = $request->has('termos') ? explode(" ", $request->input('termos')) : false;
		if ($this->_cep){
			$ret = $this->_consultaCepCache();
		}else{
			$ret = $this->_consultaTermos();
		}


		if (!count($ret)){ //não existe o cep na tabela cep_cache
			//verifica em apis externas
			$ret = $this->_webMania->buscar($this->_cep);
			$this->_origem = $ret[count($ret)-1];
			$this->_adicionarCepCache($ret);
			unset($ret[count($ret)-1]);
			
			if (!count($ret))
				return response()->json(['erro' => 'CEP não encontrado'], 404);
		}
		return $this->_consultaCepCache();
	}

	private function _consultaCepCache()
	{
		$sql = "SELECT * FROM cep_cache ";
		if ($this->_cep){
			$sql .= "WHERE cep = ?";
		}
		$retorno = app('db')->select($sql, [$this->_cep]);
		return $retorno;
	}

	private function _adicionarCepCache($arrayData){
		$arrayData[0] = $this->_cep;
		$sql = "INSERT INTO cep_cache (cep, logradouro, localidade, uf, origem) VALUES (?, ?, ?, ?, ?)";
		app('db')->insert($sql, $arrayData);
	}

	private function _consultaTermos(){
		$ufs = ['AC','AL','AM','AP','BA','CE','DF','ES','GO',
			'MA','MG','MS','MT','PA','PB','PE','PI','PR',
			'RJ','RN','RO','RR','RS','SC','SE','SP','TO'];

		$sanitizedTermos = [];
		$where = ["UF" => [], "LOCA" => [], "LOGR" => []];
		foreach ($this->_termos as $termo){ 
			if (in_array(strtoupper($termo), $ufs)){
				$where["UF"][] = ["OR" => strtoupper($termo)];
				continue;
			}

			$termoConsuta = str_replace([",",".","-"], "", $termo);
			if (strlen($termoConsulta) < 3)
				continue;
			
			$where["LOCA"][] = [""]

		} 
		//exemplo: Rua João Bernardino da Rosa, Palhoça, SC
		//exemplo 2: R Joao Bernardino da Rosa, Palhoca, SC
	}
}
