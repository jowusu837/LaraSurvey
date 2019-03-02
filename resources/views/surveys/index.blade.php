@extends('layouts.app')
@section('title', 'Surveys')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Here are the surveys you've created so far</div>

                    <div class="card-body">
                        <div class="my-4">
                            <a href="{{ route('surveys.create') }}" class="btn btn-primary">Create a survey</a>
                        </div>
                        <table class="table">
                            @foreach($surveys as $survey)
                                <tr>
                                    <td>
                                        <i class="fa fa-align-left mr-2"></i>
                                        <a href="{{ route('surveys.show', $survey->id) }}">{{ $survey->title }}</a>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('surveys.show', $survey->id) }}" class="btn btn-sm btn-light">View results</a>
                                        {{--<a href="#" class="btn btn-sm btn-light">Edit</a>--}}
                                        {{--<a href="#" class="btn btn-sm btn-outline-success">Publish</a>--}}
                                        {{--<a href="#" class="btn btn-sm btn-outline-danger">Delete</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>What is your favorite food?</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
