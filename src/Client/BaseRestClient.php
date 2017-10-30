<?php

namespace TokenService\Client;

class BaseRestClient 
{

	private $curl;
	
	/**
	 * Inicializa cURL
	 */
	private function init()
	{	
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($curl, CURLOPT_TIMEOUT, 30);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$this->curl = $curl;
	}
	
	/**
	 * Ejecuta una peticion GET
	 * 
	 * @param string $uri
	 * @return array
	 * @throws \Exception
	 */
	protected function get($uri)
	{
		$this->init();
		curl_setopt($this->curl, CURLOPT_URL, $uri);
        curl_setopt($this->curl, CURLOPT_POST, false);
		$response = curl_exec($this->curl);
		
		if ($response === false || empty($response)) {
			throw new \Exception('Error in cURL request'. curl_error($this->curl));
		}
		
		$this->close();
		return json_decode($response, true);
	}
	
	/**
	 * Ejecuta una peticion POST
	 * 
	 * @param string $uri
	 * @param array $data
	 * @return array
	 * @throws \Exception
	 */
	protected function post($uri, $data = [])
	{
		$this->init();
		curl_setopt($this->curl, CURLOPT_URL, $uri);  
        curl_setopt($this->curl, CURLOPT_POST, true);  
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data)); 
		$response = curl_exec($this->curl);
		
		if ($response === false || empty($response)) {
			throw new \Exception('Error in cURL request'. curl_error($this->curl));
		}
		
		$this->close();
		return json_decode($response, true);
	}
	
	/**
	 * Cierra la conexion cURL
	 */
	private function close()
	{
		curl_close($this->curl);
	}
	
}