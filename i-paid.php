<?php

/**
 * WnIPaid v1.0 (https://github.com/whatysonneves/i-paid)
 * Developed by Whatyson Neves <contato@whatysonneves.com>
 * 
 * Este arquivo é um conceito, você deve implementa-lo de acordo com seu projeto
 */
class WnIPaid
{

	/**
	 * Retorna o output para o client
	 * @return HTTP Response
	 */
	public function run()
	{
		http_response_code(200);
		header("Content-Type: text/javascript; Charset=UTF-8");
		$response = file_get_contents($this->getScript());
		return exit($response);
	}

	/**
	 * Sabe se o domínio está listado e retorna o script correto para o caso
	 * @return string
	 */
	protected function getScript()
	{
		$domain = $this->getDomain();
		$clients = $this->clients();
		if(array_key_exists($domain, $clients)) {
			return ( $clients[$domain]? "ok.js" : "expired.js" );
		} else {
			return "default.js";
		}
	}

	/**
	 * Retorna o domínio limpo e sem subdomínios
	 * @return string
	 */
	protected function getDomain()
	{
		$url = ( array_key_exists("HTTP_REFERER", $_SERVER)? $_SERVER["HTTP_REFERER"] : "example.com" );
		return $this->extractDomain($url);
	}

	/**
	 * Retorna o domínio limpo e sem subdomínios
	 * Esta função é cortesia de suncat100 (https://stackoverflow.com/users/3040364/suncat100)
	 * Fonte: https://stackoverflow.com/a/49338205
	 * @param $url
	 * @return string
	 */
	protected function extractDomain($url)
	{
		$url = $this->clearDomain($url);
		$url = strtolower(trim($url));
		$count = substr_count($url, ".");
		if($count === 2) {
			if(strlen(explode(".", $url)[1]) > 3) $url = explode(".", $url, 2)[1];
		} elseif($count > 2) {
			$url = $this->extractDomain(explode(".", $url, 2)[1]);
		}
		return $url;
	}

	/**
	 * Remove tudo que não é necessário do domínio
	 * @return string
	 */
	protected function clearDomain($url)
	{
		return rtrim(preg_replace("/^http(s)?:\/\/(.+?)\/(.+)/i", "$2", $url), "/");
	}

	/**
	 * Retorna todos os clientes que estão autorizados ou não a funcionar
	 * @return array
	 */
	protected function clients()
	{
		return json_decode(file_get_contents("clients.json"), true);
	}
}

$i_paid = new WnIPaid;
$i_paid->run();
