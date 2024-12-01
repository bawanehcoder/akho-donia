<?php

namespace App\Models;

use App\Models\Traits\HasMediaTrait;
use App\Transformers\BrancheTransformer;
use Flugg\Responder\Contracts\Transformable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;


class Branche extends Model implements Transformable, HasMedia
{
    use HasFactory;
    use HasMediaTrait;

    public function setBlobAttribute(){
        $this->attributes['blob'] = '';
    }
    protected $fillable = [
        'id',
        'AddresAr',
        'AddresEn',
        'Phone',
        'Map',
        'blob',
    ];
    public function transformer()
    {
        return BrancheTransformer::class;
    }
    public function getTitle(){
        return  getLang()=='en'?$this->AddresAr: $this->AddresEn;
    }
}
