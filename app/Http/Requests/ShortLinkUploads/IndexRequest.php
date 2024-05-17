<?php

namespace App\Http\Requests\ShortLinkUploads;

use App\Http\Requests\AbstractFormRequest;
use App\Http\Requests\Concerns\HasPagination;

class IndexRequest extends AbstractFormRequest
{
	use HasPagination;

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		$rules = [];

		$rules += $this->getPaginationRules();

		return $rules;
	}
}
