@extends('spark::layouts.app')

@section('content')
<home :user="user" inline-template>
    <div class="container">
        <!-- Application Dashboard -->
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Map
                    </div>
                    <div class="panel-body">
                        @include('partials.map')
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach ($properties as $property)
                                <li class="list-group-item">
                                    <a href="{{ url('property/'.$property->id) }}">
                                        {{ $property->name }}
                                    </a>
                                </li>
                            @endforeach

                            {{ $properties->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>
@endsection
