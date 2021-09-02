<base href=" {{url('/admin')}}" />
<meta name="csrf-token" value="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" />
<link rel="stylesheet" href="{{asset('/css/custom.css')}}" />
<div id="app">
    
    <div>
        
        <form action="admin/media/uploads" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" accept="image/*" />
            <input type="submit" value="Submit">
        </form>
    </div>
    <media></media>
</div>

<script src="{{ asset('/js/app.js') }}"></script>