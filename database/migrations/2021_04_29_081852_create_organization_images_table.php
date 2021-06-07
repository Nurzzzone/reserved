<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\OrganizationImageContract;

class CreateOrganizationImagesTable extends Migration
{

    public function up()
    {
        Schema::create(OrganizationImageContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(OrganizationImageContract::ORGANIZATION_ID);
            $table->string(OrganizationImageContract::IMAGE)->nullable();
            $table->enum(OrganizationImageContract::STATUS,OrganizationImageContract::STATUSES)->default(OrganizationImageContract::ENABLED);
            $table->integer(OrganizationImageContract::PARENT_ID)->default(0)->nullable();
            $table->integer(OrganizationImageContract::LFT)->default(0);
            $table->integer(OrganizationImageContract::RGT)->default(0);
            $table->integer(OrganizationImageContract::DEPTH)->default(0);
            $table->timestamps();
            $table->index(OrganizationImageContract::ORGANIZATION_ID);
            $table->index(OrganizationImageContract::PARENT_ID);
        });
    }

    public function down()
    {
        Schema::dropIfExists(OrganizationImageContract::TABLE);
    }
}
