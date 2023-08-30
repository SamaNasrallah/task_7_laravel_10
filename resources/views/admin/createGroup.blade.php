@extends('layouts.main')
@section('MainContent')


<div class="row form-container">
    <div class="row form-container">
        <div class="col-md-3" >
            <form id="categoryForm" action="{{ route('group.store', ['course_id' => $course_id]) }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" id="method" value="POST">
                <input type="hidden" name="course_id" value="{{ $course_id }}">
            
                <div class="form-group">
                    <label for="group">Group</label>
                    <input type="text" name="name" id="name" class="form-control" style="width: 400px; height: 40px;">
                </div>
                <button type="submit" class="btn btn-primary" id="btn-primary">Save</button>
            </form>
  
        </div>
       
        <div class="col-md-3" >
            <table class="table table-success table-striped" style="width: 400px">
                <thead>
                    <tr style="text-align: center;">
                        <th>ID</th>
                        <th>Group</th>
                        <th>Material</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                    <tr>
                        <td>{{ $group->id }}</td>
                        <td>{{ $group->name }}</td>
                        <td>
                            <a class="btn btn-info" href="{{route('mate.index',$group->id)}}">
                                Material
                              </a>
                        </td>
                        <td>
                            <a class="btn btn-primary edit-category" data-id="{{ $group->id }}" data-name="{{ $group->name }}">
                                Edit
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('group.destroy', $group->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-delete" data-material-count="{{ $group->materials->count() }}">
                                    Delete
                                </button>
                            </form>
                        </td>
                      
                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

  
    <script>
          $(document).ready(function() {
            $(".edit-category").click(function() {
            var categoryName = $(this).data("name");
            var categoryId = $(this).data("id");

            $("#categoryForm").attr("action", "{{ route('group.update', '') }}/" + categoryId);
            $("#method").val("PUT");

            $("#name").val(categoryName);

        });

        $("#btn-primary").click(function() {
            alert("Added/Updated Group successfully");
        });

        $(".btn-delete").click(function() {
            var fileCount = $(this).data("material-count");
            return confirmDelete(fileCount);
        });

        function confirmDelete(fileCount) {
            if (fileCount > 0) {
                return confirm('Are you sure you want to delete the Group? Group contains ' + fileCount + ' material and they will be deleted too!');
            } else {
                alert("Group is empty , do you want to delete it already? ");
            }

            return true;
        }

    });
    </script>

@stop