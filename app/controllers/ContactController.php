<?php

namespace app\controllers;

use app\support\Email;
use app\support\FlashMessage;
use app\support\Validate;

class ContactController extends Controller
{
    public function index()
    {

        Controller::view("contact", [], 'Contato');
    }
    public function send()
    {
        $validate = new Validate;
        $validations = $validate->validations([
            'name' => 'required',
            'email' => 'email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if (!$validations) {
            return redirect("/contact");
        }

        $email = new Email;
        $sent  = $email->from($validations['email'], $validations['name'])
            ->to(['minhaempresa@alguma.com'])
            ->message($validations['message'])
            ->template('contact',['name' => 'Wems'] )
            ->subject($validations['subject'])
            ->send();

            if($sent){
                FlashMessage::setFlashMessage("sent_success","Email enviado com sucesso");
                return redirect("/contact");
            }else{
                FlashMessage::setFlashMessage("sent_error","Falha ao enviar o email");
                return redirect("/contact");
            }
    }
}
