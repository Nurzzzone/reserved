<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\OrganizationTablesContract;

class CreateOrganizationTablesTable extends Migration
{

    public function up()
    {
        Schema::create(OrganizationTablesContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(OrganizationTablesContract::ORGANIZATION_ID);
            $table->unsignedTinyInteger(OrganizationTablesContract::TITLE);
            $table->unsignedTinyInteger(OrganizationTablesContract::LIMIT);
            $table->integer(OrganizationTablesContract::PARENT_ID)->default(0)->nullable();
            $table->integer(OrganizationTablesContract::LFT)->default(0);
            $table->integer(OrganizationTablesContract::RGT)->default(0);
            $table->integer(OrganizationTablesContract::DEPTH)->default(0);
            $table->enum(OrganizationTablesContract::STATUS,OrganizationTablesContract::STATUSES)->default(OrganizationTablesContract::ENABLED);
            $table->timestamps();
            $table->index(OrganizationTablesContract::ORGANIZATION_ID);
            $table->index(OrganizationTablesContract::PARENT_ID);
        });
    }

    public function down()
    {
        Schema::dropIfExists(OrganizationTablesContract::TABLE);
    }
}
