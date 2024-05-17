<?php

namespace App\Exceptions;

use Throwable;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

/**
 * An Exception to show an unfiltered message to the User.
 */
class UserException extends RuntimeException implements HttpExceptionInterface
{
	/**
	 * HTTP Status Code
	 *
	 * @var int
	 */
	protected int $statusCode = 400;

	/**
	 * HTTP Response Headers
	 *
	 * @var array
	 */
	protected array $headers = [];

	/**
	 * An Exception to show an unfiltered message to the User.
	 *
	 * @param  string|null  $message  Exception message.
	 * @param  int $code  Exception code.
	 * @param  int  $statusCode  HTTP status code.
	 * @param  array  $headers  HTTP response headers.
	 * @param  \Throwable|null  $previous  Previous Exception.
	 */
	public function __construct(
		?string $message = null,
		int $code = 0,
		int $statusCode = 400,
		array $headers = [],
		?Throwable $previous = null
	) {
		parent::__construct($message, $code, $previous);

		$this->statusCode = $statusCode;
		$this->headers = $headers;
	}

	/**
	 * Returns the status code.
	 */
	public function getStatusCode(): int
	{
		return $this->statusCode;
	}

	/**
	 * Returns response headers.
	 */
	public function getHeaders(): array
	{
		return $this->headers;
	}
}
