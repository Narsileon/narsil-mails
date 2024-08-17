<?php

namespace Narsil\Mails\Models;

#region USE

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Narsil\Localization\Models\Language;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
class EmailTemplate extends Model
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

        $this->casts = [
            self::ACTIVE => 'boolean',
        ];

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
    final public const ACTION = 'action';
    /**
     * @var string
     */
    final public const ACTIVE = 'active';
    /**
     * @var string
     */
    final public const CONTENT = 'content';
    /**
     * @var string
     */
    final public const HAS_SIGNATURE = 'has_signature';
    /**
     * @var string
     */
    final public const ID = 'id';
    /**
     * @var string
     */
    final public const IS_EXTERNAL = 'is_external';
    /**
     * @var string
     */
    final public const LANGUAGE_ID = 'language_id';
    /**
     * @var string
     */
    final public const MODEL_ID = 'model_id';
    /**
     * @var string
     */
    final public const MODEL_TYPE = 'model_type';
    /**
     * @var string
     */
    final public const REPLY_TO = 'reply_to';
    /**
     * @var string
     */
    final public const SUBJECT = 'subject';

    /**
     * @var string
     */
    final public const RELATIONSHIP_MODEL = 'model';
    /**
     * @var string
     */
    final public const RELATIONSHIP_LANGUAGE = 'language';

    /**
     * @var string
     */
    final public const TABLE = 'email_templates';

    #endregion

    #region RELATIONSHIPS

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

    /**
     * @return MorphTo
     */
    public function model()
    {
        return $this->morphTo(
            self::RELATIONSHIP_MODEL,
            self::MODEL_TYPE,
            self::MODEL_ID
        );
    }

    #endregion
}
