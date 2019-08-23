@extends('EndoCore::admin.layout.html')

@section('body')
    <div id="wrapper">
        @include('EndoCore::admin.layout.sidebar')

        <div id="page-wrapper" class="gray-bg">

            @include('EndoCore::admin.layout.navbar')

            <div class="row">
                <div class="backoffice-loader no-margin gray-bg" style="display: none;">
                    <div class="sk-spinner sk-spinner-double-bounce">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    @if (Session::has('flash_message'))
                        <div class="alert alert-success alert-dismissable">{{ session('flash_message') }}</div>
                    @elseif (isset($flash_message))
                        <div class="alert alert-{{ $flash_message['status'] }} alert-dismissable">{{ $flash_message['message'] }}</div>
                    @endif

                    <div class="row wrapper border-bottom white-bg page-heading">
                        <div class="col-lg-9">
                            <h2>@yield('page_header')</h2>
                            @include('EndoCore::admin.partials.breadcrumbs')
                        </div>
                    </div>

                    <div class="wrapper wrapper-content">
                        @yield('content')
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="footer">
                    <div class="pull-right">
                        {{--<span style="margin-right: 12px;">
                            @if (isset($dataDate))
                                Data from {{ $dataDate }}
                            @else
                                No data
                            @endif
                        </span>

                        <a class="text-info js-click" href="{{ request()->fullUrlWithQuery(['fresh' => 'yes']) }}">
                            <i class="fa fa-refresh"></i> Refresh
                        </a>--}}
                    </div>

                    <div>
                        <strong>Copyright</strong> <span onclick="window.open('http://6tems.com/', '_blank');">6tems</span> &copy; <?php echo date("Y"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop