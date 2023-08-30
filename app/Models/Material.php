<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = 'materials';
    protected $fillable = ['group_id', 'name', 'file','filePath', 'link'];

    public function group()
    {
        return $this->belongsTo(Group::class ,'group_id');
    }
}
