<?php

namespace App\Providers;

use App\Products;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\VendorProductComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        
 view()->composer(['layouts.site.header'], VendorProductComposer::class);
        
        \Illuminate\Auth\Notifications\VerifyEmail::toMailUsing(function ($notifiable) {

            // this is what is currently being done
            // adjust for your needs
    
            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject(\Lang::get('So nah - noch ein Schritt zur Registrierung bei der Last Mile Community'))
                ->line(\Lang::get('Sie sind fast am Ziel, klicken Sie auf den folgenden Link, um Ihre E-Mail zu verifizieren und der Community teilzunehmen:'))
                ->action(
                    \Lang::get('Verify'),
                    $this->verificationUrl($notifiable)
                )
                ->line(\Lang::get('Vielen Dank - mit freundlichen Grüßen,'))
                ->line(\Lang::get('Die Last Mile Community'));    
        });
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(\Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
