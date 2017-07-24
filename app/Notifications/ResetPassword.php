<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as IlluminateResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends IlluminateResetPassword
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->salutation('Obrigado')
            ->line('Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.')
            ->action('Restaurar Senha', "http://yourclient.app/reset/{$this->token}")
            ->line('Se você não solicitou uma reinicialização da senha, nenhuma ação adicional é necessária.');
    }
}
