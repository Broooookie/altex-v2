<?php

namespace App;

use App\Traits\FileUpload;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Coin extends Model
{
    use UsesUuid, FileUpload;
    //

    protected $fillable = [
        'coin_name', 'logo'
    ];

    public function setImageAttribute($value)
    {
        if ($value != null && $value != '') {
            $fileFolder =  "tourist-spots/" . $this->id;
            $imageUrl = $this->imageUploadForBase64($value, 'image', $fileFolder);
            $this->attributes['image'] = $imageUrl;
        }
    }

    /**
     * Model Mutators and Accessors
     */
    public function setBannerAttribute($value)
    {
        if ($value != null && $value != '') {
            $fileFolder =  "tourist-spots/" . $this->id;
            $imageUrl = $this->imageUploadForBase64($value, 'banner', $fileFolder);
            $this->attributes['banner'] = $imageUrl;
        }
    }

    public function getImageUrlAttribute($value)
    {
        if($this->image != null && $this->image != '') {
            return URL::to('/') . '/' . $this->image;
        }
    }

    public function getBannerUrlAttribute($value)
    {
        if($this->banner != null && $this->banner != '') {
            return URL::to('/') . '/' . $this->banner;
        }
    }

    public function clientWallets()
    {
        return $this->hasMany(ClientWallet::class);
    }

    public function clientWallet()
    {
        return $this->belongsTo(ClientWallet::class);
    }

    public function coinChartData()
    {
        return $this->belongsTo(CoinChartData::class);
    }
}
