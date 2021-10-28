<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Glass extends Model
{
    use HasFactory;
    // use softDeletes;
    protected $fillable = [
        'id',
        'updated_at'
    ];
    public static function getUserGeneration($user_id){
        $generation = Glass::select('generation')->where('user_id',$user_id)->max('generation');
        $result = null;
        if($generation==null){
            $result = 1;
        }else{
            $result = $generation+1;
        }
        return $result;
    }
}
