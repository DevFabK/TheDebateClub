<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Argumento;
use App\Models\Puntuacion;
use Illuminate\Support\Facades\Auth;

class ArgumentoController extends Controller
{
    public function estrellas(Request $request)
    {
        $usuarioId = $request->query('usuario_id');
        $argumentoId = $request->query('argumento_id');

        if (!$usuarioId || !$argumentoId) {
            return response()->json(['error' => 'Parámetros incompletos'], 400);
        }

        $puntuacion = \App\Models\Puntuacion::where('usuario_id', $usuarioId)
            ->where('argumento_id', $argumentoId)
            ->first();

        return response()->json([
            'puntuacion' => $puntuacion ? ['valor' => $puntuacion->puntuacion] : null
        ]);
    }

    public function guardarEstrella(Request $request)
    {
        try {
            $request->validate([
                'argumento_id' => 'required|exists:argumentos,id',
                'puntuacion' => 'required|integer|min:1|max:5',
            ]);

            $usuarioId = Auth::id();

            if (!$usuarioId) {
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }

            $argumento = Argumento::find($request->argumento_id);
            $usuarioArgumento = User::find($argumento->usuario_id);

            $puntuacionExistente = Puntuacion::where('usuario_id', $usuarioId)
                ->where('argumento_id', $request->argumento_id)
                ->first();

            if ($puntuacionExistente) {
                $usuarioArgumento->puntos_de_debate -= $puntuacionExistente->puntuacion;
                $usuarioArgumento->puntos_de_debate += $request->puntuacion;

                $puntuacionExistente->puntuacion = $request->puntuacion;
                $puntuacionExistente->save();
            } else {
                Puntuacion::create([
                    'usuario_id' => $usuarioId,
                    'argumento_id' => $request->argumento_id,
                    'puntuacion' => $request->puntuacion,
                ]);

                $usuarioArgumento->puntos_de_debate += $request->puntuacion;
            }

            $usuarioArgumento->save();

            return response()->json([
                'mensaje' => 'Puntuación guardada correctamente.',
                'success' => true
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Datos de validación incorrectos',
                'details' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error interno del servidor',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
