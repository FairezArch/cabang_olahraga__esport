<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendMailController extends Controller
{
    //
    public function send()
    {
        $details = [
            'title' => 'Email dari testing',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit deserunt laborum dolores at officia blanditiis commodi cupiditate nobis, totam quibusdam ullam numquam hic dolorem fugiat exercitationem consectetur, quia praesentium quas!'
        ];
 
        try {
         
            \Mail::to('cyron.gen@gmail.com')->send(new \App\Mail\EsportMail($details));
            echo "Email berhasil dikirim.";
 
        } catch(\Exception $e){
            echo "Email gagal dikirim karena $e.";
        }
        
         
    }
}
