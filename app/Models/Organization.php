<?php

namespace App\Models;

use App\Domain\Contracts\OrganizationContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Organization extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    protected $fillable =   OrganizationContract::FILLABLE;

    private $start_monday;
    private $end_monday;
    private $start_tuesday;
    private $end_tuesday;
    private $start_wednesday;
    private $end_wednesday;
    private $start_thursday;
    private $end_thursday;
    private $start_friday;
    private $end_friday;
    private $start_saturday;
    private $end_saturday;
    private $start_sunday;
    private $end_sunday;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setStartMondayAttribute($value): string
    {
        return $value.':00';
    }
    public function setEndMondayAttribute($value): string
    {
        return $value.':00';
    }

    public function setStartTuesdayAttribute($value): string
    {
        return $value.':00';
    }
    public function setEndTuesdayAttribute($value): string
    {
        return $value.':00';
    }

    public function setStartWednesdayAttribute($value): string
    {
        return $value.':00';
    }
    public function setEndWednesdayAttribute($value): string
    {
        return $value.':00';
    }

    public function setStartThursdayAttribute($value): string
    {
        return $value.':00';
    }
    public function setEndThursdayAttribute($value): string
    {
        return $value.':00';
    }

    public function setStartFridayAttribute($value): string
    {
        return $value.':00';
    }
    public function setEndFridayAttribute($value): string
    {
        return $value.':00';
    }

    public function setStartSaturdayAttribute($value): string
    {
        return $value.':00';
    }
    public function setEndSaturdayAttribute($value): string
    {
        return $value.':00';
    }

    public function setStartSundayAttribute($value): string
    {
        return $value.':00';
    }
    public function setEndSundayAttribute($value): string
    {
        return $value.':00';
    }

    public function getStartMondayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function getEndMondayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function getStartTuesdayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function getEndTuesdayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function getStartWednesdayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function getEndWednesdayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function getStartThursdayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function getEndThursdayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function getStartFridayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function getEndFridayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function getStartSaturdayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function getEndSaturdayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function getStartSundayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function getEndSundayAttribute($value): string
    {
        $split  =   explode(':',$value);
        return $split[0].':'.$split[1];
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function images() {
        return $this->hasMany(OrganizationImage::class);
    }

    public function menus() {
        return $this->hasMany(Menu::class);
    }

    public function getImageAttribute() {
        return $this->attributes[OrganizationContract::IMAGE]?$this->attributes[OrganizationContract::IMAGE]:($this->attributes[OrganizationContract::CATEGORY_ID]===1?'/img/logo/restaurant.svg':($this->attributes[OrganizationContract::CATEGORY_ID]===2?'/img/logo/cafe.svg':'/img/logo/bar.svg'));
    }

    public function setImageAttribute($value) {

        $disk               =   config('backpack.base.root_disk_name');
        $destination_path   =   'public/uploads';

        if ($value  ==  null) {

            Storage::disk($disk)->delete($this->{OrganizationContract::IMAGE});
            $this->attributes[OrganizationContract::IMAGE] = null;

        }

        if (Str::startsWith($value, 'data:image')) {

            $image      =   Image::make($value)->encode('jpg', 90);
            $filename   =   md5($value.time()).'.jpg';
            Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            Storage::disk($disk)->delete($this->{OrganizationContract::IMAGE});
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[OrganizationContract::IMAGE] = '/'.$public_destination_path.'/'.$filename;

        }
    }

    public function setWallpaperAttribute($value) {

        $disk               =   config('backpack.base.root_disk_name');
        $destination_path   =   'public/uploads/wallpaper';

        if ($value  ==  null) {

            Storage::disk($disk)->delete($this->{OrganizationContract::WALLPAPER});
            $this->attributes[OrganizationContract::WALLPAPER] = null;

        }

        if (Str::startsWith($value, 'data:image')) {

            $image      =   Image::make($value)->encode('jpg', 90);
            $filename   =   md5($value.time()).'.jpg';
            Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            Storage::disk($disk)->delete($this->{OrganizationContract::WALLPAPER});
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[OrganizationContract::WALLPAPER] = '/'.$public_destination_path.'/'.$filename;

        }
    }

}
