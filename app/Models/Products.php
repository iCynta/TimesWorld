<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'description',
        'image',
        'color_id',
        'size_id',
    ];
   
    public function size():BelongsTo {
        return $this->belongsTo(Sizes::class);
    }
    
    public function color():BelongsTo {
        return $this->belongsTo(Colors::class);
    }
}
