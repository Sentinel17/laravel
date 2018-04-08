<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Lesson extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['title', 'slug', 'lesson_image', 'short_text', 'full_text', 'position', 'downloadable_files', 'free_lesson', 'published', 'course_id'];
    
    public function setCourseIdAttribute($input)
    {
        $this->attributes['course_id'] = $input ? $input : null;
    }

    public function setPositionAttribute($input)
    {
        $this->attributes['position'] = $input ? $input : null;
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')->withTrashed();
    }

    public function test() {
        return $this->hasOne('App\Test');
    }

    public function students()
    {
        return $this->belongsToMany('App\User', 'lesson_student')->withTimestamps();
    }
    
}
