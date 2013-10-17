<?php

class Ontime_API extends RestRequest
{

	protected $access_token;

	function get_access_token()
	{
		if ( !$this->access_token ) {
			$args = array(
				'grant_type' => 'password',
				'username' => ONTIME_USERNAME,
				'password' => ONTIME_PASSWORD,
				'scope' => 'read write',
				'client_id' => ONTIME_ID,
				'client_secret' => ONTIME_SECRET
			);
			$this->buildUrl( ONTIME_URL . 'api/oauth2/token/', $args );

			$this->execute();
			$response = json_decode( $this->responseBody );
			var_dump( $response );
			$this->access_token = $response->access_token;
		}
		return $this->access_token;
	}

	function get( $endpoint, $args = array() )
	{
		$defaults = array(
			'access_token' => $this->get_access_token()
		);

		$data = array_merge( $defaults, $args );
		$this->buildUrl( ONTIME_URL . 'api/v2/' . $endpoint, $data );
		$this->execute();
		return json_decode( $this->responseBody );
	}

}

?>