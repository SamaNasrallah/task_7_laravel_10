@extends('layouts.main')
@section('MainContent')


<div class="row form-container">
    <div id="accordion">
        <h2>Groups --> Materials</h2>
        @foreach($course->group as $group)
            <div class="card">
                <div class="card-header" id="heading{{ $group->id }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $group->id }}" aria-expanded="true" aria-controls="collapse{{ $group->id }}" style="text-decoration: none; width: 150px;">
                            <span style="font-size: 24px;">{{ $group->name }}</span>
                        </button>
                    </h5>
                </div>

                <div id="collapse{{ $group->id }}" class="collapse" aria-labelledby="heading{{ $group->id }}" data-parent="#accordion">
                    <div class="card-body">
                        @foreach($group->materials as $material)
                            <p style="font-size: 18px;">{{ $material->name }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@stop