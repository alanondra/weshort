<?php

namespace App\Services\ShortLinkUploads\Processors;

use Throwable;
use RuntimeException;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\Exceptions\UserException;
use App\Services\ShortLinkUploads\Contracts\ProcessorInterface;
use App\Services\ShortLinkService;
use App\Models\ShortLinkUpload;
use League\Csv\Reader;

class CsvProcessor implements ProcessorInterface
{
	public function __construct(
		protected Filesystem $filesystem,
		protected ShortLinkService $shortLinks
	) {
		//
	}

	/**
	 * Check if the Processor can handle the given UploadedFile.
	 *
	 * @param  \App\Models\ShortLinkUpload  $upload
	 *
	 * @return bool
	 */
	public function canProcess(ShortLinkUpload $upload): bool
	{
		return strtolower($upload->type) == 'text/csv';
	}

	/**
	 * Process the given UploadedFile to create a ShortLinkUpload.
	 * Return a list of ShortLinks.
	 *
	 * @param  \App\Models\ShortLinkUpload  $upload
	 *
	 * @return \App\Models\ShortLink[]
	 */
	public function process(ShortLinkUpload $upload): array
	{
		$shortLinks = [];

		$handle = $this->filesystem->readStream($upload->path);

		try {
			if (empty($handle)) {
				throw new RuntimeException(sprintf('Failed to open handle to file %s', $upload->path));
			}

			$reader = Reader::createFromStream($handle);

			$reader->setHeaderOffset(0);

			$column = array_search('url', array_map('strtolower', $reader->getHeader()));

			if (empty($column)) {
				throw new RuntimeException('Missing column "URL"');
			}

			foreach ($reader->fetchColumn($column) as $cell) {
				$trimmed = try_trim($cell);

				if (empty($trimmed)) {
					continue;
				}

				$url = filter_var($trimmed, FILTER_VALIDATE_URL);

				if (empty($url)) {
					continue;
				}

				$shortLinks[] = $this->shortLinks->create($url, false);
			}
		} catch (Throwable $e) {
			throw new UserException(
				message: 'Sorry, your upload failed. Please try again with a different file.',
				statusCode: 500,
				previous: $e
			);
		} finally {
			fclose($handle);
		}

		if (empty($shortLinks)) {
			throw new UserException('Sorry, no URLs could be found. Please try again with a column labeled "URL" (any case).');
		}

		return $shortLinks;
	}
}
