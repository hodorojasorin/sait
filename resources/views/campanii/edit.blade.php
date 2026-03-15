@extends('layouts.app')

@section('title', 'Editeaza campania')

@section('content')
    <section class="hero hero-compact">
        <div class="container hero-inner hero-inner-single">
            <div class="hero-text">
                <span class="hero-kicker">Update</span>
                <h1>Editezi campania: {{ $campanie->project_name }}</h1>
                <p>
                    Modificarile sunt aplicate peste inregistrarea existenta si se scriu in acelasi fisier <code>database/database.sqlite</code>.
                </p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="contact-wrapper">
                <div class="contact-form-area">
                    <div class="section-header section-header-compact">
                        <span class="badge">Editare</span>
                        <p class="section-desc">Actualizeaza campania si salveaza noile valori.</p>
                    </div>

                    <form class="contact-form" method="POST" action="{{ route('campanii.update', $campanie) }}">
                        @method('PUT')
                        @include('campanii._form', ['submitLabel' => 'Actualizeaza campania'])
                    </form>
                </div>

                <aside class="side-panel">
                    <div class="side-card">
                        <h3>Rezumat curent</h3>
                        <ul class="side-list side-list-spaced">
                            <li><strong>Client:</strong> {{ $campanie->client_name }}</li>
                            <li><strong>Serviciu:</strong> {{ $serviceOptions[$campanie->service_type] ?? $campanie->service_type }}</li>
                            <li><strong>Status:</strong> {{ $statusOptions[$campanie->status] ?? $campanie->status }}</li>
                            <li><strong>Buget:</strong> {{ number_format((float) $campanie->budget, 2, ',', ' ') }} EUR</li>
                        </ul>
                    </div>

                    <div class="side-card side-card-dark">
                        <h3>Observatie</h3>
                        <p>Daca alegi stergerea din lista principala, randul este eliminat complet din baza de date.</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
