<?php

namespace App;

class Geocode {
	public static function property( Property $property ) {
		if ( $property->lat && $property->long ) {
			return;
		}

		$response = json_decode( \Geocoder::geocode( 'json', [
			'address'    => $property->full_address,
			'components' => 'country:' . $property->country
		] ) );

		$lat  = isset( $response->results[0]->geometry->location->lat ) ? $response->results[0]->geometry->location->lat : 0.0;
		$long = isset( $response->results[0]->geometry->location->lat ) ? $response->results[0]->geometry->location->lng : 0.0;

		$property->update( [
			'lat'  => $lat,
			'long' => $long,
		] );
	}
}
