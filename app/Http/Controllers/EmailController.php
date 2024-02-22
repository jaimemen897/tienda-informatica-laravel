<?php

namespace App\Http\Controllers;

use App\Mail\RestoreMail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    protected $address;
    public $token;

    public function __construct($address, $token)
    {
        $this->address = $address;
        $this->token = $token;
    }


    public function sendWelcomeEmail()
    {
        $title = 'Bienvenido a nuestra tienda online';
        $body = 'A partir de ahora podrás iniciar sesión con esta cuenta y realizar tus compras. ¡Gracias por confiar en nosotros!';

        Mail::to($this->address)->send(new WelcomeMail($title, $body));

        return "Email enviado correctamente!";
    }

    public function sendRestoreEmail()
    {
        $title = 'Recuperación de contraseña';
        $body = 'Hemos recibido una solicitud para restablecer la contraseña de tu cuenta. Si no has sido tú, por favor, ignora este mensaje.';

        Mail::to($this->address)->send(new RestoreMail($title, $body, $this->token));

        return "Email enviado correctamente!";
    }
}
