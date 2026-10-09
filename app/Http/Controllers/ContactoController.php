<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    // Mostrar formulario de contacto
    public function showForm()
    {
        return view('contacto');
    }

    // Procesar el envío del formulario
    public function enviar(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'mensaje' => 'required|string|max:1000',
        ]);

        // ?: y no ?? porque una variable de entorno vacía llega como '' y ?? no la
        // detectaría: sin esto, dejar CONTACTO_DESTINATARIO en blanco cortaría el envío.
        $destinatario = config('services.contacto.destinatario') ?: config('mail.from.address');

        if (empty($destinatario)) {
            Log::error('No se pudo enviar el contacto: no hay destinatario configurado (CONTACTO_DESTINATARIO).');

            return back()->withErrors([
                'mensaje' => 'No pudimos registrar tu mensaje en este momento. Escribinos a '
                    . (config('mail.from.address') ?: 'la dirección indicada en el pie de página') . '.',
            ])->withInput();
        }

        try {
            Mail::to($destinatario)->send(new ContactoMailable(
                $validated['nombre'],
                $validated['email'],
                $validated['mensaje'],
            ));
        } catch (\Throwable $e) {
            // Si el envío falla no se pierde lo que el usuario escribió:
            // se registra el error y se le ofrecen los datos de contacto directos.
            Log::error('Falló el envío del formulario de contacto: ' . $e->getMessage());

            return back()->withErrors([
                'mensaje' => 'No pudimos enviar tu mensaje en este momento. Podés escribirnos a '
                    . (config('mail.from.address') ?: 'la dirección del pie de página')
                    . ' o llamar al teléfono que figura allí. Tu mensaje no se perdió: te lo '
                    . 'devolvemos para que puedas reintentarlo.',
            ])->withInput();
        }

        return redirect()->route('contacto')
            ->with('success', 'Mensaje enviado correctamente. Te responderemos a la brevedad.');
    }
}