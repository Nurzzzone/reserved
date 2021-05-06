<?php

namespace App\Models;

use App\Domain\Contracts\OrganizationContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function images()
    {
        return $this->hasMany(OrganizationImage::class);
    }

    public function organizationCity()
    {
        return $this->hasOne(OrganizationCity::class);
    }

    public function getStatusAttribute($value)
    {
        return OrganizationContract::TRANSLATE[$value];
    }

    public function getMondayAttribute($value)
    {
        if ($this->attributes[OrganizationContract::START_MONDAY] === $this->attributes[OrganizationContract::END_MONDAY]) {
            return OrganizationContract::TRANSLATE['ALL_DAY'];
        }
        return 'с '.$this->attributes[OrganizationContract::START_MONDAY].' до'.$this->attributes[OrganizationContract::END_MONDAY];
    }

    public function getTuesdayAttribute($value)
    {
        if ($this->attributes[OrganizationContract::START_TUESDAY] === $this->attributes[OrganizationContract::END_TUESDAY]) {
            return OrganizationContract::TRANSLATE['ALL_DAY'];
        }
        return 'с '.$this->attributes[OrganizationContract::START_TUESDAY].' до'.$this->attributes[OrganizationContract::START_TUESDAY];
    }

    public function getWednesdayAttribute($value)
    {
        if ($this->attributes[OrganizationContract::START_WEDNESDAY] === $this->attributes[OrganizationContract::END_WEDNESDAY]) {
            return OrganizationContract::TRANSLATE['ALL_DAY'];
        }
        return 'с '.$this->attributes[OrganizationContract::START_WEDNESDAY].' до'.$this->attributes[OrganizationContract::START_WEDNESDAY];
    }

    public function getThursdayAttribute($value)
    {
        if ($this->attributes[OrganizationContract::START_THURSDAY] === $this->attributes[OrganizationContract::END_THURSDAY]) {
            return OrganizationContract::TRANSLATE['ALL_DAY'];
        }
        return 'с '.$this->attributes[OrganizationContract::START_THURSDAY].' до'.$this->attributes[OrganizationContract::END_THURSDAY];
    }

    public function getFridayAttribute($value)
    {
        if ($this->attributes[OrganizationContract::START_FRIDAY] === $this->attributes[OrganizationContract::END_FRIDAY]) {
            return OrganizationContract::TRANSLATE['ALL_DAY'];
        }
        return 'с '.$this->attributes[OrganizationContract::START_FRIDAY].' до'.$this->attributes[OrganizationContract::END_FRIDAY];
    }

    public function getSaturdayAttribute($value)
    {
        if ($this->attributes[OrganizationContract::START_SATURDAY] === $this->attributes[OrganizationContract::END_SATURDAY]) {
            return OrganizationContract::TRANSLATE['ALL_DAY'];
        }
        return 'с '.$this->attributes[OrganizationContract::START_SATURDAY].' до'.$this->attributes[OrganizationContract::END_SATURDAY];
    }

    public function getSundayAttribute($value)
    {
        if ($this->attributes[OrganizationContract::START_SUNDAY] === $this->attributes[OrganizationContract::END_SUNDAY]) {
            return OrganizationContract::TRANSLATE['ALL_DAY'];
        }
        return 'с '.$this->attributes[OrganizationContract::START_SUNDAY].' до'.$this->attributes[OrganizationContract::END_SUNDAY];
    }
}
