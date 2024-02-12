<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Admin;

class AdminController {
    public function login(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        // Validation des identifiants
        if ($email && $password) {
            $admin = Admin::where('email', $email)->where('password', $password)->first();

            if ($admin) {
                // Connexion réussie
                return $response->withJson(['message' => 'Connexion réussie !']);
            } else {
                // Identifiants incorrects
                return $response->withStatus(401)->withJson(['message' => 'Identifiants incorrects']);
            }
        } else {
            // Données manquantes
            return $response->withStatus(400)->withJson(['message' => 'Veuillez fournir une adresse e-mail et un mot de passe']);
        }
    }
}
