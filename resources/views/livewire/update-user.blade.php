<div>
    <form autocomplete="off" wire:submit.prevent="store">

        <div class="form-group row">
            <label for="vii"
                   class="col-md-4 col-form-label text-md-right">{{ __('Update Vii') }}</label>

            <div class="col-md-6">
                <input wire:model="vii" id="vii" type="text"
                       class="form-control @error('vii') is-invalid @enderror">

                @error('vii')
                <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="q1"
                   class="col-md-4 col-form-label text-md-right">{{ \App\UserQA::QUESTIONS[$questions[1]] }}</label>

            <div class="col-md-6">
                <select wire:model="answers.1" id="q1" class="form-control @error('answers.1') is-invalid @enderror"
                        required>
                    <option value="0" selected>Select Your Answer</option>
                    @foreach(\App\UserQA::QUESTION_ONE_OPTIONS as $key => $label)
                        <option
                            value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('answers.1')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="q2"
                   class="col-md-4 col-form-label text-md-right">{{ \App\UserQA::QUESTIONS[$questions[2]] }}</label>

            <div class="col-md-6">
                <select wire:model="answers.2" id="q2" class="form-control @error('answers.2') is-invalid @enderror"
                        required>
                    <option value="0" selected>Select Your Answer</option>
                    @foreach(\App\UserQA::QUESTION_TWO_OPTIONS as $key => $label)
                        <option
                            value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('answers.2')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="q3"
                   class="col-md-4 col-form-label text-md-right">{{ \App\UserQA::QUESTIONS[$questions[3]] }}</label>

            <div class="col-md-6">
                <select wire:model="answers.3" id="q3" class="form-control @error('answers.3') is-invalid @enderror"
                        required>
                    <option value="0" selected>Select Your Answer</option>
                    @foreach(\App\UserQA::QUESTION_THREE_OPTIONS as $key => $label)
                        <option
                            value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('answers.3')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>

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

        <div class="form-group row">
            <label for="profileText"
                   class="col-md-4 col-form-label text-md-right">{{ __('Update User Profile Text') }}</label>

            <div class="col-md-6">
                <input wire:model="profileText" id="profileText" type="text"
                       class="form-control @error('profileText') is-invalid @enderror">

                @error('profileText')
                <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Upload') }}
                </button>
            </div>
        </div>

    </form>
</div>
