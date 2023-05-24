@extends('layouts.admin')

@section('page-name')
    {{ $project->name }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="type">
                        <span class="text-uppercase fw-bold small">PROJECT TYPE:</span>

                        <span class="badge text-bg-secondary">
                            @if ($project->type_id != null)
                                {{$types[$project->type_id - 1]->name }}
                            @else
                                -
                            @endif
                        </span>
                    </div>
                    <div class="description mt-4">
                        {{ $project->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
