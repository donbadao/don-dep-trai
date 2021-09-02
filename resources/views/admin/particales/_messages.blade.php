@if(Session::has('message'))
<div class="alert alert-{{ Session::get('type') }} alert-dismissible fade show mt-2" role="alert">
  <strong>{{ Session::get('message') }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif