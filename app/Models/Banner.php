<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    const ONLY_TEXT = 'text';
    const TEXT_WITH_BUTTON = 'text_button';
    const TEXT_WITH_BUTTON_AND_IMAGE = 'text_button_image';
    const TEXT_WITH_IMAGE = 'text_image';
    const ONLY_IMAGE = 'image';

    const TYPES = [
        self::ONLY_TEXT,
        self::TEXT_WITH_BUTTON,
        self::TEXT_WITH_BUTTON_AND_IMAGE,
        self::TEXT_WITH_IMAGE,
        self::ONLY_IMAGE,
    ];

    protected $fillable = [
        'shop_id',
        'order',
        'title',
        'text',
        'type',
        'button_text',
        'button_link',
        'button_background',
        'button_color',
        'background',
        'color',
        'uuid',
    ];

    public function getImage() {
        $filenames = Storage::disk('public')->files($this->uuid . '/images');

        return count($filenames) ? array_map(function ($image) {
            return Storage::disk('public')->url($image);
        }, $filenames)[0] : null;
    }

    public function getImageName() {
        $file = Storage::disk('public')->files($this->uuid . '/images');
        $name = count($file) ? explode('/', $file[0]) : null;
        return $name ? $name[count($name) - 1] : null;
    }
}
