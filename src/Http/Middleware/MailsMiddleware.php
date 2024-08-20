<?php

namespace Narsil\Framework\Http\Middleware;

#region USE

use Closure;
use Illuminate\Http\Request;
use Narsil\Mails\Constants\MailsSettings;
use Narsil\Mails\Models\Mailer;
use Narsil\Settings\Models\Setting;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
final class SessionConfig
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $this->handleMailer();

        return $next($request);
    }

    #endregion

    #region PRIVATE METHODS

    private function handleMailer(): void
    {
        $mailer = Setting::get(MailsSettings::MAILER);

        if (!$mailer)
        {
            return;
        }

        $mailer = Mailer::find($mailer);

        if (!$mailer)
        {
            return;
        }

        config([
            'mail.from.address' => $mailer->{Mailer::EMAIL},
            'mail.from.name' => $mailer->{Mailer::SENDER},
            'mail.mailers.smtp.encryption' => $mailer->{Mailer::ENCRYPTION},
            'mail.mailers.smtp.host' => $mailer->{Mailer::HOST},
            'mail.mailers.smtp.password' => $mailer->{Mailer::PASSWORD},
            'mail.mailers.smtp.port' => $mailer->{Mailer::PORT},
            'mail.mailers.smtp.username' => $mailer->{Mailer::USERNAME},
        ]);
    }

    #endregion
}
