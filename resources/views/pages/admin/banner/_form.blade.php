<div class="mb-3">
    <label for="image_path" class="form-label">Gambar</label>
    <input type="file" name="image_path" class="form-control">
    @isset($banner->image_path)
    <img src="{{ $banner->imagePath() }}" width="150" height="100" class="mt-2">
    @endisset
    @error('image_path')
    <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $button }}</button>