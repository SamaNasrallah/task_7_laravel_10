@extends('layouts.main')
@section('MainContent')
<br>
@if(session('error'))
    <div class="alert alert-danger" style=" position: fixed;   top: 0;
              left: 50%;
              transform: translateX(-50%);
              z-index: 1000;
              width:600px;
              text-align: center;">
        {{ session('error') }}
    </div>

@endif
@if(session('success'))
    <div class="alert alert-success" style=" position: fixed;   top: 0;
              left: 50%;
              transform: translateX(-50%);
              z-index: 1000;
              width:600px;
              text-align: center;">
        {{ session('success') }}
    </div>

@endif


    <a href="{{ url('mat/create/'.$group_id) }}" class="btn btn-success" style="font-size: 18px">Create_Material</a>
<table id="myTable" class="table table-success table-striped" >

    <thead>
    <tr style="text-align: center;">
        <th>ID</th>
        <th>Name Material</th>
        <th>File</th>
        <th>Link</th>
        <th>Show Link</th>
        <th>Show Pdf</th>
        <th>Download</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>

<tbody>
    @foreach ($matGroup as $corr)
     <tr>
        <td>{{ $corr->id }}</td>
        <td>{{ $corr->name }}</td> 
        <td>{{ $corr->file }}</td>
        <td>{{ $corr->link }}</td>
        
            <td>
                @if ($corr->link)
                    <a href="{{ $corr->link }}" target="_blank">
                        <i class="fas fa-link"></i>
                    </a>
                    @else
                    <span>
                        <i class="fas fa-link" style="color: gray;"></i> 
                    </span>
                @endif
            </td>
        <td>
               @if($corr->file && pathinfo($corr->file, PATHINFO_EXTENSION) === 'pdf')
                 <a href="{{route('material.show', $corr->id)}}">
                    <i class="fas fa-eye"></i>
                 </a>
               @else
                <span>
                   <i class="fas fa-eye" style="color: gray;"></i> 
                </span>
              @endif
            
        </td>
        <td>
            @if($corr->file)
                <a href="{{ Storage::url($corr->filePath) }}" download>
                    <i class="fas fa-download"></i>
                </a>
                @else
                <span>
                   <i class="fas fa-download" style="color: gray;"></i> 
                </span>
             
            @endif
        </td>
        <td>
            <a class="btn btn-primary" href="{{route('material.edit',$corr->id) }}">
                Edit
            </a>
        </td>
        <td>
            <form action="{{ route('material.destroy', $corr->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" id="btn-delete-co">
                    Delete
                </button>
            </form>
        </td>
    </tr>
    
    @endforeach
    <script>
        $(document).ready(function() {
           $("#btn-delete-co").click(function() {
              alert("Material Deleted successfully");
          });
        });
     </script>

</tbody>
<script>
    $(document).ready(function () {
  $('#myTable').DataTable({
    "paging": true,
    "ordering": true,
    "searching": true,
    "initComplete": function () {
        $('#myTable').css('width', '80%');
        $('#myTable_wrapper').css('margin-left', '100px');
    }
  });
});
</script>


</table>

@stop
