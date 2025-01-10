<?php

use App\Models\Customer;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class);
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('total');
            $table->timestamp('ngaydathang');
            $table->string('giaohang')->default(App\Models\Order::TYPE_0);
            $table->string('thanhtoan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
