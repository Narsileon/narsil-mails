<?php

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Mails\Models\Mailer;

#endregion

return new class extends Migration
{
    #region MIGRATIONS

    /**
     * @return void
     */
    public function up(): void
    {
        $this->createMailersTable();
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(Mailer::TABLE);
    }

    #endregion

    #region TABLES

    /**
     * @return void
     */
    private function createMailersTable(): void
    {
        if (Schema::hasTable(Mailer::TABLE))
        {
            return;
        }

        Schema::create(Mailer::TABLE, function (Blueprint $table)
        {
            $table
                ->id(Mailer::ID);
            $table
                ->boolean(Mailer::ACTIVE)
                ->default(true);
            $table
                ->string(Mailer::HOST);
            $table
                ->smallInteger(Mailer::PORT);
            $table
                ->option(Mailer::ENCRYPTION);
            $table
                ->string(Mailer::EMAIL);
            $table
                ->string(Mailer::USERNAME);
            $table
                ->string(Mailer::PASSWORD);
            $table
                ->string(Mailer::SENDER);
            $table
                ->timestamps();
        });
    }

    #endregion
};
