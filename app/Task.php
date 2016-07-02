<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Task extends Model {

    /**
     * Fillable fields
     * 
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'seo_url'
    ];
    
    public static function recentTask() {
        $query = self::query();
        $query->orderBy('updated_at', 'DESC')->take(2);
        return $query->get();
    }

}