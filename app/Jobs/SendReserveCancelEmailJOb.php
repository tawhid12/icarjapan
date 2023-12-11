<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Vehicle\Vehicle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendReserveCancelEmailJOb implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $n;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($n)
    {
        $this->n = $n;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $n = $this->n;
        //print_r($this->details);die;
        /*To User */
        $user = User::where('id', $n->user_id)->first();
        $v_data = Vehicle::where('id', $n->vehicle_id)->first();
        \Mail::send('mail.reply_user_body', ['user' => $user], function ($message) use ($user, $v_data, $user) {
            $message->from('info@icarjapan.com', 'Icarjapan')
                ->to($user->email)
                ->subject('Reserved Free For ' . $v_data->name . ' and Stock Id ' . $v_data->stock_id);
        });

    }
}
