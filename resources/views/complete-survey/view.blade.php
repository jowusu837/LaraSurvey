@extends('layouts.app')
@section('title', $survey->title)
@section('hideNavbar', false)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">Please fill this survey</div>
                    <div class="card-body">
                        <form action="{{ route('complete-survey', $survey->id) }}" method="post">
                            @csrf
                            @foreach($survey->questions as $question)
                                <div class="form-group mb-5">
                                    <label for="{{ $question->id }}">{{ $question->question }}</label>

                                    @if($question->type == \App\Question::FREE_TEXT)
                                        <input id="{{ $question->id }}" type="text" class="form-control">

                                    @elseif($question->type == \App\Question::NUMBERS)
                                        <input id="{{ $question->id }}" type="number" class="form-control">

                                    @elseif($question->type == \App\Question::SINGLE_ANSWER)
                                        <select id="{{ $question->id }}" class="form-control">
                                            @foreach($question->options as $opt)
                                                <option>{{ $opt }}</option>
                                            @endforeach
                                        </select>

                                        @elseif($question->type == \App\Question::MULTIPLE_ANSWER)
                                        <select class="form-control multi-select" multiple data-live-search="true">
                                            @foreach($question->options as $opt)
                                                <option>{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
