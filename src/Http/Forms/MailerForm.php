<?php

namespace Narsil\Mails\Http\Forms;

#region USE

use Narsil\Forms\Builder\AbstractForm;
use Narsil\Forms\Builder\AbstractFormNode;
use Narsil\Forms\Builder\Elements\FormCard;
use Narsil\Forms\Builder\Inputs\FormSelect;
use Narsil\Forms\Builder\Inputs\FormString;
use Narsil\Mails\Enums\EncryptionEnum;
use Narsil\Mails\Models\Mailer;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
class MailerForm extends AbstractForm
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(
            slug: 'mailer',
            title: 'Mailer',
        );
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @return array<AbstractFormNode>
     */
    protected function getSchema(): array
    {
        return [
            (new FormCard('default'))
                ->children([
                    (new FormString(Mailer::HOST)),
                    (new FormString(Mailer::PORT))
                        ->type('number'),
                    (new FormSelect(Mailer::ENCRYPTION))
                        ->options(array_map(fn($case) => $case->value, EncryptionEnum::cases())),
                    (new FormString(Mailer::EMAIL))
                        ->type('email'),
                    (new FormString(Mailer::USERNAME)),
                    (new FormString(Mailer::PASSWORD))
                        ->type('password'),
                    (new FormString(Mailer::SENDER))
                        ->type('email'),
                ]),
        ];
    }

    #endregion
}
