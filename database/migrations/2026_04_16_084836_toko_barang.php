<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('nama_kategori');
            $table->text('deskripsi');
            $table->enum('status', ['aktif', 'nonaktif', 'draft'])->default('draft');
        });
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('kode_barang')->index();
            $table->longText('qr_code')->nullable();
            $table->foreignId('id_kategori')->nullable()->references('id_kategori')->on('kategori')->nullOnDelete()->cascadeOnUpdate();
            $table->string('nama_barang');
            $table->integer('harga');
            $table->integer('stok');
            $table->text('penyimpanan')->nullable();
            $table->json('specification')->nullable();
            $table->float('rating_avg')->nullable();
            $table->float('rating_count')->nullable();
            $table->enum('status', ['aktif', 'nonaktif', 'draft'])->default('draft');
            $table->timestamps();
        });
        Schema::create('gambar_barang', function (Blueprint $table) {
            $table->id('gambar_id');
            $table->foreignId('id_barang')->references('id_barang')->on('barang')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('gambar');
        });
        Schema::create('cart', function (Blueprint $table) {
            $table->id('id_cart');
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_barang')->references('id_barang')->on('barang')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('qty');
        });
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->string('kode_transaksi')->unique();
            $table->text('keterangan')->nullable();
            $table->decimal('total', 15);
            $table->string('status')->default('pending');
            $table->string('payment_type')->nullable();
            $table->string('snap_token')->nullable();
            $table->timestamps();
        });
        Schema::create('item_transaction', function (Blueprint $table) {
            $table->id('id_item_transaction');
            $table->foreignId('id_pembayaran')->references('id_pembayaran')->on('pembayaran')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_barang')->constrained('barang', 'id_barang')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('qty');
            $table->decimal('harga_satuan', 15);
            $table->timestamps();
        });
        Schema::create('rating', function (Blueprint $table) {
            $table->id('rating_id');
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_barang')->references('id_barang')->on('barang')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('rating');
            $table->text('keterangan');
            $table->timestamps();
        });
        Schema::create('favorite', function (Blueprint $table) {
            $table->id('favorite_id');
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_barang')->references('id_barang')->on('barang')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('barang');
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('item_transaction');
        Schema::dropIfExists('rating');
        Schema::dropIfExists('cart');
        Schema::dropIfExists('gambar_barang');
        Schema::dropIfExists('favorite');
    }
};
