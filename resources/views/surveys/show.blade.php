@extends('layouts.app')
@section('title', sprintf('Survey: %s', $survey->title))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header"><i class="fa fa-align-left mr-2"></i> {{ $survey->title }}</div>

                    <div class="card-body">
                        @if($survey->responses->isEmpty())
                            <p class="card-text">You have not received any feedback for this survey yet.</p>
                            <div class="align-content-center d-flex justify-content-center pt-4">
                                <div class="form-group">
                                    <label for="surveyLink">Share this link to start getting some feedback
                                        immediately.</label>
                                    <div class="input-group">
                                        <input id="surveyLink" type="url" class="form-control border-secondary"
                                               value="{{ route('complete-survey.view', $survey->id) }}" readonly/>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                                                Copy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="card-text">Here is the feedback you've received for this survey so far.</p>

                            <table class="table">
                                @for($i = 0; $i < $survey->questions->count(); $i++)
                                    <tr class="mb-5">
                                        <td>
                                            <h5 class="card-title">
                                                {{ $survey->questions[$i]->question }}
                                            </h5>
                                        </td>
                                        <td>
                                            @foreach($survey->questions[$i]->response_stats as $stat)
                                                <p>{{ $stat->answer }} ({{ $stat->answer_count }})</p>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endfor
                            </table>
                        @endif
                    </div>
                    <div class="card-footer text-muted text-right">
                        <small>This survey was created {{ $survey->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
