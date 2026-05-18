<?php

namespace App\Models\Catalog;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'attachable',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
    ];

    public function uploader()
    {
        return $this->hasMany(User::class);
    }
}
