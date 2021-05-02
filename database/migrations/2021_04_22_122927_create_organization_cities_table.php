<?php

use App\Domain\Contracts\OrganizationCityContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationCitiesTable extends Migration
{

    public function up()
    {
        Schema::create(OrganizationCityContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(OrganizationCityContract::ORGANIZATION_ID);
            $table->bigInteger(OrganizationCityContract::CITY_ID);
            $table->enum(OrganizationCityContract::STATUS,OrganizationCityContract::STATUSES)
                ->default(OrganizationCityContract::ENABLED);
            $table->timestamps();
            $table->index(OrganizationCityContract::ORGANIZATION_ID);
            $table->index(OrganizationCityContract::CITY_ID);
        });
    }

    public function down()
    {
        Schema::dropIfExists(OrganizationCityContract::TABLE);
    }
}
