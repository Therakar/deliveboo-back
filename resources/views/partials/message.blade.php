@if(session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">{{ session('warning') }}</div>
@endif