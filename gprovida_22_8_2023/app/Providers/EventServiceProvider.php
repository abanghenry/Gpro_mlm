<?php

namespace App\Providers;

use App\Events\OrderConfirmed;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogSuccessfulLogout;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\UserActivated;
use App\Events\UserUpgraded;
use App\Events\ProductOrdered;
use App\Events\OrderShipped;
use App\Events\PinRequested;
use App\Events\PinTransferred;
use App\Events\PVEarned;
use App\Events\WalletRequested;
use App\Events\PayoutSent;
use App\Events\SupportTicketCreated;
use App\Events\SupportTicketUpdated;
use App\Events\TestimonialCreated;
use App\Events\EmailBroadcast;

use App\Listeners\SendUserActivationNotification;
use App\Listeners\SendSponsorActivationNotification;
use App\Listeners\GenealogyAddRegistrationBonus;
use App\Listeners\SendUserUpgradeNotification;
use App\Listeners\GenealogyAddUpgradeBonus;
use App\Listeners\SendOrderNotification;
use App\Listeners\GenealogyAddProductBonus;
use App\Listeners\SendShipmentNotification;
use App\Listeners\SendPinRequestedNotification;
use App\Listeners\SendPinTransferredNotification;
use App\Listeners\SendPVEarnedNotification;
use App\Listeners\SendWalletRequestNotification;
use App\Listeners\SendPayoutNotification;
use App\Listeners\SendSupportCreatedNotification;
use App\Listeners\SendSupportUpdatedNotification;
use App\Listeners\SendTestimonialNotification;
use App\Listeners\SendEmailBroadcast;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            // TODO Payment verification wall for bank transfer
        ],
        Login::class => [
            LogSuccessfulLogin::class,
        ],
        Logout::class => [
             LogSuccessfulLogout::class,
         ],
        UserActivated::class => [
            GenealogyAddRegistrationBonus::class,
            SendUserActivationNotification::class,  // activation link if not active plus link to select product
            SendSponsorActivationNotification::class,
        ],
        UserUpgraded::class => [
            SendUserUpgradeNotification::class,
            GenealogyAddUpgradeBonus::class,
        ],
        ProductOrdered::class => [  // after payment has been confirmed  --used
            SendOrderNotification::class,
        ],
        OrderConfirmed::class => [
            GenealogyAddProductBonus::class,
        ],
        OrderShipped::class => [
            SendShipmentNotification::class,
        ],
        PinRequested::class => [
            SendPinRequestedNotification::class,  // user and admin(system & can receive system email)
        ],
        PinTransferred::class => [
            SendPinTransferredNotification::class,  // user and admin(system & can receive system email)
        ],
        PVEarned::class => [
            SendPVEarnedNotification::class,  // user and admin(system & can receive system email)
        ],
        WalletRequested::class => [
            SendWalletRequestNotification::class,  // user and admin(system & can receive system email)
        ],
        PayoutSent::class => [
            SendPayoutNotification::class,  // users
        ],
        SupportTicketCreated::class => [   //  --used
            SendSupportCreatedNotification::class,  // user and admin(system & can receive system email)
        ],
        SupportTicketUpdated::class => [  //  --used
            SendSupportUpdatedNotification::class,
        ],
        TestimonialCreated::class => [
            SendTestimonialNotification::class,  // user and admin admin(system & can receive system email)
        ],
        EmailBroadcast::class => [
            SendEmailBroadcast::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
