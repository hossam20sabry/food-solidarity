@extends('admin.layout')

@section('content')
<div class="container my-4">
    <div class="row mb-4">
        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Total Donations</h5>
                    <p class="card-text red">{{$totalDonations}}</p>
                    </div>
                </div>
        </div>
        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Total Donations Matched</h5>
                    <p class="card-text red">{{$totalDonationsMatched}}</p>
                    </div>
                </div>
        </div>
        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Today Donations</h5>
                    <p class="card-text red">{{$totalDonationsDay}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Today Matched Donations</h5>
                    <p class="card-text red">{{$donationsDay}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Week Donations</h5>
                    <p class="card-text red">{{$totalDonationsWeek}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Week Donations</h5>
                    <p class="card-text red">{{$donationsWeek}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Month Donations</h5>
                    <p class="card-text red">{{$totalDonationsMonth}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Month Matched Donations</h5>
                    <p class="card-text red">{{$donationsMonth}}</p>
                </div>
            </div>
        </div>

        {{-- //complaints\\ --}}
        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Total Complaints unsolved</h5>
                    <p class="card-text red">{{$UnsolvedComplaints}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Total Complaints solved</h5>
                    <p class="card-text red">{{$solvedComplaints}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Complaints unsolved Today</h5>
                    <p class="card-text red">{{$UnsolvedComplaintsDay}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Complaints solved Today</h5>
                    <p class="card-text red">{{$solvedComplaintsDay}}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Complaints unsolved Week</h5>
                    <p class="card-text red">{{$UnsolvedComplaintsWeek}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Complaints solved Week</h5>
                    <p class="card-text red">{{$solvedComplaintsWeek}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Complaints unsolved Month</h5>
                    <p class="card-text red">{{$UnsolvedComplaintsMonth}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3  mb-3 mb-sm-3">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h5 class="card-title">Complaints solved Month</h5>
                    <p class="card-text red">{{$solvedComplaintsMonth}}</p>
                </div>
            </div>
        </div>

    </div>
    @if($topDonors->count() > 0)
    <div class="row">
        <h4 class="text-green border-bottom p-1">Top Donors</h4>
        <table class="table table-secondary">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Donations Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topDonors as $topDonor)
                <tr>
                    <td>{{$topDonor->name}}</td>
                    <td>{{$topDonor->email}}</td>
                    <td>
                        @php
                            $totalQuantity = 0;
                            foreach ($topDonor->donations as $donation) {
                                $totalQuantity += $donation->quantity;
                            }
                        @endphp
                        {{ $totalQuantity }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection