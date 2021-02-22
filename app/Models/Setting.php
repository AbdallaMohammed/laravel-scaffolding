<?php

namespace App\Models;

use App\Models\Concerns\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;

class Setting extends \Laraeast\LaravelSettings\Models\Setting implements HasMedia
{
    use HasUploader,
        HasMediaTrait;
}
