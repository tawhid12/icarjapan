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
    protected $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //print_r($this->details);die;
        /*To User */
        $user = User::where('id', $n->user_id)->first();
        $v_data = Vehicle::where('id', $n->vehicle_id)->first();
        \Mail::send('mail.reply_user_body', ['notify' => $n], function ($message) use ($n, $v_data, $user) {
            $message->from('info@icarjapan.com', 'Icarjapan')
                ->to($user->email)
                ->subject('Reserved Free For ' . $v_data->name . ' and Stock Id ' . $v_data->stock_id);
        });

    }
}