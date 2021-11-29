<?php

namespace App\Mail;

use App\Kullanici;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KullaniciKayitMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kullanici;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Kullanici $kullanici)
    {
        $this -> kullanici= $kullanici;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
//Burda envoiremnt klasöründeki mail ayarlarından sabit bir mail adresi belirleyip sürekli yazmak zorunda kalmıyoruz !!
//           ->from("yarciarif95@gmail.com")
            ->subject(config("app.name"). "- Kullanıcı Kaydı")
            ->view("mails.kullanici_kayit");
    }
}
