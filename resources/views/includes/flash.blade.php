
@if ($message = Session::get('error'))
<div class="alert alert-danger">
    {{ $message }}
</div>
@endif
