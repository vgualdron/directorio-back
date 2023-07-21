<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'email',
        'phone',
        'whatsapp',
        'linkweb',
        'facebook',
        'instagram',
        'latitud',
        'longitud',
        'schedule',
        'payments',
        'status',
        'city_id',
        'plan_id',
        'plan_date_initial',
        'category_id',
        'user_id',
    ];
    
    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
    
    public function plan()
    {
        return $this->hasOne(Plan::class, 'id', 'plan_id');
    }
    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}
