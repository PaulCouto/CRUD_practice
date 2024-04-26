<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'category_id', 'active'
    ];

    // protected $guarded = [];

    static function todas_las_notas(){
        return Note::where('active', true)->get();
    }

    static function nota_por_id($id){
        return Note::where('id', $id)
            ->where('active', true)
            ->firstOrFail();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'note_categories');
    }

    public function category()
    {
        return $this->belongsTo(Category::class); 
    }
}
