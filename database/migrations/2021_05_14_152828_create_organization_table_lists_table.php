<?php

use App\Domain\Contracts\OrganizationTableListContract;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationTableListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(OrganizationTableListContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(OrganizationTableListContract::ORGANIZATION_ID);
            $table->bigInteger(OrganizationTableListContract::ORGANIZATION_TABLE_ID);
            $table->string(OrganizationTableListContract::KEY)->nullable();
            $table->string(OrganizationTableListContract::TITLE)->nullable();
            $table->integer(OrganizationTableListContract::LIMIT)->default(2);
            $table->enum(OrganizationTableListContract::STATUS,OrganizationTableListContract::STATUSES)->default(OrganizationTableListContract::ENABLED);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(OrganizationTableListContract::TABLE);
    }
}
