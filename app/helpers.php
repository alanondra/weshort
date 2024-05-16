<?php

if (!function_exists('base62_decode')) {
	/**
	 * Decodes data encoded with base 62.
	 *
	 * @param  string  $data
	 *
	 * @return string
	 */
	function base62_decode(string $data)
	{
		$base62 = new Tuupola\Base62();

		return $base62->decode($data);
	}
}

if (!function_exists('base62_encode')) {
	/**
	 * Encodes data with base 62.
	 *
	 * @param  string  $data
	 *
	 * @return string
	 */
	function base62_encode(string $data)
	{
		$base62 = new Tuupola\Base62();

		return $base62->encode($data);
	}
}
