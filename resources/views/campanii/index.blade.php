@extends('layouts.app')

@section('title', 'Manager campanii')

@section('content')
    <section class="hero">
        <div class="container hero-inner">
            <div class="hero-text">
                <span class="hero-kicker">Aplicatie CRUD Laravel</span>
                <h1>Administrezi campaniile intr-un design preluat din site-ul tau</h1>
                <p>
                    Aceasta versiune muta tematica HTML/CSS/JS in Blade, iar toate operatiile de
                    adaugare, editare si stergere sunt persistate in <code>database/database.sqlite</code>.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('campanii.create') }}" class="btn btn-dark">Adauga o campanie</a>
                    <a href="#campanii" class="btn btn-outline">Vezi lista salvata</a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-orbit">
                    <div class="orbit-core">CRUD</div>
                    <span class="orbit-chip orbit-chip-a">Blade</span>
                    <span class="orbit-chip orbit-chip-b">SQLite</span>
                    <span class="orbit-chip orbit-chip-c">Laravel</span>
                </div>
            </div>
        </div>

        <div class="logos-bar">
            <div class="container logos-inner">
                @foreach ($serviceOptions as $label)
                    <span class="logo-item">{{ $label }}</span>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section" id="statistici">
        <div class="container">
            <div class="section-header">
                <span class="badge">Statistici</span>
                <p class="section-desc">
                    Rezumat rapid al datelor deja salvate in SQLite. Cartile folosesc aceeasi directie vizuala ca tema originala.
                </p>
            </div>

            <div class="services-grid">
                <article class="card card-green">
                    <div class="card-content">
                        <span class="stat-label">Campanii totale</span>
                        <h3>{{ $stats['total'] }}</h3>
                        <p>Toate inregistrarile existente in baza de date.</p>
                    </div>
                </article>

                <article class="card card-dark">
                    <div class="card-content">
                        <span class="stat-label">Campanii active</span>
                        <h3>{{ $stats['active'] }}</h3>
                        <p>Proiecte care ruleaza acum si au nevoie de follow-up.</p>
                    </div>
                </article>

                <article class="card card-light">
                    <div class="card-content">
                        <span class="stat-label">Finalizate</span>
                        <h3>{{ $stats['completed'] }}</h3>
                        <p>Campanii marcate ca finalizate in sistem.</p>
                    </div>
                </article>

                <article class="card card-green">
                    <div class="card-content">
                        <span class="stat-label">Buget total</span>
                        <h3>{{ number_format($stats['budget'], 2, ',', ' ') }} EUR</h3>
                        <p>Suma cumulata a bugetelor introduse.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="cta-banner" id="flux">
        <div class="container cta-inner">
            <div class="cta-text">
                <h2>Flux complet CRUD, fara mockup</h2>
                <p>
                    Formularul creeaza inregistrari reale, editarea modifica datele existente, iar stergerea elimina randurile din baza.
                    Structura este deja pregatita pentru extindere cu autentificare sau module suplimentare.
                </p>
                <a href="{{ route('campanii.create') }}" class="btn btn-dark">Creeaza prima campanie</a>
            </div>

            <div class="cta-panel">
                <div class="mini-stat">
                    <strong>DB</strong>
                    <span>SQLite local</span>
                </div>
                <div class="mini-stat">
                    <strong>UI</strong>
                    <span>Blade + CSS mutat</span>
                </div>
                <div class="mini-stat">
                    <strong>Ops</strong>
                    <span>Create / Update / Delete</span>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="campanii">
        <div class="container">
            <div class="section-header">
                <span class="badge">Campanii</span>
                <p class="section-desc">
                    Lista de mai jos este citita direct din <code>campanii</code>. Daca ai SQL Studio deschis, vei vedea aceleasi date in `database.sqlite`.
                </p>
            </div>

            <div class="table-shell">
                <div class="table-toolbar">
                    <h2>Campanii salvate</h2>
                    <a href="{{ route('campanii.create') }}" class="btn btn-green">Campanie noua</a>
                </div>

                @if ($campanii->isEmpty())
                    <div class="empty-state">
                        <h3>Nu exista inca date salvate</h3>
                        <p>Adauga prima campanie si vei vedea imediat randul nou in aplicatie si in `database.sqlite`.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Proiect</th>
                                    <th>Serviciu</th>
                                    <th>Status</th>
                                    <th>Buget</th>
                                    <th>Lansare</th>
                                    <th>Actiuni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($campanii as $campanie)
                                    <tr>
                                        <td>{{ $campanie->client_name }}</td>
                                        <td>
                                            <strong>{{ $campanie->project_name }}</strong>
                                            @if ($campanie->notes)
                                                <span class="table-note">{{ \Illuminate\Support\Str::limit($campanie->notes, 70) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $serviceOptions[$campanie->service_type] ?? $campanie->service_type }}</td>
                                        <td>
                                            <span class="status-pill status-{{ $campanie->status }}">
                                                {{ $statusOptions[$campanie->status] ?? $campanie->status }}
                                            </span>
                                        </td>
                                        <td>{{ number_format((float) $campanie->budget, 2, ',', ' ') }} EUR</td>
                                        <td>{{ $campanie->launch_date->format('d.m.Y') }}</td>
                                        <td>
                                            <div class="actions-inline">
                                                <a href="{{ route('campanii.edit', $campanie) }}" class="btn btn-outline btn-small">Editeaza</a>
                                                <form action="{{ route('campanii.destroy', $campanie) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-small">Sterge</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="badge">Proces</span>
                <p class="section-desc">
                    Sectiune pastrata in spiritul designului original, dar adaptata pentru fluxul de administrare al aplicatiei.
                </p>
            </div>

            <div class="process-list">
                <article class="process-item active">
                    <button class="process-header" type="button" data-process-toggle>
                        <span class="step-num">01</span>
                        <span class="step-title">Creezi</span>
                        <span class="step-toggle">&#8722;</span>
                    </button>
                    <div class="process-body">
                        <p>Completezi formularul din pagina de creare, iar Laravel salveaza randul nou in tabela `campanii`.</p>
                    </div>
                </article>

                <article class="process-item">
                    <button class="process-header" type="button" data-process-toggle>
                        <span class="step-num">02</span>
                        <span class="step-title">Editezi</span>
                        <span class="step-toggle">&#43;</span>
                    </button>
                    <div class="process-body">
                        <p>Accesezi orice rand si modifici clientul, bugetul, statusul sau notitele fara sa rescrii manual in baza.</p>
                    </div>
                </article>

                <article class="process-item">
                    <button class="process-header" type="button" data-process-toggle>
                        <span class="step-num">03</span>
                        <span class="step-title">Stergi</span>
                        <span class="step-toggle">&#43;</span>
                    </button>
                    <div class="process-body">
                        <p>Daca o campanie nu mai este necesara, formularul de delete elimina direct inregistrarea din SQLite.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection
