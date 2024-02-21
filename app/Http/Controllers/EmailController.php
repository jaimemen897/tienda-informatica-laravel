<?php

namespace App\Http\Controllers;

use App\Mail\RestoreMail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    protected $address;

    public function __construct($address)
    {
        $this->address = $address;
    }


    public function sendWelcomeEmail()
    {
        $title = 'Bienvenido a nuestra tienda online';
        $body = 'A partir de ahora podrás iniciar sesión con esta cuenta y realizar tus compras. ¡Gracias por confiar en nosotros!';

        Mail::to($this->address)->send(new WelcomeMail($title, $body));

        return "Email sent successfully!";
    }

    public function sendRestoreEmail()
    {
        $title = 'Recuperación de contraseña';
        $body = 'Hemos recibido una solicitud para restablecer la contraseña de tu cuenta. Si no has sido tú, por favor, ignora este mensaje.';

        Mail::to($this->address)->send(new RestoreMail($title, $body));

        return "Email sent successfully!";
    }
}
