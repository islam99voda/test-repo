<?php

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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number', 50);//رقم الفاتورة
            $table->date('invoice_Date')->nullable();//تاريخ الفاتورة
            $table->date('Due_date')->nullable();//تاريخ الإستحقاق
            $table->string('product', 50);
            $table->bigInteger( 'section_id' )->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->decimal('Amount_collection',8,2)->nullable();;
            $table->decimal('Amount_Commission',8,2);
            $table->decimal('Discount',8,2); //خصم في الفاتورة
            $table->decimal('Value_VAT',8,2);//قيمة الضريبة
            $table->string('Rate_VAT', 999);//نسبة الضريبة
            $table->decimal('Total',8,2);//29,550.30 الإجمالي ويتكتب بالفورم ديه 
            $table->string('Status', 50);//فاتورة مدفوعة,ولا غير مدفوعة,ولا مدفوعة جزئياً
            $table->integer('Value_Status'); // الفواتير المدفوعة مثلاً واحد والغير مدفوعة اتنين 
            $table->text('note')->nullable();
            $table->date('Payment_Date')->nullable();
            $table->softDeletes();//عشان لو عايز اعمل ارشيف للفواتير القديمة
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
        Schema::dropIfExists('invoices');
    }
};
