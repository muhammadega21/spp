@extends('layouts.main')
@section('content')
    @push('style')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush
    @can('admin')
        @include('pages.dashboard.admin')
    @endcan
    @can('wali')
        @include('pages.dashboard.wali')
    @endcan
@endsection
