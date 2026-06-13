{{--
    Vue : clients/show.blade.php
    Rôle : Affiche le détail complet d'un client
    Données reçues : $client (instance App\Models\Client)
--}}

@extends('layouts.app')

@section('title', $client->first_name . ' ' . $client->last_name)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            {{-- Fil d'Ariane --}}
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item">
                        <a href="{{ route('clients.index') }}" class="text-decoration-none">
                            <i class="bi bi-people me-1"></i>Clients
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-truncate" style="max-width: 300px">
                        {{ $client->first_name }} {{ $client->last_name }}
                    </li>
                </ol>
            </nav>

            {{-- Carte détail client --}}
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary bg-gradient text-white py-4 px-4 rounded-top-3">
                    <div class="d-flex align-items-center gap-3">
                        {{-- Avatar / Icône --}}
                        <div class="avatar-circle bg-white bg-opacity-25 p-3 rounded-circle"
                             style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-person fs-3"></i>
                        </div>
                        <div>
                            <h4 class="mb-1">{{ $client->first_name }} {{ $client->last_name }}</h4>
                            <p class="small mb-0 opacity-75">
                                <i class="bi bi-calendar-event me-1"></i>Créé il y a {{ $client->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    {{-- Grille d'informations --}}
                    <div class="row g-4">

                        {{-- Colonne 1 : Identité --}}
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-muted fw-semibold small mb-3">
                                <i class="bi bi-person-badge me-1"></i>Identité
                            </h6>

                            <div class="mb-3">
                                <p class="text-muted small mb-1">Prénom</p>
                                <p class="fw-semibold text-dark">{{ $client->first_name }}</p>
                            </div>

                            <div class="mb-3">
                                <p class="text-muted small mb-1">Nom</p>
                                <p class="fw-semibold text-dark">{{ $client->last_name }}</p>
                            </div>
                        </div>

                        {{-- Colonne 2 : Contact --}}
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-muted fw-semibold small mb-3">
                                <i class="bi bi-telephone me-1"></i>Contact
                            </h6>

                            <div class="mb-3">
                                <p class="text-muted small mb-1">Email</p>
                                <p>
                                    <a href="mailto:{{ $client->email }}" class="text-primary text-decoration-none fw-semibold">
                                        {{ $client->email }}
                                    </a>
                                </p>
                            </div>

                            <div class="mb-3">
                                <p class="text-muted small mb-1">Téléphone</p>
                                <p class="fw-semibold text-dark">
                                    @if ($client->phone)
                                        <a href="tel:{{ $client->phone }}" class="text-decoration-none text-dark">
                                            {{ $client->phone }}
                                        </a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Adresse (pleine largeur) --}}
                    <hr class="my-4">
                    <h6 class="text-uppercase text-muted fw-semibold small mb-3">
                        <i class="bi bi-geo-alt me-1"></i>Adresse
                    </h6>
                    <p class="text-dark" style="white-space: pre-wrap;">
                        {{ $client->address ?: '—' }}
                    </p>

                    {{-- Métadonnées --}}
                    <hr class="my-4">
                    <div class="row text-center text-muted small">
                        <div class="col">
                            <p class="mb-1">Créé le</p>
                            <p class="fw-semibold text-dark">{{ $client->created_at->format('d/m/Y à H:i') }}</p>
                        </div>
                        <div class="col">
                            <p class="mb-1">Dernière modification</p>
                            <p class="fw-semibold text-dark">{{ $client->updated_at->format('d/m/Y à H:i') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Boutons d'action --}}
                <div class="card-footer bg-light border-top py-3 px-4 rounded-bottom-3 d-flex justify-content-between">
                    <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i>Retour
                    </a>

                    <div class="d-flex gap-2">
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning text-dark fw-semibold px-4">
                            <i class="bi bi-pencil me-1"></i>Modifier
                        </a>

                        <form action="{{ route('clients.destroy', $client) }}"
                              method="POST"
                              onsubmit="return confirm('Supprimer « {{ addslashes($client->first_name . ' ' . $client->last_name) }} » ? Cette action est irréversible.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger px-4">
                                <i class="bi bi-trash me-1"></i>Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
