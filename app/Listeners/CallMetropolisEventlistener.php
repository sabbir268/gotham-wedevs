<?php

namespace App\Listeners;

use App\Events\CallMetropolisEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CallMetropolisEventlistener
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
     * @param  object  $event
     * @return void
     */
    public function handle(CallMetropolisEvent $event)
    {
        $ch = curl_init();
        $url = env('METRPOLIS_URL');
        curl_setopt($ch, CURLOPT_URL, $url . "/post");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["api_key:" . env('METRPOLIS_KEY') . ""]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "title=" . $event->title . "&body=" . $event->body . "&user_id=" . $event->user_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return  $server_output = curl_exec($ch);
        curl_close($ch);
    }
}
