@extends('layouts.dashMaster')

@if(Session::has('message'))

 <script>
 Swal.fire({
  icon: 'success',
  title: "{{Session::get('message')}}",
  

})
</script>
@endif


@section('content')

<h3>Approved Form</h3>

@endsection