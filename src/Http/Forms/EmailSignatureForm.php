<?php

namespace Narsil\Mails\Http\Forms;

#region USE

use Narsil\Forms\Builder\AbstractForm;
use Narsil\Forms\Builder\AbstractFormNode;
use Narsil\Forms\Builder\Elements\FormCard;
use Narsil\Forms\Builder\Inputs\FormOptions;
use Narsil\Forms\Builder\Inputs\FormSelect;
use Narsil\Forms\Builder\Inputs\FormString;
use Narsil\Localization\Models\Language;
use Narsil\Mails\Models\EmailSignature;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
class EmailSignatureForm extends AbstractForm
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(
            slug: 'email-signature',
            title: 'Email signature',
        );
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            EmailSignature::LANGUAGE_ID => (new FormOptions())
                ->options(Language::options()->get()->toArray())
                ->get(),
        ];
    }

    /**
     * @return array<AbstractFormNode>
     */
    protected function getSchema(): array
    {
        return [
            (new FormCard('default'))
                ->children([
                    (new FormSelect(EmailSignature::LANGUAGE_ID))
                        ->valueKey(Language::ID),
                    (new FormString(EmailSignature::CONTENT))
                        ->nodeType('editor'),
                ]),
        ];
    }

    #endregion
}
