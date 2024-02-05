<?php

namespace App\Listeners;

use App\Events\UserUpgraded;
use App\Models\BonusBinary;
use App\Models\BonusReferral;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenealogyAddUpgradeBonus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserUpgraded  $event
     * @return void
     */
    public function handle(UserUpgraded $event)
    {
        // not used again, moved to MLMController ->upgradeStore
        $user = $event->user;
        $old_package = $event->old_package;
        $new_package = $event->new_package;

    }






}
