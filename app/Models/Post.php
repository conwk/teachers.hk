<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class Post extends Authenticatable
{
	protected $table = 'posts';
	
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [   
        'user_id',
        'title',
        'subtitle',
		 'slug',
        'content',
        'category_id',
        'tags',
        'published',       
        'published_date',       
        'status',
    ];
	
	protected $guarded = ['id', '_token'];

	public function setPublishedDateAttribute($date){

        $this->attributes['published_date'] = Carbon::toFormattedDateString('Y-m-d', $date);
    }


	protected static function boot()
    {
        parent::boot();
        static::created(function ($post) {
            $post->slug = $post->createSlug($post->title);
            $post->save();
        });
    }

    /** 
     * Write code on Method
     *
     * @return response()
     */
    private function createSlug($title)
    {       
		if (static::whereSlug($slug = Str::slug($title))->exists()) {
            $max = static::whereTitle($title)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);            }
            return "{$slug}-2";
        }
        return $slug;
    }

}