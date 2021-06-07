<?php

namespace App\Models;

use App\Domain\Contracts\OrganizationCityContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationCity extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable =   OrganizationCityContract::FILLABLE;

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getStatusAttribute($value)
    {
        return OrganizationCityContract::TRANSLATE[$value];
    }
}
