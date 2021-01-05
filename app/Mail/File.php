<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

class File extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $file;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$file)
    {
        $this->data = $data;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return 
        $this
        ->view('mail')
        ->attach(Storage::path($this->file),[
            'as' => pathinfo(Storage::path($this->file), PATHINFO_EXTENSION),
            'mime' =>  Storage::mimeType($this->file),
        ]);
    }
}
