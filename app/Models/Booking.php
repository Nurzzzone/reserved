<?php

namespace App\Models;

use App\Domain\Contracts\OrganizationTableListContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Contracts\BookingContract;

class Booking extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    protected $fillable =   BookingContract::FILLABLE;

    public function getStatusAttribute($value) {
        return BookingContract::TRANSLATE[$value];
    }

    public function getStartAttribute($value) {
        $start  =   new \DateTime($this->date.' '.$value, new \DateTimeZone(BookingContract::UTC));
        $start->setTimezone(new \DateTimeZone($this->organization->timezone));
//        echo $start->format('H:i');
//        die();
        return $start->format('H:i');
    }

    public function getEndAttribute($value) {
        $start  =   new \DateTime($this->date.' '.$value, new \DateTimeZone(BookingContract::UTC));
        $start->setTimezone(new \DateTimeZone($this->organization->timezone));
        return $start->format('H:i');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    public function organizationTables() {
        return $this->hasOne(OrganizationTableList::class,OrganizationTableListContract::ID,BookingContract::ORGANIZATION_TABLE_LIST_ID);
    }

    public function price() {

    }

}
