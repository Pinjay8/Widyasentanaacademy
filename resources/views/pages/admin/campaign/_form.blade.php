<div class="mb-3">
    <label for="title" class="form-label">Judul</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $campaign->title ?? '') }}">
    @error('title')
    <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea name="description" id="editor"
        class="form-control">{{ old('description', $campaign->description ?? '') }}</textarea>
    @error('description')
    <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="target_amount" class="form-label">Target Dana</label>
    <input type="number" name="target_amount" class="form-control"
        value="{{ old('target_amount', $campaign->target_amount ?? '') }}">
    @error('target_amount')
    <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="start_date" class="form-label">Tanggal Mulai</label>
    <input type="date" name="start_date" class="form-control"
        value="{{ old('start_date', $campaign->start_date ?? '') }}">
    @error('start_date')
    <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="end_date" class="form-label">Tanggal Selesai</label>
    <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $campaign->end_date ?? '') }}">
    @error('end_date')
    <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="thumbnail" class="form-label">Gambar</label>
    <input type="file" name="thumbnail" class="form-control">
    @isset($campaign->thumbnail)
    <img src="{{ $campaign->thumbnail() }}" width="100" class="mt-2">
    @endisset
    @error('thumbnail')
    <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" class="form-select">
        <option value="" disabled {{ old('status', $campaign->status ?? '') === null ? 'selected' : '' }}>Pilih Status
        </option>
        <option value="aktif" {{ old('status', $campaign->status ?? '') === 'aktif' ? 'selected' : '' }}>Aktif</option>
        <option value="selesai" {{ old('status', $campaign->status ?? '') === 'selesai' ? 'selected' : '' }}>Selesai
        </option>
        <option value="ditutup" {{ old('status', $campaign->status ?? '') === 'ditutup' ? 'selected' : '' }}>Ditutup
        </option>
    </select>
    @error('status')
    <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $button }}</button>

