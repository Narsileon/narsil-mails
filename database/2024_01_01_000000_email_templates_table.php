<?php

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Narsil\Localization\Models\Language;
use Narsil\Mails\Models\EmailTemplate;;

#endregion

return new class extends Migration
{
    #region MIGRATIONS

    /**
     * @return void
     */
    public function up(): void
    {
        $this->createEmailTemplatesTable();
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(EmailTemplate::TABLE);
    }

    #endregion

    #region TABLES

    /**
     * @return void
     */
    private function createEmailTemplatesTable(): void
    {
        if (Schema::hasTable(EmailTemplate::TABLE))
        {
            return;
        }

        Schema::create(EmailTemplate::TABLE, function (Blueprint $table)
        {
            $table
                ->id(EmailTemplate::ID);
            $table
                ->boolean(EmailTemplate::ACTIVE)
                ->default(true);
            $table
                ->foreignId(EmailTemplate::LANGUAGE_ID)
                ->constrained(Language::TABLE, Language::ID)
                ->cascadeOnDelete();
            $table
                ->morphs(EmailTemplate::RELATIONSHIP_MODEL);
            $table
                ->string(EmailTemplate::ACTION)
                ->nullable();
            $table
                ->boolean(EmailTemplate::IS_EXTERNAL)
                ->default(false);
            $table
                ->text(EmailTemplate::SUBJECT);
            $table
                ->text(EmailTemplate::CONTENT);
            $table
                ->json(EmailTemplate::REPLY_TO)
                ->nullable();
            $table
                ->boolean(EmailTemplate::HAS_SIGNATURE)
                ->default(false);
            $table
                ->timestamps();
        });
    }

    #endregion
};
