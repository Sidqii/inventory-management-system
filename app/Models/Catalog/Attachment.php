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
        'file_name',
        'file_path',
        'file_type',
        'file_size',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function attachable()
    {
        return $this->morphTo();
    }
}
