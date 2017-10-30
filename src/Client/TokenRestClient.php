<?php

namespace TokenService\Client;

use TokenService\Client\BaseRestClient;

class TokenRestClient extends BaseRestClient
{
	/**
	 *
	 * @var string
	 */
	private $uri;
		
	/**
	 * 
	 * @param string $uri
	 */
	public function __construct($uri) 
	{
		$this->uri = $uri;
	}
	
	/**
	 * 
	 * @param array $data
	 * @return array
	 */
	public function accessToken($data = [])
	{
		return $this->post($this->uri, $data);
	}
	
	/**
	 * 
	 * @param string $token
	 * @return array
	 */
	public function verifyToken()
	{
		return $this->get($this->uri);
	}
}
