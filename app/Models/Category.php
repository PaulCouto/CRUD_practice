<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'Category_name', 'notes_id', 'active'
    ];

    // protected $guarded = [];

    static function todas_las_categorias(){
        return Category::where('active', true)->get();
    }

    static function categoria_por_id($id){
        return Category::where('id', $id)
            ->where('active', true)
            ->firstOrFail();
    }
    
    public function notes()
    {
        return $this->belongsToMany(Note::class, 'note_categories');
    }
}
