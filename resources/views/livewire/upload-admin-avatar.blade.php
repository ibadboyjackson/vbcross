<div>
    <form autocomplete="off" wire:submit.prevent="store">

        <div class="form-group row">
            <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Upload User Avatar') }}</label>

            <div class="col-md-6">
                <input wire:model="avatar" accept="image/*" id="avatar" type="file"
                       class="form-control @error('avatar') is-invalid @enderror">

                @error('avatar')
                <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>
        </div>

        @if ($avatar)
            <div class="form-group row">
                <label for="preview" class="col-md-4 col-form-label text-md-right">{{ __('Preview') }}</label>

                <div class="col-md-6">
                    <img src="{{ $avatar->temporaryUrl() }}" width="150px">
                </div>
            </div>
        @endif

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Upload') }}
                </button>
            </div>
        </div>

    </form>
</div>
