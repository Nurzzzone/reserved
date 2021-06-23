<?php

namespace App\Models;

use App\Domain\Contracts\OrganizationImageContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class OrganizationImage extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable =   OrganizationImageContract::FILLABLE;

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function getStatusAttribute($value)
    {
        return OrganizationImageContract::TRANSLATE[$value];
    }

    public function setImageAttribute($value)
    {
        $disk               =   config('backpack.base.root_disk_name');
        $destination_path   =   'public/uploads';
        if (is_null($value)) {
            Storage::disk($disk)->delete($this->{OrganizationImageContract::IMAGE});
            $this->attributes[OrganizationImageContract::IMAGE] = null;
        }
        if (Str::startsWith($value, 'data:image'))
        {
            $image = Image::make($value)->encode('jpg', 90);
            $filename = md5($value.time()).'.jpg';
            Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            Storage::disk($disk)->delete($this->{OrganizationImageContract::IMAGE});
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[OrganizationImageContract::IMAGE] = '/'.$public_destination_path.'/'.$filename;
        }
    }
}
