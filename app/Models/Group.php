<?php

namespace App\Models;
use App\Models\Course;
use App\Models\Material;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = ['name','course_id'];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class ,'course_id');
    }

}
