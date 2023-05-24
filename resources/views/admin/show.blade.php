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
                        <span class="badge text-bg-secondary">{{ $project->type_id }}</span>
                    </div>
                    <div class="description mt-4">
                        {{ $project->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
