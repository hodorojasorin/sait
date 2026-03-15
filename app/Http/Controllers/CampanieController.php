<?php

namespace App\Http\Controllers;

use App\Models\Campanie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CampanieController extends Controller
{
    public function index(): View
    {
        $campanii = Campanie::query()
            ->latest()
            ->get();

        $stats = [
            'total' => $campanii->count(),
            'active' => $campanii->where('status', 'activa')->count(),
            'completed' => $campanii->where('status', 'finalizata')->count(),
            'budget' => (float) $campanii->sum('budget'),
        ];

        return view('campanii.index', [
            'campanii' => $campanii,
            'serviceOptions' => Campanie::serviceOptions(),
            'statusOptions' => Campanie::statusOptions(),
            'stats' => $stats,
        ]);
    }

    public function create(): View
    {
        return view('campanii.create', [
            'campanie' => new Campanie(),
            'serviceOptions' => Campanie::serviceOptions(),
            'statusOptions' => Campanie::statusOptions(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Campanie::create($this->validatedData($request));

        return redirect()
            ->route('campanii.index')
            ->with('status', 'Campania a fost salvata cu succes in database.sqlite.');
    }

    public function edit(Campanie $campanie): View
    {
        return view('campanii.edit', [
            'campanie' => $campanie,
            'serviceOptions' => Campanie::serviceOptions(),
            'statusOptions' => Campanie::statusOptions(),
        ]);
    }

    public function update(Request $request, Campanie $campanie): RedirectResponse
    {
        $campanie->update($this->validatedData($request));

        return redirect()
            ->route('campanii.index')
            ->with('status', 'Campania a fost actualizata in database.sqlite.');
    }

    public function destroy(Campanie $campanie): RedirectResponse
    {
        $campanie->delete();

        return redirect()
            ->route('campanii.index')
            ->with('status', 'Campania a fost stearsa din database.sqlite.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'client_name' => ['required', 'string', 'max:120'],
            'project_name' => ['required', 'string', 'max:120'],
            'service_type' => ['required', Rule::in(array_keys(Campanie::serviceOptions()))],
            'status' => ['required', Rule::in(array_keys(Campanie::statusOptions()))],
            'budget' => ['required', 'numeric', 'min:0', 'max:9999999.99'],
            'launch_date' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);
    }
}
