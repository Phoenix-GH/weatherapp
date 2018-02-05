@extends('spark::layouts.app')

@section('content')
    <property :property="{{ $property }}"  inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Property Details
                        </div>
                        <div class="panel-body">

                            <h3>{{ $property->name }}</h3>
                            <div>{{ $property->address }}</div>
                            <div>{{ $property->address_2 }}</div>
                            <div>{{ $property->city }}</div>
                            <div>{{ $property->state }}</div>
                            <div>{{ $property->country }}</div>
                            <div>{{ $property->lat }}</div>
                            <div>{{ $property->long }}</div>
                            <div>
                                <form action="{{ url('property/'.$property->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger" type="submit">
                                        Delete Property
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Map
                        </div>
                        <div class="panel-body">
                            @include('partials.map',['size' => 400])
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Weather Events</div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <td></td>
                                <td>Event</td>
                                <td>Date</td>
                                <td>Properties Affected</td>
                                </thead>
                                <tbody>
                                {{-- @foreach ($property->events as $event) --}}
                                <tr v-for="event in events">
                                    <td>
                                    </td>
                                    <td>
                                        @{{ event.desc }}
                                    </td>
                                    <td>
                                        @{{ event.date }}
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                {{-- @include('property.partials.event', ['event' => $event]) --}}
                                {{-- @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <a href="#">View All</a>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
                            <h4>Sign up for updates on our launch!</h4>
                            <div href="signup" class="btn btn-primary">Sign up!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </property>
@stop
