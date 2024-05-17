<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Filesystem\Filesystem;
use Nette\NotImplementedException;
use App\Services\ShortLinkUploads\Contracts\ProcessorInterface;
use App\Models\ShortLinkUpload;

class ShortLinkUploadService
{
	/**
	 * Upload Directory in Filesystem
	 *
	 * @var string|null
	 *
	 * @see config/shortlinks.php
	 */
	protected ?string $directory = null;

	/**
	 * Upload Processors
	 *
	 * @var \App\Services\ShortLinkUploads\Contracts\ProcessorInterface[]
	 *
	 * @see config/shortlinks.php
	 */
	protected array $processors = [
		//
	];

	public function __construct(protected Filesystem $filesystem)
	{
		//
	}

	/**
	 * Set the upload directory in the Filesystem.
	 *
	 * @param string|null $directory
	 *
	 * @return void
	 */
	public function setDirectory(?string $directory)
	{
		$this->directory = $directory;
	}

	/**
	 * Add an upload Processor.
	 *
	 * @param  \App\Services\ShortLinkUploads\Contracts\ProcessorInterface  $processor
	 *
	 * @return void
	 */
	public function addProcessor(ProcessorInterface $processor)
	{
		$this->processors[] = $processor;
	}

	/**
	 * Get the list of ShortLinkUploads.
	 *
	 * @param  int  $page
	 * @param  int  $count
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator<\App\Models\ShortLink>
	 */
	public function getList(
		int $page = 1,
		int $count = 10
	): LengthAwarePaginator {
		$query = ShortLinkUpload::with([
			'shortLinks',
		]);

		return $query->paginate(
			page: max(1, $page),
			perPage: max(1, $count)
		);
	}

	/**
	 * Process the given UploadedFile to create ShortLinks.
	 *
	 * @param  \Illuminate\Http\UploadedFile  $upload
	 *
	 * @return \App\Models\ShortLinkUpload
	 */
	public function process(UploadedFile $upload): ShortLinkUpload
	{
		$shortLinkUpload = $this->store($upload);

		$processor = $this->getProcessor($shortLinkUpload);

		if (is_null($processor)) {
			throw new NotImplementedException();
		}

		$shortLinks = $processor->process($shortLinkUpload);

		$shortLinkUpload->save();

		$shortLinkUpload->shortLinks()->saveMany($shortLinks);

		return $shortLinkUpload;
	}

	/**
	 * Store the UploadedFile to permanent Storage.
	 *
	 * @param  \Illuminate\Http\UploadedFile  $upload
	 *
	 * @return \App\Models\ShortLinkUpload
	 */
	public function store(UploadedFile $upload): ShortLinkUpload
	{
		$stored = new ShortLinkUpload();
		$stored->filename = $upload->getClientOriginalName();
		$stored->type = $upload->getMimeType();
		$stored->size = $upload->getSize() ?: 0;

		$path = $this->filesystem->putFile($this->directory, $upload);

		$stored->path = $path;

		return $stored;
	}

	/**
	 * Get the matching Processor for the given UploadedFile.
	 *
	 * @param  \App\Models\ShortLinkUpload  $upload
	 *
	 * @return \App\Services\ShortLinkUploads\Contracts\ProcessorInterface|null
	 */
	protected function getProcessor(ShortLinkUpload $upload): ?ProcessorInterface
	{
		foreach ($this->processors as $processor) {
			if ($processor->canProcess($upload)) {
				return $processor;
			}
		}
		return null;
	}
}
