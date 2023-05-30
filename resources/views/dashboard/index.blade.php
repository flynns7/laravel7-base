@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @can('isSuperadmin')
                    Saya Super Admin
                @elsecan('isMasterManager')
                    Saya Master Manager
                @else
                    Saya Tidak Punya Role
                @endcan
            </div>
        </div>
    </div>
@endsection
