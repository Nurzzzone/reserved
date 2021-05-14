<?php

namespace App\Models;

use App\Domain\Contracts\OrganizationTableListContract;
use App\Domain\Contracts\OrganizationTablesContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationTables extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable =   OrganizationTablesContract::FILLABLE;

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function getStatusAttribute($value)
    {
        return OrganizationTablesContract::TRANSLATE[$value];
    }

    public function organizationTables()
    {
        return $this->hasMany(OrganizationTableList::class,OrganizationTableListContract::ORGANIZATION_TABLE_ID,OrganizationTablesContract::ID)->where(OrganizationTableListContract::STATUS,OrganizationTableListContract::ENABLED);
    }
}
