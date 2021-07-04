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
            $table->string(BookingContract::IIKO_BOOKING_ID)->nullable();

            $table->bigInteger(BookingContract::USER_ID)->nullable();
            $table->bigInteger(BookingContract::ORGANIZATION_ID)->nullable();
            $table->bigInteger( BookingContract::ORGANIZATION_TABLE_LIST_ID)->nullable();
            $table->time(BookingContract::TIME)->useCurrent();
            $table->date(BookingContract::DATE)->useCurrent();
            $table->enum(BookingContract::STATUS,BookingContract::STATUSES_BOOKING)
                ->default(BookingContract::CHECKING);
            $table->enum(BookingContract::COMMENT,[
                BookingContract::ON,
                BookingContract::OFF
            ])->default(BookingContract::ON);
            $table->string(BookingContract::PAYMENT_URL)->nullable();
            $table->bigInteger(BookingContract::PAYMENT_ID)->nullable();
            $table->string(BookingContract::PRICE)->nullable();
            $table->smallInteger(BookingContract::CURRENCY)->default(1);
            $table->bigInteger(BookingContract::CARD_ID)->nullable();

            $table->timestamps();

            $table->index(BookingContract::USER_ID);
            $table->index(BookingContract::ORGANIZATION_ID);
            $table->index(BookingContract::ORGANIZATION_TABLE_LIST_ID);
            $table->index(BookingContract::CARD_ID);
        });
    }

    public function down()
    {
        Schema::dropIfExists(BookingContract::TABLE);
    }
}
