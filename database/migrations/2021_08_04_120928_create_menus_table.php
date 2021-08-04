<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Domain\Contracts\MenuContract;

class CreateMenusTable extends Migration
{

    public function up()
    {
        Schema::create(MenuContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(MenuContract::ORGANIZATION_ID);
            $table->string(MenuContract::IMAGE)->nullable();
            $table->enum(MenuContract::STATUS,[
                MenuContract::ON,
                MenuContract::OFF
            ])->default(MenuContract::ON);
            $table->timestamps();
            $table->index(MenuContract::ORGANIZATION_ID);
        });
    }

    public function down()
    {
        Schema::dropIfExists(MenuContract::TABLE);
    }

}
