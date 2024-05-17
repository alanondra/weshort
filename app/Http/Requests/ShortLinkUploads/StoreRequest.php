<?php

namespace App\Http\Requests\ShortLinkUploads;

use Illuminate\Validation\Rules\File;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\AbstractFormRequest;

class StoreRequest extends AbstractFormRequest
{
	/**
	 * Get the uploaded file.
	 *
	 * @return \Illuminate\Http\UploadedFile
	 */
	public function getUploadFile(): UploadedFile
	{
		return $this->file('file');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		$files = File::types([
			'text/csv',
			'text/plain',
		])
		->max('1mb');

		return [
			'file' => [ 'required', $files ],
		];
	}
}
