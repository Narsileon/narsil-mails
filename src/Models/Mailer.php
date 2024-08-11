<?php

namespace Narsil\Mails\Models;

#region USE

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Narsil\Mails\Enums\EncryptionEnum;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
class Mailer extends Model
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
            self::ENCRYPTION => EncryptionEnum::class,
        ];

        $this->guarded = [
            self::ID,
        ];

        $this->hidden = [
            self::PASSWORD,
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
    final public const EMAIL = "email";
    /**
     * @var string
     */
    final public const ENCRYPTION = "encryption";
    /**
     * @var string
     */
    final public const HOST = "host";
    /**
     * @var string
     */
    final public const ID = "id";
    /**
     * @var string
     */
    final public const PASSWORD = "password";
    /**
     * @var string
     */
    final public const PORT = "port";
    /**
     * @var string
     */
    final public const SENDER = "sender";
    /**
     * @var string
     */
    final public const USERNAME = "username";

    /**
     * @var string
     */
    final public const TABLE = "mailers";

    #endregion

    #region SCOPES

    /**
     * @param Builder $query
     *
     * @return void
     */
    final public function scopeOptions(Builder $query): void
    {
        $query
            ->select([
                self::ID,
                self::EMAIL,
            ])
            ->where(self::ACTIVE, true);
    }

    #endregion
}
