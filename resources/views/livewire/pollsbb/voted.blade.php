<div>
    <h1 class="has-text-primary is-size-4 has-text-centered">Results: {{ $Question }}</h1>
    @foreach ($Votes as $vote)
        @if($loop->first)
            @php
                $class = 'is-success';
            @endphp
        @endif
        @if($loop->index == 1)
            @php
                $class = 'is-warning';
            @endphp
        @endif
        @if($loop->index == 2)
            @php
                $class = 'is-warning';
            @endphp
        @endif
        @if($loop->iteration >= 4)
            @php
                $class = 'is-danger';
            @endphp
        @endif


        <p class="has-text-white"> {{ $vote['selection'] }}</p>
        <p class="has-text-white has-text-centered">{{ number_format($vote['percentage'], 2) }}%</p>
        <progress class="progress {{ $class }} is-right" value="{{ $vote['percentage'] }}" max="100">{{ $vote['percentage'] }}</progress>
    @endforeach
</div>
