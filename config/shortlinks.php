<?php

use App\Services\ShortLinkUploads\Processors;

return [

	'uploads' => [

		/**
		 * Upload directory.
		 */
		'directory' => 'shortlinks',

		/**
		 * List of Processors to handle ShortLink uploads.
		 *
		 * @see \App\Services\ShortLinkUploads\Contracts\ProcessorInterface
		 */
		'processors' => [
			Processors\CsvProcessor::class,
			Processors\PlainTextProcessor::class,
		],

	],

];
