<div>
    <div class="block"></div>
    @if (session()->has('success'))
        <h1 class="has-text-success">{{ session('success') }}</h1>
    @endif

    @if (session()->has('createpollerror'))
        <h1 class="has-text-danger"> {{ session('createpollerror') }} </h1>
    @endif

    @if (session()->has('choiceserror'))
        <h1 class="has-text-danger"> {{ session('choiceserror') }} </h1>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="has-text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if($created == false)
        <div wire:loading.remove wire:target="submit">
            <form wire:submit.prevent="submit">
                <div class="block"></div>
                <label for="question" class="has-text-primary is-size-5">Question:</label>
                <div class="field">
                    <div class="control">
                        <input type="text" id="question" wire:model.lazy="question" class="input rounded is-primary-focus">
                    </div>
                </div>
                <label for="choices" class="has-text-primary is-size-5">Choices:</label>
                <div id="choices">
                    @foreach ($choices as $key => $choice)
                        <div class="field">
                            <div class="control">
                                <input type="text" id="choices_{{ $key }}" wire:model.lazy="choices.{{ $key }}" class="input rounded is-secondary-focus">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="block"></div>
                <button type="submit" wire:click.prevent="addChoice" class="button is-fullwidth is-phantom accent-button">Add Choice</button>
                <button type="submit" wire:click.prevent="resetChoice" class="button is-solid grey-button raised is-fullwidth">Reset Choices</button>
                <div class="block"></div>
                <label for="select" class="has-text-primary is-size-5">Ends:</label>
                <div class="field">
                    <div class="control">
                        <div class="select is-link is-fullwidth">
                            <select wire:model.lazy="expires">
                                @foreach ($ends as $d)
                                    <option>{{ $d }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="block"></div>
                <button class="button is-solid accent-button is-fullwidth" type="submit" wire:loading.attr="disabled">Create Poll</button>
            </form>

        </div>
        <div wire:loading.delay.longest wire:loading wire:target="submit">

            <h1 class="has-text-primary is-size-4 has-text-centered"> Loading..</h1>



        </div>
    @elseif($created)
        <livewire:pollsbb.view-poll :poll="$poll" />
    @endif

</div>
