@extends('layouts.main')
@section('MainContent')

<div class="row form-container" style="margin-left: 150px">
    <iframe src="{{ $publicFilePath }}" style="width: 1000px; height: 480px;"></iframe>
</div>
@stop