<div>
    <center>
        <div wire:loading.remove wire:target="submit">
            <form wire:submit.prevent="submit">

                <h1 class="has-text-white is-size-5">{{ $Question }}</h1>
                <div class="control">
                    @foreach ($Choices as $Choice)
                        <label class="material-radio is-orange is-medium">
                            <input type="radio" wire:model="choice" value="{{ $Choice['id'] }}">
                            <span class="dot"></span>
                            <span class="radio-label">{{ $Choice['option_text'] }}</span>
                        </label>
                    @endforeach

                    @if (session()->has('voted'))
                        <h1 class="has-text-success">{{ session('voted') }}</h1>
                    @endif

                    @if (session()->has('voteerror'))
                        <h1 class="has-text-danger"> {{ session('voteerror') }} </h1>
                    @endif

                </div>
                <button class="button is-solid accent-button is-fullwidth" type="submit" wire:loading.attr="disabled">Vote</button>

            </form>
        </div>
        <div wire:loading.delay.longest wire:loading wire:target="submit">

            <h1 class="has-text-primary is-size-3 has-text-centered"> Loading..</h1>

        </div>
    </center>
</div>
