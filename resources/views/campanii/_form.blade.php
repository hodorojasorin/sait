@csrf

@if ($errors->any())
    <div class="alert alert-error">
        Verifica campurile marcate si incearca din nou.
    </div>
@endif

<div class="form-grid">
    <div class="form-group">
        <label for="client_name">Nume client</label>
        <input
            id="client_name"
            name="client_name"
            type="text"
            value="{{ old('client_name', $campanie->client_name) }}"
            class="@error('client_name') is-invalid @enderror"
            placeholder="Ex: Velox Studio"
            required
        >
        @error('client_name')
            <span class="field-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="project_name">Nume proiect</label>
        <input
            id="project_name"
            name="project_name"
            type="text"
            value="{{ old('project_name', $campanie->project_name) }}"
            class="@error('project_name') is-invalid @enderror"
            placeholder="Ex: Lansare Q2"
            required
        >
        @error('project_name')
            <span class="field-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="service_type">Serviciu</label>
        <select id="service_type" name="service_type" class="@error('service_type') is-invalid @enderror" required>
            <option value="">Alege serviciul</option>
            @foreach ($serviceOptions as $value => $label)
                <option value="{{ $value }}" @selected(old('service_type', $campanie->service_type) === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('service_type')
            <span class="field-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select id="status" name="status" class="@error('status') is-invalid @enderror" required>
            <option value="">Alege statusul</option>
            @foreach ($statusOptions as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $campanie->status) === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status')
            <span class="field-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="budget">Buget (EUR)</label>
        <input
            id="budget"
            name="budget"
            type="number"
            min="0"
            step="0.01"
            value="{{ old('budget', $campanie->budget) }}"
            class="@error('budget') is-invalid @enderror"
            placeholder="1200.00"
            required
        >
        @error('budget')
            <span class="field-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="launch_date">Data lansarii</label>
        <input
            id="launch_date"
            name="launch_date"
            type="date"
            value="{{ old('launch_date', optional($campanie->launch_date)->format('Y-m-d')) }}"
            class="@error('launch_date') is-invalid @enderror"
            required
        >
        @error('launch_date')
            <span class="field-error">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group form-group-full">
        <label for="notes">Observatii</label>
        <textarea
            id="notes"
            name="notes"
            rows="6"
            class="@error('notes') is-invalid @enderror"
            placeholder="Detalii despre obiective, deliverables sau observatii interne"
        >{{ old('notes', $campanie->notes) }}</textarea>
        @error('notes')
            <span class="field-error">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-dark">{{ $submitLabel }}</button>
    <a href="{{ route('campanii.index') }}#campanii" class="btn btn-outline">Inapoi la lista</a>
</div>
