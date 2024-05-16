<?php

namespace App\Http\Requests\ShortLinks;

use App\Http\Requests\AbstractFormRequest;

class StoreRequest extends AbstractFormRequest
{
	/**
	 * Get the submitted URL.
	 *
	 * @return string
	 */
	public function getInputUrl(): string
	{
		return $this->input('url');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'url' => ['required', 'url'],
		];
	}
}
