<?php

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Localization\Models\Language;
use Narsil\Mails\Models\EmailSignature;

#endregion

return new class extends Migration
{
    #region MIGRATIONS

    /**
     * @return void
     */
    public function up(): void
    {
        $this->createEmailSignaturesTable();
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(EmailSignature::TABLE);
    }

    #endregion

    #region TABLES

    /**
     * @return void
     */
    private function createEmailSignaturesTable(): void
    {
        if (Schema::hasTable(EmailSignature::TABLE))
        {
            return;
        }

        Schema::create(EmailSignature::TABLE, function (Blueprint $table)
        {
            $table
                ->id(EmailSignature::ID);
            $table
                ->boolean(EmailSignature::ACTIVE)
                ->default(true);
            $table
                ->foreignId(EmailSignature::LANGUAGE_ID)
                ->constrained(Language::TABLE, Language::ID)
                ->cascadeOnDelete();
            $table
                ->text(EmailSignature::CONTENT)
                ->nullable();
            $table
                ->timestamps();
        });
    }

    #endregion
};
