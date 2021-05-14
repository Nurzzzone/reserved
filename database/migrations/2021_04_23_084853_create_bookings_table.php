<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\BookingContract;

class CreateBookingsTable extends Migration
{

    public function up()
    {
        Schema::create(BookingContract::TABLE, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(BookingContract::USER_ID)->nullable();
            $table->bigInteger(BookingContract::ORGANIZATION_ID)->nullable();
            $table->bigInteger( BookingContract::ORGANIZATION_TABLE_ID)->nullable();
            $table->time(BookingContract::START)->nullable();
            $table->time(BookingContract::END)->nullable();
            $table->date(BookingContract::DATE)->useCurrent();
            $table->string(BookingContract::PHONE)->nullable();
            $table->text(BookingContract::COMMENT)->nullable();
            $table->enum(BookingContract::STATUS,BookingContract::STATUSES_BOOKING)
                ->default(BookingContract::CHECKING);
            $table->timestamps();
            $table->index(BookingContract::USER_ID);
            $table->index(BookingContract::ORGANIZATION_ID);
            $table->index(BookingContract::PHONE);
            $table->index(BookingContract::ORGANIZATION_TABLE_ID);
        });
    }

    public function down()
    {
        Schema::dropIfExists(BookingContract::TABLE);
    }
}
