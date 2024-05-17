<?php

namespace App\DataViews\Attributes;

use LogicException;
use Attribute;
use Illuminate\Database\Eloquent\Model;

#[Attribute(Attribute::TARGET_CLASS)]
class UseModel
{
	/**
	 * Specify the Model to be used.
	 *
	 * @param string $modelClass
	 */
	public function __construct(public readonly string $modelClass)
	{
		if (!is_subclass_of($modelClass, Model::class)) {
			throw new LogicException(sprintf(
				'%s expects a class name as a subclass of %s; %s provided.',
				static::class,
				Model::class,
				$modelClass
			));
		}
	}
}
