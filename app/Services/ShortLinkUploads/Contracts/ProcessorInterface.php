<?php

namespace App\Services\ShortLinkUploads\Contracts;

use App\Models\ShortLinkUpload;

interface ProcessorInterface
{
	/**
	 * Check if the Processor can handle the given UploadedFile.
	 *
	 * @param  \App\Models\ShortLinkUpload  $upload
	 *
	 * @return bool
	 */
	public function canProcess(ShortLinkUpload $upload): bool;

	/**
	 * Process the given UploadedFile to create a ShortLinkUpload.
	 * Return a list of ShortLinks.
	 *
	 * @param  \App\Models\ShortLinkUpload  $upload
	 *
	 * @return \App\Models\ShortLink[]
	 */
	public function process(ShortLinkUpload $upload): array;
}
