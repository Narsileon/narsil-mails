<?php

namespace Narsil\Mails\Policies;

#region USE

use Narsil\Mails\Models\EmailTemplate;
use Narsil\Policies\Policies\AbstractPolicy;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
final class EmailTemplatePolicy extends AbstractPolicy
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(EmailTemplate::class);
    }

    #endregion
}
