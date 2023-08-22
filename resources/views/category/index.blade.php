@extends('layouts.dashMaster')

@section('content')

@if(Session::has('message'))

 <script>
 Swal.fire({
  icon: 'success',
  title: "{{Session::get('message')}}",
  

})
</script>
@endif
<div class="row" style="min-height: 75vh;">
<div class="col-lg-8 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Category List</h4>
                  <div class="table-responsive">
                    <table class="table table-hover" id="category_list">
                      <thead>
                        <tr>
                          <th>Serial</th>
                          <th>Category</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($categories as $category)
                        <tr>
                          <td>{{$serial++}}</td>
                          <td>{{$category->category}}</td>
                          <td>
        <div class="d-flex">
             
            <a href="{{route('category.edit',$category->id)}}">
             <x-secondary-button style="font-weight:700;" class="flex-inline">
                
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
                &nbsp;Edit
            </x-secondary-button>
            </a>
            
          &nbsp;&nbsp;&nbsp;
         <form action="{{route('category.destroy',$category->id)}}" method="post">
            @csrf
            @method('delete')
         <x-secondary-button style="font-weight: 700;" type="submit" class="text-danger"  onclick="return confirm('Are you sure to delete this record!');" value="Delete X">
             Delete X
        </x-secondary-button>
         </form>
        </div>
    
    </td>
                          

                          <!-- <td><label class="badge badge-danger">Pending</label></td> -->
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
</div>


<script>
 $(function() {
   $('#category_list').DataTable();
 });
</script>
@endsection