@extends('main')

@section('content')
    <div class="container">
        <div class="text-center pt-5">
            <h1 class="">The Hangman Game</h1>

            <div class="mt-5">
                @foreach ($chars as $ch)
                    <span class="inline-block border border-danger bg-light p-1 letter">{!! '&nbsp;' !!}</span>   
                @endforeach
            </div>

            {{ implode('', $chars) }}

            <div class="row">
                <form class="col-auto mt-4" action="{{ url('game/' . ($word ? $word->id : '')) }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-auto">
                            <div class="text-left">
                                <input type="text" class="form-control" id="letterInput" name="letter">
                                <label class="form-label" for="letterInput">Enter a letter</label>
                            </div>
                        </div>
                        
                        <div class="col-auto">
                            <input type="submit" class="btn btn-info" value="Submit" />
                            {{-- <button type="button" class="btn btn-info">Submit</button> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection