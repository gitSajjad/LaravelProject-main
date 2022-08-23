@if(session('swal-error'))

<script>

$(document).ready(function(){
Swal.fire({
  title: 'خطا!!',
  text: '{{ session('swal-error') }}',
    icon : 'error',
    confirmButtonText: 'قبول',
})
})

</script>


@endif
