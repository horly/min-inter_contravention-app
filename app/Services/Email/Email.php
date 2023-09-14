<?php

namespace App\Services\Email;

/**
 * installation
 * - composer require phpmailer/phpmailer
 */

use App\Services\Device\Device;
use DateTime;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    protected $mail;
    protected $app_name;
    protected $username;

    function __construct()
    {
        $this->app_name = config('app.name'); //in .en file = EXADERP!
        $this->username = config('app.mail_username'); //in .en file = contact@exaderp.com

        $this->mail = new PHPMailer;
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 0; //pas d'afficahe de debug mais si nous voulons afficher les erreurs il faut le mettre à 2
        $this->mail->Port = config('app.mail_port'); 
        $this->mail->Host = config('app.mail_host'); 
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $this->username;
        $this->mail->Password = config('app.mail_password');
        $this->mail->CharSet  = "UTF-8";
    }

    //pour l'envoie du mail
    public function sendHtmlEmail($subject, $emailUser, $name, $message)
    {
        $this->mail->Subject = $subject;
        $this->mail->setFrom($this->username, $this->app_name);
        $this->mail->addReplyTo($this->username, $this->app_name);
        $this->mail->addAddress($emailUser, $name);
        $this->mail->IsHTML(true);
        $this->mail->Body = $message;
        $this->mail->send();

        //ici c'est pour le teste et voir les erreurs
        /*if(!$this->mail->send())
        {
            //return "error : " . $this->$mail->ErrorInfo;
            dd($this->mail->ErrorInfo);
        }
        else
        {
            dd("ok");
        }*/
    }

    //pour l'envoie du mail
    public function sendTextEmail($subject, $emailUser, $name, $message)
    {
        $this->mail->Subject = $subject;
        $this->mail->setFrom($this->username, $this->app_name);
        $this->mail->addReplyTo($this->username, $this->app_name);
        $this->mail->addAddress($emailUser, $name);
        $this->mail->IsHTML(false);
        $this->mail->Body = $message;
        $this->mail->send();

        //ici c'est pour le teste et voir les erreurs
        /*if(!$mail->send())
        {
            //return "error : " . $this->$mail->ErrorInfo;
        }
        else
        {
            return "success";
        }*/
    }

    public function sendLinkPayment($contrevenant, $infraction, $amande, $vehicule)
    {
        $name = $contrevenant->name;
        $email = $contrevenant->email;

        $infractionName = $infraction->name;

        $montant = $amande->montant;
        $devise = $amande->devise;

        $vehiculeMaque = $vehicule->marque;
        $vehiculeModele = $vehicule->model;
        $numMatricule = $vehicule->num_matricule;

        //on génère de nombre aleotoire de 6 chiffres si l'utilisateur choisie de copier coller le code
        $code = "";
        $longeur_code = 6;
        $token = md5(uniqid()) . $contrevenant->id . sha1($contrevenant->email);

        for($i = 0; $i < $longeur_code; $i++)
        {
            $code .= mt_rand(0,9);
        }

        DB::table('amandes')
            ->where('id_contre', $contrevenant->id)
            ->update([
                'code' => $code,
                'token' => $token
            ]);

        $dateImm = new \DateTimeImmutable;
        $dateTime = DateTime::createFromImmutable($dateImm);
        $date = $dateTime->format('Y-m-d H:i:s');
        //dd($date->format('Y-m-d H:i:s'));

        $subject = "Veuillez procéder au paiement de votre contravention";
        $message = view('mail.payment-link')
                    ->with([
                        'name' => $name,  //on passe nos variables dans la vue
                        'subject' => $subject,
                        'code' => $code,
                        'token' => $token, 
                        'infractionName' => $infractionName,
                        'montant' => $montant,
                        'devise' => $devise,
                        'vehiculeMaque' => $vehiculeMaque,
                        'vehiculeModele' => $vehiculeModele,
                        'numMatricule' => $numMatricule,
                        'time_date' => $date,
            ]);

        $this->sendHtmlEmail($subject, $email, $name, $message);
    }
}