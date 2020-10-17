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
            <li class="nav-item active">
                <a class="nav-link" href="/home">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Packages</p>
                </a>
            </li>
            <li class="nav-item">
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
        <a class="navbar-brand" href="/home">Packages</a>
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
            <div class="card-header ">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title">All Packages</h4>
                        <p class="card-category">List Of Packages</p>
                    </div>
                    <div class="col-md-2">
                        <a href="/package/create" class="btn btn-block btn-fill btn-primary">Create New</a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="dataTable" class="table table-hover table-striped">
                    <thead>
                        <th>Code</th>
                        <th width="25%">Title</th>
                        <th>Rate</th>
                        <th>Tag</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th class="text-center">Update Status</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </thead>
                    <tbody>
                        @foreach ($packages as $package)
                        <tr>
                            <td>{{ $package->code }}</td>
                            <td>{{ $package->title }}</td>
                            <td class="text-right">{{ number_format($package->rate, 2) }}</td>
                            <td class="text-center">
                                <span class="badge badge-primary badge-pill p-2">{{ ucwords($package->tag) }}</span>
                            </td>
                            <td class="statusType text-center">
                                @if ($package->status == 'active')
                                <span class="badge badge-success badge-pill p-2">Active</span>
                                @else
                                <span class="badge badge-danger badge-pill p-2">Inactive</span>
                                @endif
                            </td>
                            <td class="text-center">{{ date('d-m-Y (H:i)', strtotime($package->created_at)) }}</td>
                            <td>
                                @if ($package->status == 'inactive')
                                <a href="#" data-id="{{ $package->id }}"
                                    class="btn btn-fill btn-sm btn-block setActive">Set as Active</a>
                                @else
                                <a href="#" data-id="{{ $package->id }}"
                                    class="btn btn-fill btn-sm btn-block setInactive">Set as Inactive</a>
                                @endif
                            </td>
                            <td>
                                <a href="package/edit/{{ $package->id }}" class="btn btn-fill btn-sm btn-block">Edit</a>
                            </td>
                            <td>
                                <a href="/" class="btn btn-fill btn-sm btn-block"
                                    onclick="event.preventDefault(); if(confirm('Are you sure ?')) { document.getElementById('delete-package').submit(); }">Delete</a>
                                <form id="delete-package" action="/package/delete/{{ $package->id }}" method="POST"
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

@section('pageScript')
<script>
    $(document).ready(function () {
        $(document).on('click', '.setInactive', function () {
            const that = $(this);
            const id = that.data('id');
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({type: "put", url: `package/update/inactive/${id}`, dataType: "JSON", data: {_token: CSRF_TOKEN}})
            .done(function(data){
                that.closest('tr').find('.statusType')
                .html('<span class="badge badge-danger badge-pill p-2">Inactive</span>');
                that.closest('td')
                .html(`<a href="#" data-id="${id}" class="btn btn-fill btn-sm btn-block setActive">Set as Active</a>`);
            });
        });

        $(document).on('click', '.setActive', function () {
            const that = $(this);
            const id = that.data('id');
            const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({type: "put", url: `package/update/active/${id}`, dataType: "JSON", data: {_token: CSRF_TOKEN}})
            .done(function(data){
                that.closest('tr').find('.statusType')
                .html('<span class="badge badge-success badge-pill p-2">Active</span>');
                that.closest('td')
                .html(`<a href="#" data-id="${id}" class="btn btn-fill btn-sm btn-block setInactive">Set as Inactive</a>`);
            });
        });
    });
</script>
@endsection
