{{--
    Vue : clients/create.blade.php
    Rôle : Formulaire de création d'un nouveau client
    Données reçues : aucune (nouveau client vide)
--}}

@extends('layouts.app')

@section('title', 'Nouveau client')

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
                    <li class="breadcrumb-item active">Nouveau</li>
                </ol>
            </nav>

            {{-- Carte formulaire --}}
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-bottom py-3 px-4">
                    <h5 class="mb-0 fw-semibold text-dark">
                        <i class="bi bi-plus-circle me-2 text-primary"></i>Créer un client
                    </h5>
                </div>

                <div class="card-body p-4">
                    {{--
                        Formulaire de création.
                        action  → route clients.store (POST)
                    --}}
                    <form action="{{ route('clients.store') }}" method="POST" novalidate>
                        @csrf

                        {{-- Prénom et Nom côte à côte --}}
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <label for="first_name" class="form-label fw-semibold">
                                    Prénom <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="first_name"
                                    name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name') }}"
                                    placeholder="Ex : Jean"
                                    autofocus
                                    maxlength="255"
                                >
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="last_name" class="form-label fw-semibold">
                                    Nom <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="last_name"
                                    name="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name') }}"
                                    placeholder="Ex : Dupont"
                                    maxlength="255"
                                >
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                Adresse email <span class="text-danger">*</span>
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                placeholder="Ex : jean@example.com"
                                maxlength="255"
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Téléphone --}}
                        <div class="mb-4">
                            <label for="phone" class="form-label fw-semibold">
                                Téléphone
                                <span class="text-muted fw-normal small">(facultatif)</span>
                            </label>
                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}"
                                placeholder="Ex : +33 6 12 34 56 78"
                                maxlength="20"
                            >
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Adresse --}}
                        <div class="mb-4">
                            <label for="address" class="form-label fw-semibold">
                                Adresse
                                <span class="text-muted fw-normal small">(facultatif)</span>
                            </label>
                            <textarea
                                id="address"
                                name="address"
                                rows="3"
                                class="form-control @error('address') is-invalid @enderror"
                                placeholder="Adresse complète du client…"
                                maxlength="500"
                            >{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-end" id="addr-count">0 / 500</div>
                        </div>

                        {{-- Boutons d'action --}}
                        <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                            <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary px-4">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check-lg me-1"></i>Enregistrer
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Compteur de caractères pour l'adresse
    const textarea = document.getElementById('address');
    const counter  = document.getElementById('addr-count');

    function updateCount() {
        const len = textarea.value.length;
        counter.textContent = len + ' / 500';
        counter.classList.toggle('text-danger', len >= 450);
    }

    textarea.addEventListener('input', updateCount);
    updateCount(); // initialisation si old() est rempli
</script>
@endpush
