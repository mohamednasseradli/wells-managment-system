@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="text-center text-danger mb-3 p-2">
            {{ $error }}
            
        </div>
    @endforeach
@endif
@if (session("error"))
    <div class="text-center text-danger mb-3 p-2">
        {{session("error")}}
    </div>
@endif