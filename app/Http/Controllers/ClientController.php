<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Affiche la liste paginée des clients.
     * Route : GET /clients
     */
    public function index()
    {
        $clients = Client::latest()->paginate(10);

        return view('clients.index', compact('clients'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau client.
     * Route : GET /clients/create
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Valide et enregistre un nouveau client en base.
     * Route : POST /clients
     */
    public function store(Request $request)
    {
        // Validation des données entrantes selon les règles métier
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:clients,email', 'max:255'],
            'phone'      => ['nullable', 'string', 'max:20'],
            'address'    => ['nullable', 'string', 'max:500'],
        ], [
            // Messages d'erreur personnalisés en français
            'first_name.required'    => 'Le prénom du client est obligatoire.',
            'first_name.max'         => 'Le prénom ne peut pas dépasser 255 caractères.',
            'last_name.required'     => 'Le nom du client est obligatoire.',
            'last_name.max'          => 'Le nom ne peut pas dépasser 255 caractères.',
            'email.required'         => 'L\'adresse email est obligatoire.',
            'email.email'            => 'L\'adresse email doit être valide.',
            'email.unique'           => 'Cette adresse email est déjà utilisée.',
            'email.max'              => 'L\'email ne peut pas dépasser 255 caractères.',
            'phone.max'              => 'Le téléphone ne peut pas dépasser 20 caractères.',
            'address.max'            => 'L\'adresse ne peut pas dépasser 500 caractères.',
        ]);

        // Création du client avec les données validées (mass assignment sécurisé)
        Client::create($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client créé avec succès.');
    }

    /**
     * Affiche le détail d'un client spécifique.
     * Route : GET /clients/{client}
     * Utilise le route model binding de Laravel.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Affiche le formulaire d'édition d'un client existant.
     * Route : GET /clients/{client}/edit
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Valide et met à jour un client existant en base.
     * Route : PUT/PATCH /clients/{client}
     */
    public function update(Request $request, Client $client)
    {
        // Validation des données avec règle unique excluant le client actuel
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:clients,email,' . $client->id, 'max:255'],
            'phone'      => ['nullable', 'string', 'max:20'],
            'address'    => ['nullable', 'string', 'max:500'],
        ], [
            'first_name.required'    => 'Le prénom du client est obligatoire.',
            'first_name.max'         => 'Le prénom ne peut pas dépasser 255 caractères.',
            'last_name.required'     => 'Le nom du client est obligatoire.',
            'last_name.max'          => 'Le nom ne peut pas dépasser 255 caractères.',
            'email.required'         => 'L\'adresse email est obligatoire.',
            'email.email'            => 'L\'adresse email doit être valide.',
            'email.unique'           => 'Cette adresse email est déjà utilisée.',
            'email.max'              => 'L\'email ne peut pas dépasser 255 caractères.',
            'phone.max'              => 'Le téléphone ne peut pas dépasser 20 caractères.',
            'address.max'            => 'L\'adresse ne peut pas dépasser 500 caractères.',
        ]);

        // Mise à jour uniquement des champs fillable validés
        $client->update($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client mis à jour avec succès.');
    }

    /**
     * Supprime un client de la base de données.
     * Route : DELETE /clients/{client}
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client supprimé avec succès.');
    }
}
