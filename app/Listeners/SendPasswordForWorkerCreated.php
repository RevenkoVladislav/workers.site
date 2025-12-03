<?php

namespace App\Listeners;

use App\Events\WorkerCreated;
use App\Mail\User\PasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordForWorkerCreated
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WorkerCreated $event): void
    {
        if(!$event->createdByManager) {
            return; //Если пользователь регистрировался сам, то письмо с паролем не отсылаем.
        }

        Mail::to($event->user->email)->send(new PasswordMail($event->password, $event->user->name));
    }
}
