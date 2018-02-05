@if ($errors->all())
    <div class="alert alert-danger">
        <ul> 
            @foreach ($errors->messages() as $error)
                <li>{{ $error[0] }}</li>    
            @endforeach
        </ul>
    </div>
@endif
