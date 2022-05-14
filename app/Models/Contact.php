<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class Contact extends Authenticatable
{
	protected $table = 'contact';
	
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [   
		'user_id',
		'type',
		'contact_method',
		'contact',
		'message',
		'created_at',       
    ];
	
	protected $guarded = ['id', '_token'];

	public function setPublishedDateAttribute($date){

        $this->attributes['created_at'] = Carbon::toFormattedDateString('Y-m-d', $date);
    }


}