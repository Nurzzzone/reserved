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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function organization() {
        return $this->belongsTo(Organization::class);
    }

    public function organizationTables() {
        return $this->hasOne(OrganizationTableList::class,OrganizationTableListContract::ID,BookingContract::ORGANIZATION_TABLE_ID);
    }

    public function price() {

    }

}
