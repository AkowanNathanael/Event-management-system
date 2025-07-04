@props(["message","alert"=>"alert-success"])
<div class="alert {{ $alert }} alert-dismissible" role="alert">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
