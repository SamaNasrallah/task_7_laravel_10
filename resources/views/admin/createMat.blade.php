@extends('layouts.main')
@section('MainContent')

<div class="row form-container">
    <div class="row form-container">
        <div class="col-md-3" >
            <form  action="{{ route('material.store' , ['group_id' => $group_id]) }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="group_id" value="{{ $group_id }}">
                <div class="form-group">
                    <label for ="name">Material Name : </label> 
                    <input type="text" name="name" id="name" class="form-control" style="width: 400px; height: 40px;">
                </div>
                <div class="form-group">
                    <label for="file">File:</label>
                    <input type="file" name="file" id="file" class="form-control-file" style="width: 400px; height: 40px;" onchange="toggleFields()">
                </div>
                <div class="form-group">
                    <label for="link">Link:</label>
                    <input type="text" name="link" id="link" class="form-control" style="width: 400px; height: 40px;" oninput="toggleFields()">
                </div>
                
                <button type="submit" class="btn btn-primary" id="btn-primary" >Save</button>

            </form>
  
        </div>

    </div>
    <script>
        function toggleFields() {
            var fileInput = document.getElementById("file");
            var linkInput = document.getElementById("link");
            
            if (fileInput.value !== "") {
                linkInput.disabled = true;
            } else if (linkInput.value !== "") {
                fileInput.disabled = true;
            } else {
                fileInput.disabled = false;
                linkInput.disabled = false;
            }
        }
    </script>
    
    <script>
          $(document).ready(function() {

        $(".btn-delete").click(function() {
            alert("Delete successfully");
        });

        $("#btn-primary").click(function() {
            alert("Added/Updated Material successfully");
        });
    });
    </script>

@stop