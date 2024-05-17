<?php

if (!function_exists('base62_decode')) {
	/**
	 * Decodes data encoded with base 62.
	 *
	 * @param  string  $data
	 *
	 * @return string
	 */
	function base62_decode(string $data): string
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
	function base62_encode(string $data): string
	{
		$base62 = new Tuupola\Base62();

		return $base62->encode($data);
	}
}

if (!function_exists('str_escape_sql_like')) {
	/**
	 * Escape strings for SQL `LIKE` comparisons.
	 *
	 * @param  string|null  $input
	 *
	 * @return string|null
	 */
	function str_escape_sql_like(?string $input): ?string
	{
		if (is_null(try_trim($input))) {
			return null;
		}

		return addcslashes($input, '%_');
	}
}

if (!function_exists('try_trim')) {
	/**
	 * Null-safe trim and coalesce empty trimmed strings to nulls.
	 *
	 * @param  string|null  $input
	 *
	 * @return string|null
	 */
	function try_trim(?string $input): ?string
	{
		if (empty($input)) {
			return null;
		}

		return trim($input) ?: null;
	}
}
