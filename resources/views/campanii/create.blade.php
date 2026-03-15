@extends('layouts.app')

@section('title', 'Campanie noua')

@section('content')
    <section class="hero hero-compact">
        <div class="container hero-inner hero-inner-single">
            <div class="hero-text">
                <span class="hero-kicker">Create</span>
                <h1>Adauga o campanie noua</h1>
                <p>
                    Formularul de mai jos scrie direct in <code>database/database.sqlite</code>. Dupa salvare revii in lista principala.
                </p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="contact-wrapper">
                <div class="contact-form-area">
                    <div class="section-header section-header-compact">
                        <span class="badge">Formular</span>
                        <p class="section-desc">Completeaza datele principale pentru campania pe care vrei sa o gestionezi.</p>
                    </div>

                    <form class="contact-form" method="POST" action="{{ route('campanii.store') }}">
                        @include('campanii._form', ['submitLabel' => 'Salveaza campania'])
                    </form>
                </div>

                <aside class="side-panel">
                    <div class="side-card">
                        <h3>Ce se salveaza</h3>
                        <ul class="side-list">
                            <li>Client</li>
                            <li>Proiect</li>
                            <li>Serviciu si status</li>
                            <li>Buget si data lansarii</li>
                            <li>Observatii</li>
                        </ul>
                    </div>

                    <div class="side-card side-card-dark">
                        <h3>Verificare rapida</h3>
                        <p>Dupa submit, deschide tabela `campanii` in SQL Studio si vei vedea randul nou.</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
