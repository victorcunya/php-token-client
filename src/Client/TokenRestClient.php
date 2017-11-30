<?php

namespace TokenService\Client;


class TokenRestClient extends BaseRestClient
{
	/**
	 * @var string
	 */
	private $uri;
		
	/**
	 * @param string $uri
	 */
	public function __construct($uri) 
	{
		$this->uri = $uri;
	}
	
	/**
	 * @param array $data
	 * @return array
	 */
	public function accessToken($data = [])
	{
		return $this->post($this->uri, $data);
	}
	
	/**
	 * @return array
	 */
	public function verifyToken()
	{
		return $this->get($this->uri);
	}
}
