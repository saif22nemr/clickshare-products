<?php

use App\Models\User;
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
        User::updateOrCreate(['email' => 'admin@app.test'],[
            'first_name' => 'Admin',
            'last_name' => 'Account',
            'email' => 'admin@app.test',
            'password' => '$2y$12$W3F.fiBd07RNVPyCdR7olemnwg7cLq6X3bwsHLQLh8pwP4I6imgfi', // password
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
