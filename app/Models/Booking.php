<?php

namespace App\Models;

use App\Domain\Contracts\OrganizationContract;
use App\Domain\Contracts\OrganizationTableListContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Contracts\BookingContract;

use App\Events\BookingNotification;

class Booking extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable =   BookingContract::FILLABLE;


    public function getTimeAttribute($value) {
        $date   =   explode(' ',$this->created_at);
        $time   =   new \DateTime($date[0].' '.$value, new \DateTimeZone(BookingContract::UTC));
        $time->setTimezone(new \DateTimeZone($this->organization->timezone));
        return $time->format('H:i');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function organization() {
        return $this->belongsTo(Organization::class,BookingContract::ORGANIZATION_ID,OrganizationContract::ID);
    }

    public function organizationTables() {
        return $this->hasOne(OrganizationTableList::class,OrganizationTableListContract::ID,BookingContract::ORGANIZATION_TABLE_LIST_ID);
    }

}
