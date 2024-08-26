@extends('layouts.Clubmajor', ['page' => __('Recommending Event'), 'pageSlug' => 'cevent'])

@section('content')
    <div class="mb-2">
        <h2 class="font-weight-semibold text-white mb-0">List of Top 5 Events Based on Ratings of 3 and Above
            <span class="info-icon" data-toggle="tooltip" data-placement="right" title="This list shows the top 5 events that have received ratings of 3 and above, collecting average rating and total participants, in ascending order of the average rating.">
                &#9432;
            </span>
        </h2>
    </div>
    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card border shadow-xs mb-0"> <!-- mb-4 -->
                    <div class="card-header border-bottom pb-0">
                        <div class="pull-left"> <!-- d-sm-flex align-items-center -->
                            <div class>
                                <h3 class="font-weight-semibold text-white mb-0">Understanding Blockchain Ecosystem</h3> <!-- font-weight-semibold text-lg mb-0 -->
                                <p class="text-sm">24 December 2023</p>
                            </div>
                        </div>
                        <div class="pull-right"> <!-- d-sm-flex align-items-center -->
                            <div class>
                                <h3 class="font-weight-semibold text-white mb-0">NETCENTRIC</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <a class="btn btn-success text-white px-3 mb-0" href="#">Outcome</a> <!-- <label class="btn btn-success text-white px-3 mb-0" for="btnradiotable1">Outcome</label> -->
                                <a class="btn btn-warning text-white px-3 mb-0" href="#">Participant</a> <!-- <label class="btn text-white px-3 mb-0" for="btnradiotable2">Participant</label> -->
                            </div>
                        </div>
                        <div class="px-3 pull-right"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                            <div class>
                                <h4 class="font-weight-semibold text-white mt-4">Status: Close</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card border shadow-xs mb-0"> <!-- mb-4 -->
                    <div class="card-header border-bottom pb-0">
                        <div class="pull-left"> <!-- d-sm-flex align-items-center -->
                            <div class>
                                <h3 class="font-weight-semibold text-white mb-0">IoT with Netcentric. How?</h3> <!-- font-weight-semibold text-lg mb-0 -->
                                <p class="text-sm">24 December 2023</p>
                            </div>
                        </div>
                        <div class="pull-right"> <!-- d-sm-flex align-items-center -->
                            <div class>
                                <h3 class="font-weight-semibold text-white mb-0">NETCENTRIC</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <a class="btn btn-success text-white px-3 mb-0" href="#">Outcome</a> <!-- <label class="btn btn-success text-white px-3 mb-0" for="btnradiotable1">Outcome</label> -->
                                <a class="btn btn-warning text-white px-3 mb-0" href="#">Participant</a> <!-- <label class="btn text-white px-3 mb-0" for="btnradiotable2">Participant</label> -->
                            </div>
                        </div>
                        <div class="px-3 pull-right"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                            <div class>
                                <h4 class="font-weight-semibold text-white mt-4">Status: Close</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card border shadow-xs mb-0"> <!-- mb-4 -->
                    <div class="card-header border-bottom pb-0">
                        <div class="pull-left"> <!-- d-sm-flex align-items-center -->
                            <div class>
                                <h3 class="font-weight-semibold text-white mb-0">Sports Gathering for Netcentric Students</h3> <!-- font-weight-semibold text-lg mb-0 -->
                                <p class="text-sm">24 December 2023</p>
                            </div>
                        </div>
                        <div class="pull-right"> <!-- d-sm-flex align-items-center -->
                            <div class>
                                <h3 class="font-weight-semibold text-white mb-0">NETCENTRIC</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <a class="btn btn-success text-white px-3 mb-0" href="#">Outcome</a> <!-- <label class="btn btn-success text-white px-3 mb-0" for="btnradiotable1">Outcome</label> -->
                                <a class="btn btn-warning text-white px-3 mb-0" href="#">Participant</a> <!-- <label class="btn text-white px-3 mb-0" for="btnradiotable2">Participant</label> -->
                            </div>
                        </div>
                        <div class="px-3 pull-right"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                            <div class>
                                <h4 class="font-weight-semibold text-white mt-4">Status: Close</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card border shadow-xs mb-0"> <!-- mb-4 -->
                    <div class="card-header border-bottom pb-0">
                        <div class="pull-left"> <!-- d-sm-flex align-items-center -->
                            <div class>
                                <h3 class="font-weight-semibold text-white mb-0">Futsal Tournament</h3> <!-- font-weight-semibold text-lg mb-0 -->
                                <p class="text-sm">24 December 2023</p>
                            </div>
                        </div>
                        <div class="pull-right"> <!-- d-sm-flex align-items-center -->
                            <div class>
                                <h3 class="font-weight-semibold text-white mb-0">NETCENTRIC</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 py-0">
                        <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <a class="btn btn-success text-white px-3 mb-0" href="#">Outcome</a> <!-- <label class="btn btn-success text-white px-3 mb-0" for="btnradiotable1">Outcome</label> -->
                                <a class="btn btn-warning text-white px-3 mb-0" href="#">Participant</a> <!-- <label class="btn text-white px-3 mb-0" for="btnradiotable2">Participant</label> -->
                            </div>
                        </div>
                        <div class="px-3 pull-right"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                            <div class>
                                <h4 class="font-weight-semibold text-white mt-4">Status: Close</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    @php
    // Sort events based on their scores in descending order
    $sortedEvents = $events->sortByDesc(function ($event) use ($currentEventMeanRating) {
        return $currentEventMeanRating[$event->id];
    });
    @endphp

    @foreach ($sortedEvents as $event)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card border shadow-xs mb-0"> <!-- mb-4 -->
                        <div class="card-header border-bottom pb-0">
                            <div class="pull-left"> <!-- d-sm-flex align-items-center -->
                                <div class>
                                    <h3 class="font-weight-semibold text-white mb-0">{{$event->event_title}}</h3> <!-- font-weight-semibold text-lg mb-0 --> <!-- / {{$event->participant->count()}} / {{ htmlspecialchars($currentEventMeanRating[$event->id]) }} / {{$event->id}} -->
                                    <p class="text-sm">{{$event->event_start_date}}</p>
                                </div>
                            </div>
                            <div class="pull-right"> <!-- d-sm-flex align-items-center -->
                                <div class>
                                    <h3 class="font-weight-semibold text-white mb-0">{{$event->club->user->name}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <a class="btn btn-info text-white px-3 mb-0" href="#">Average Rating : {{ htmlspecialchars(number_format($currentEventMeanRating[$event->id], 2)) }}</a> <!-- <label class="btn btn-success text-white px-3 mb-0" for="btnradiotable1">Outcome</label> -->
                                    <a class="btn btn-warning text-white px-3 mb-0" href="#">Participant : {{$event->participant->count()}}</a> <!-- <label class="btn text-white px-3 mb-0" for="btnradiotable2">Participant</label> -->
                                </div>
                            </div>
                            <div class="px-3 pull-right"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                                <div class>
                                    <h4 class="font-weight-semibold text-white mt-4">Status: Close</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- <div class="mb-2">
        <h2 class="font-weight-semibold text-white mb-0">Graph of Event Average Rating</h2>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="lineChartExample" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="mb-2">
        <h2 class="font-weight-semibold text-white mb-0">Graph of Event Total Participant with Rating</h2>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="lineChartParticipant" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="mb-2">
        <h2 class="font-weight-semibold text-white mb-0">Graph of the Number of Participants Submitting Ratings of 3 and Above for the Top 5 Events
            <span class="info-icon" data-toggle="tooltip" data-placement="right" title="This graph shows list of the top 5 events that have received ratings of 3 and above, collecting total students submitting rating of 3 and above only">
                &#9432;
            </span>
        </h2>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="lineChart3RatingAboveParticipant" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-2">
        <h2 class="font-weight-semibold text-white mb-0">Graph of the Top 5 Event Categories Selected by Students
            <span class="info-icon" data-toggle="tooltip" data-placement="right" title="This graph shows list of the top 5 events categories preferred by students.">
                &#9432;
            </span>
        </h2>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="lineChartStudentEventCategory" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
    // Sort event categories based on their scores in descending order
    $sortedEventCategories = $recommendedCategories->sortByDesc(function ($recommendedCategory) use ($topEventCategoriesList) {
        return $topEventCategoriesList[$recommendedCategory->id];
    });
    @endphp

    <div class="mb-2">
        <h2 class="font-weight-semibold text-white mb-0">List of the Top 5 Event Categories Using Collaborative Filtering
            <span class="info-icon" data-toggle="tooltip" data-placement="right" title="This list shows the top 5 event categories based on a calculation that combines the preferences of students with the average ratings of 3 and above for each event category.">
                &#9432;
            </span>
        </h2>
    </div>
    @foreach ($sortedEventCategories as $eventCategory)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card border shadow-xs mb-0"> <!-- mb-4 -->
                        <div class="card-body px-0 py-0">
                            <div class="py-3 px-3 pull-left"> <!-- border-bottom py-3 px-3 d-sm-flex align-items-center -->
                                <div class>
                                    <h3 class="font-weight-semibold text-white mb-0">{{$eventCategory->eventcategory_name}}</h3> <!-- font-weight-semibold text-lg mb-0 -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        // General configuration for the charts with Line gradientStroke
        gradientChartOptionsConfiguration =  {
        maintainAspectRatio: false,
        legend: {
                display: true
        },

        tooltips: {
            backgroundColor: '#fff',
            titleFontColor: '#333',
            bodyFontColor: '#666',
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
        },
        responsive: true,
        scales:{
            yAxes: [{
            barPercentage: 1.6,
                gridLines: {
                    drawBorder: false,
                    color: 'rgba(29,140,248,0.0)',
                    zeroLineColor: "transparent",
                },
                ticks: {
                    suggestedMin: 0,
                    suggestedMax: 30,
                    padding: 20,
                    fontColor: "#fff"
                }
                }],

            xAxes: [{
            barPercentage: 1.6,
                gridLines: {
                    drawBorder: false,
                    color: 'rgba(220,53,69,0.1)',
                    zeroLineColor: "transparent",
                },
                ticks: {
                    display: false, // Hide the x-axis labels
                    padding: 20,
                    fontColor: "#9a9a9a"
                }
                }]
            }
        };

        // document.addEventListener('DOMContentLoaded', function() {

        //     var ctx = document.getElementById("lineChartExample").getContext("2d");

        //     var gradientStroke = ctx.createLinearGradient(0,230,0,50);

        //     gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        //     gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        //     gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

        //     var labels = @json($eventLabels);
        //     var ratings = @json($eventRatings);

        //     var data = {
        //     labels: labels, // ['JAN','FEB','MAR','APR','MAY']
        //     datasets: [{
        //         label: "Data",
        //         fill: true,
        //         backgroundColor: gradientStroke,
        //         borderColor: '#d048b6',
        //         borderWidth: 2,
        //         borderDash: [],
        //         borderDashOffset: 0.0,
        //         pointBackgroundColor: '#d048b6',
        //         pointBorderColor:'rgba(255,255,255,0)',
        //         pointHoverBackgroundColor: '#d048b6',
        //         pointBorderWidth: 20,
        //         pointHoverRadius: 4,
        //         pointHoverBorderWidth: 15,
        //         pointRadius: 4,
        //         data: ratings, // [ 60, 110, 70, 100, 75]
        //     }]
        //     };

        //     var myChart = new Chart(ctx, {
        //     type: 'line',
        //     data: data,
        //     options: gradientChartOptionsConfiguration
        //     });
        // });

        // document.addEventListener('DOMContentLoaded', function() {

        // var ctx = document.getElementById("lineChartParticipant").getContext("2d");

        // var gradientStroke = ctx.createLinearGradient(0,230,0,50);

        // gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        // gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        // gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

        // var labels = @json($eventLabels);
        // var participants = @json($eventParticipants);

        // var data = {
        // labels: labels,
        // datasets: [{
        //     label: "Data",
        //     fill: true,
        //     backgroundColor: gradientStroke,
        //     borderColor: '#d048b6',
        //     borderWidth: 2,
        //     borderDash: [],
        //     borderDashOffset: 0.0,
        //     pointBackgroundColor: '#d048b6',
        //     pointBorderColor:'rgba(255,255,255,0)',
        //     pointHoverBackgroundColor: '#d048b6',
        //     pointBorderWidth: 20,
        //     pointHoverRadius: 4,
        //     pointHoverBorderWidth: 15,
        //     pointRadius: 4,
        //     data: participants, //[ 120, 60, 20, 130, 10 ]
        // }]
        // };

        // var myChart = new Chart(ctx, {
        // type: 'line',
        // data: data,
        // options: gradientChartOptionsConfiguration
        // });
        // });

        document.addEventListener('DOMContentLoaded', function() {

        var ctx = document.getElementById("lineChart3RatingAboveParticipant").getContext("2d");

        var gradientStroke = ctx.createLinearGradient(0,230,0,50);

        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

        var labels = @json($eventLabels);
        var participants3Above = @json($event3RatingAboveParticipants);

        var data = {
        labels: labels,
        datasets: [{
            label: "Data",
            fill: true,
            backgroundColor: gradientStroke,
            borderColor: '#d048b6',
            borderWidth: 2,
            borderDash: [],
            borderDashOffset: 0.0,
            pointBackgroundColor: '#d048b6',
            pointBorderColor:'rgba(255,255,255,0)',
            pointHoverBackgroundColor: '#d048b6',
            pointBorderWidth: 20,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 15,
            pointRadius: 4,
            data: participants3Above, // [ 90, 35, 20, 112, 2]
        }]
        };

        var myChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: gradientChartOptionsConfiguration
        });
        });

        document.addEventListener('DOMContentLoaded', function() {

        var ctx = document.getElementById("lineChartStudentEventCategory").getContext("2d");

        var gradientStroke = ctx.createLinearGradient(0,230,0,50);

        gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
        gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors

        var labels = @json($eventCategoryLabel);
        var students = @json($eventCategoryCount);

        var data = {
        labels: labels,
        datasets: [{
            label: "Data",
            fill: true,
            backgroundColor: gradientStroke,
            borderColor: '#d048b6',
            borderWidth: 2,
            borderDash: [],
            borderDashOffset: 0.0,
            pointBackgroundColor: '#d048b6',
            pointBorderColor:'rgba(255,255,255,0)',
            pointHoverBackgroundColor: '#d048b6',
            pointBorderWidth: 20,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 15,
            pointRadius: 4,
            data: students, //[ 120, 60, 20, 130, 10 ]
        }]
        };

        var myChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: gradientChartOptionsConfiguration
        });
        });
    </script>
@endsection
