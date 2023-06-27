<?php

use App\Models\OrderStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts');
            $table->string('session_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->string('email');
            $table->string('country')->default('bg');
            $table->string('address');
            $table->string('city');
            $table->string('zip_code');
            $table->string('phone_number');
            $table->text('comment')->nullable();
            $table->enum('payment_type', ['cod'])->default('cod');
            $table->integer('quantity');
            $table->decimal('sum_price');
            $table->smallInteger('status')->unsigned()->default(OrderStatus::PENDING_STATUS);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
