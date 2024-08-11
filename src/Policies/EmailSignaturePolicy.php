<?php

namespace Narsil\Mails\Policies;

#region USE

use Narsil\Mails\Models\EmailSignature;
use Narsil\Policies\Policies\AbstractPolicy;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
final class EmailSignaturePolicy extends AbstractPolicy
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(EmailSignature::class);
    }

    #endregion
}
