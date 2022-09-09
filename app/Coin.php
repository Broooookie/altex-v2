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
        'name', 'image'
    ];

    public function getImageAttribute($value) {
        return URL::to('/') . $value;
    }

      /**
     * Upload Banner Image
     */
    public function setImageAttribute($value) {
        if($value != null && $value != '') {
            $product_name = strtolower($this->name);
            $product_name = preg_replace('/[^A-Za-z0-9. -]/', '', $product_name);
            $trimmed_product_name = str_replace(' ', '', $product_name) . '-' . time();
            $image_name = $trimmed_product_name.'-image-'.time();

            $fileFolder =  'coins/' . $trimmed_product_name;

            $image_url = $this->imageUploadForBase64($value, $trimmed_product_name, $fileFolder);

            $this->attributes['image'] = $image_url;



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
