<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class FlowerImage extends Model
{
    protected $fillable = ['flower_id', 'image_path'];
    public function flower(): BelongsTo
    {
        return $this->belongsTo(Flower::class);
    }
}