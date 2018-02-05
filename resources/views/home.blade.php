@extends('spark::layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <section class="module-property-rating"><!-- Begin property rating -->
                    <!-- The "pXX" class ("p78" below) determines the fill percentage. -->
                    <div class="property-rating c100 p78 big">
                        <div class="info">
                            <span class="icon"></span>
                            <span class="percentage">91%</span>
                            <span class="label">of your properties are in good shape</span>
                        </div>

                        <div class="slice"><div class="bar"></div><div class="fill"></div></div>
                    </div>
                    <!-- End property rating -->
                </section>
            </div>

            <div class="col-sm-12 col-md-9">
                <section class="module-property-list panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">Weather Alerts - Events: 2 Unread</h4>
                    </div>
                    <div class="panel-body constrained" style="height: 200px;">
                        <table class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Weather</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Property Affected</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><img src="../../../assets/images/hail.png"/></td>
                                <td>1.5 inch hail</td>
                                <td>10/28/17</td>
                                <td>12:34:32 pm</td>
                                <td>11709 Wicker Ct, Louisville, KY 40299</td>
                            </tr>
                            <tr>
                                <td><img src="../../../assets/images/hail.png"/></td>
                                <td>1.5 inch hail</td>
                                <td>10/28/17</td>
                                <td>12:34:32 pm</td>
                                <td>11709 Wicker Ct, Louisville, KY 40299</td>
                            </tr>
                            <tr>
                                <td><img src="../../../assets/images/hail.png"/></td>
                                <td>1.5 inch hail</td>
                                <td>10/28/17</td>
                                <td>12:34:32 pm</td>
                                <td>11709 Wicker Ct, Louisville, KY 40299</td>
                            </tr>
                            <tr>
                                <td><img src="../../../assets/images/hail.png"/></td>
                                <td>1.5 inch hail</td>
                                <td>10/28/17</td>
                                <td>12:34:32 pm</td>
                                <td>11709 Wicker Ct, Louisville, KY 40299</td>
                            </tr>
                            <tr>
                                <td><img src="../../../assets/images/hail.png"/></td>
                                <td>1.5 inch hail</td>
                                <td>10/28/17</td>
                                <td>12:34:32 pm</td>
                                <td>11709 Wicker Ct, Louisville, KY 40299</td>
                            </tr>
                            <tr>
                                <td><img src="../../../assets/images/hail.png"/></td>
                                <td>1.5 inch hail</td>
                                <td>10/28/17</td>
                                <td>12:34:32 pm</td>
                                <td>11709 Wicker Ct, Louisville, KY 40299</td>
                            </tr>
                            <tr>
                                <td><img src="../../../assets/images/hail.png"/></td>
                                <td>1.5 inch hail</td>
                                <td>10/28/17</td>
                                <td>12:34:32 pm</td>
                                <td>11709 Wicker Ct, Louisville, KY 40299</td>
                            </tr>
                            <tr>
                                <td><img src="../../../assets/images/hail.png"/></td>
                                <td>1.5 inch hail</td>
                                <td>10/28/17</td>
                                <td>12:34:32 pm</td>
                                <td>11709 Wicker Ct, Louisville, KY 40299</td>
                            </tr>
                            <tr>
                                <td><img src="../../../assets/images/hail.png"/></td>
                                <td>1.5 inch hail</td>
                                <td>10/28/17</td>
                                <td>12:34:32 pm</td>
                                <td>11709 Wicker Ct, Louisville, KY 40299</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="panel-footer">
                        <a href="#">View all alerts</a>
                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <section class="module-property-list panel">
                    <div class="panel-heading">
                        <a href="#" class="pull-right">View as map</a>
                        <h4 class="panel-title">Properties: 12 of 56,008</h4>
                    </div>

                    <div class="panel-heading quick-filters">
                        <span class="filter-label">Quick filters</span>
                        <button class="btn btn-primary btn-affected selected">Affected by weather event</button>
                        <button class="btn btn-primary btn-maintenance">Possible maintenance needed</button>
                    </div>

                    <div class="panel-body constrained" data-height="265">
                        <div class="scroll-list">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Property Health</th>
                                    <th>Maintenance Needed?</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>11709 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>1189 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>109 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>109 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>109 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>109 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>109 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>109 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>109 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>109 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>109 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>109 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>109 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                <tr>
                                    <td><img src="../../../assets/images/hail.png"/></td>
                                    <td>109 Wicker Ct, Louisville, KY 40299</td>
                                    <td>OK</td>
                                    <td>Fair</td>
                                    <td>No</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="#">View all properties</a>
                    </div>
                </section>
            </div>
        </div>
    </div>

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
