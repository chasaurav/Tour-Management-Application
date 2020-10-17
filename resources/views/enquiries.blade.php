@extends('layouts.app')

@section('sidebar')
<div class="sidebar" data-image="{{ asset('assets/img/sidebar-5.jpg') }}" data-color="green">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ url('/') }}" class="simple-text">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="/home">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Packages</p>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/enquiries">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Enquiries</p>
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection

@section('navbar')
<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="/enquiries">Enquiries</a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            aria-controls="navigation-index" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="nc-icon nc-palette"></i>
                        <span class="d-lg-none">Dashboard</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }}
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card strpied-tabled-with-hover">
            <h4 class="card-header">All Enquries <br> <small>List of Enquries</small></h4>
            <div class="card-body table-responsive">
                <table id="dataTable" class="table table-hover table-striped">
                    <thead>
                        <th class="text-center">Name</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Submitted At</th>
                        <th class="text-center">Delete</th>
                    </thead>
                    <tbody>
                        @foreach ($enquiries as $enquiry)
                        <tr>
                            <td>{{ $enquiry->name }}</td>
                            <td>{{ $enquiry->phone }}</td>
                            <td>{{ $enquiry->email }}</td>
                            <td>{{ $enquiry->status }}</td>
                            <td>{{ date('d-m-Y h:i a', strtotime($enquiry->created_at)) }}</td>
                            <td>
                                <a href="/" class="btn btn-fill btn-sm btn-block"
                                    onclick="event.preventDefault(); if(confirm('Are you sure ?')) { document.getElementById('delete-enquiry').submit();}">Delete</a>
                                <form id="delete-enquiry" action="/deleteEnquiry/{{$enquiry->id}}" method="POST"
                                    style="display: none;">
                                    @csrf @method('Delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
