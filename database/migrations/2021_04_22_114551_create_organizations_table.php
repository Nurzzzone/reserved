<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\OrganizationContract;

class CreateOrganizationsTable extends Migration
{

    public function up()
    {
        Schema::create(OrganizationContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(OrganizationContract::USER_ID);
            $table->bigInteger(OrganizationContract::CATEGORY_ID);
            $table->string(OrganizationContract::IIKO_ORGANIZATION_ID)->nullable();
            $table->bigInteger(OrganizationContract::IIKO_ID)->nullable();
            $table->string(OrganizationContract::API_KEY)->nullable();
            $table->string(OrganizationContract::API_ID)->nullable();
            $table->string(OrganizationContract::API_SECRET)->nullable();
            $table->string(OrganizationContract::TITLE)->nullable();
            $table->string(OrganizationContract::TITLE_KZ)->nullable();
            $table->string(OrganizationContract::TITLE_EN)->nullable();
            $table->float(OrganizationContract::RATING)->nullable();
            $table->string(OrganizationContract::IMAGE)->nullable();
            $table->text(OrganizationContract::DESCRIPTION)->nullable();
            $table->text(OrganizationContract::DESCRIPTION_KZ)->nullable();
            $table->text(OrganizationContract::DESCRIPTION_EN)->nullable();
            $table->string(OrganizationContract::ADDRESS)->nullable();
            $table->string(OrganizationContract::ADDRESS_KZ)->nullable();
            $table->string(OrganizationContract::ADDRESS_EN)->nullable();
            $table->string(OrganizationContract::PRICE)->nullable();
            $table->string(OrganizationContract::EMAIL)->nullable();
            $table->string(OrganizationContract::PHONE)->nullable();
            $table->string(OrganizationContract::WEBSITE)->nullable();
            $table->integer(OrganizationContract::TABLES)->nullable();
            $table->time(OrganizationContract::START_MONDAY)->nullable()->default('00:00:00');
            $table->time(OrganizationContract::END_MONDAY)->nullable()->default('00:00:00');
            $table->time(OrganizationContract::START_TUESDAY)->nullable()->default('00:00:00');
            $table->time(OrganizationContract::END_TUESDAY)->nullable()->default('00:00:00');
            $table->time(OrganizationContract::START_WEDNESDAY)->nullable()->default('00:00:00');
            $table->time(OrganizationContract::END_WEDNESDAY)->nullable()->default('00:00:00');
            $table->time(OrganizationContract::START_THURSDAY)->nullable()->default('00:00:00');
            $table->time(OrganizationContract::END_THURSDAY)->nullable()->default('00:00:00');
            $table->time(OrganizationContract::START_FRIDAY)->nullable()->default('00:00:00');
            $table->time(OrganizationContract::END_FRIDAY)->nullable()->default('00:00:00');
            $table->time(OrganizationContract::START_SATURDAY)->nullable()->default('00:00:00');
            $table->time(OrganizationContract::END_SATURDAY)->nullable()->default('00:00:00');
            $table->time(OrganizationContract::START_SUNDAY)->nullable()->default('00:00:00');
            $table->time(OrganizationContract::END_SUNDAY)->nullable()->default('00:00:00');
            $table->enum(OrganizationContract::STATUS,OrganizationContract::STATUSES)
                ->default(OrganizationContract::ENABLED);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(OrganizationContract::TABLE);
    }
}
