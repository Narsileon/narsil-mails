<?php

namespace Narsil\Mails\Models;

#region USE

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Narsil\Localization\Models\Language;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
class EmailSignature extends Model
{
    #region CONSTRUCTOR

    /**
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->table = self::TABLE;

        $this->guarded = [
            self::ID,
        ];

        $this->with = [
            self::RELATIONSHIP_LANGUAGE
        ];

        parent::__construct($attributes);
    }

    #endregion

    #region CONSTANTS

    /**
     * @var string
     */
    final public const ACTIVE = "active";
    /**
     * @var string
     */
    final public const CONTENT = "content";
    /**
     * @var string
     */
    final public const ID = "id";
    /**
     * @var string
     */
    final public const LANGUAGE_ID = "language_id";

    /**
     * @var string
     */
    final public const RELATIONSHIP_LANGUAGE = "language";

    /**
     * @var string
     */
    final public const TABLE = "email_signatures";

    #endregion

    #region RELATIONSHIP

    /**
     * @return BelongsTo
     */
    final public function language(): BelongsTo
    {
        return $this->belongsTo(
            Language::class,
            self::LANGUAGE_ID,
            Language::ID
        );
    }

    #endregion
}
