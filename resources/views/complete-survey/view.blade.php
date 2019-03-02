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
                        <form action="{{ route('complete-survey.submit', $survey->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="session_id" value="{{ $session_id }}">
                            @foreach($survey->questions as $question)
                                <div class="form-group mb-5">
                                    <label for="{{ $question->id }}">{{ $question->question }}</label>

                                    @if($question->type == \App\Question::FREE_TEXT)
                                        <input name="answers[{{ $question->id }}]" id="{{ $question->id }}" type="text"
                                               class="form-control">

                                    @elseif($question->type == \App\Question::NUMBERS)
                                        <input name="answers[{{ $question->id }}]" id="{{ $question->id }}" type="number"
                                               class="form-control">

                                    @elseif($question->type == \App\Question::SINGLE_ANSWER)
                                        <select name="answers[{{ $question->id }}]" id="{{ $question->id }}"
                                                class="form-control">
                                            @foreach($question->options as $opt)
                                                <option>{{ $opt }}</option>
                                            @endforeach
                                        </select>

                                    @elseif($question->type == \App\Question::MULTIPLE_ANSWER)
                                        <select name="answers[{{ $question->id }}]" id="{{ $question->id }}"
                                                class="form-control multi-select" multiple data-live-search="true">
                                            @foreach($question->options as $opt)
                                                <option>{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">You can pick more than one answer.</small>
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
