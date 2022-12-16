@extends('layouts.blank')

@section('js')
<script src="{{ asset('scadavis/cdn/snap.svg-min.js') }}"></script>
{{-- <script src="{{ asset('scadavis/cdn/jquery-3.6.1.min.js') }}"></script> --}}
<script src="{{ asset('scadavis/cdn/d3.v7.min.js') }}"></script>
<script src="{{ asset('scadavis/cdn/vega.min-5.22.1.js') }}"></script>
<script src="{{ asset('scadavis/cdn/vega-lite.min-5.5.0.js') }}"></script>
<script src="{{ asset('scadavis/cdn/chroma.min.js') }}"></script>
<script src="{{ asset('scadavis/config_viewers_default.js') }}"></script>
<script src="{{ asset('scadavis/websage.js') }}"></script>
<script src="{{ asset('scadavis/vega_websage.js') }}"></script>
<script src="{{ asset('scadavis/getjsondata.js') }}"></script>

@endsection

@section('content')
<script>
    function init() {
        let el = document.getElementById('svg-obj')
        let cn = document.getElementById('svgdiv')
        const xhr = new XMLHttpRequest()
        xhr.open('GET', el.src) // here you point to the SVG synoptic display file
        xhr.onload = function () {
            if (xhr.status === 200) {
               let svgObj =  xhr.responseText // buffers the result for later use (this can save some time)
               cn.innerHTML = svgObj
               WebSAGE.init()
            }
        }
        xhr.send()
        console.log(WebSAGE)
    }
</script>
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<section class="content">
    <div id="DIV_STATUS" style="text-align:right;">
        <span
            id="SP_STATUS"
            style="font-family:tahoma,courier;font-size:10pt;font-weight:bold;color:white;"
            >&nbsp;</span
        >
    </div>
    <div id="svgdiv">
        <img src="/svg/sample.svg" onload="init()" id="svg-obj" />
    </div>
</section>
@endsection
