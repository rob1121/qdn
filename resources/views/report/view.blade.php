@extends('layouts.app')
@section('external-style')
<link rel="stylesheet" href="/vendor/css/bootstrap-datepicker.css">
@stop
@section('style')
<style>
.t {
border-bottom: 1px solid grey;
}

.panel {
margin-top:0px;
margin-bottom:-1px;
border-radius: 0px;
}

.bold {
font-weight: bold;
text-align:right;
}
panel-body {
padding:0px;
}

#cause_of_defect_description,
#containment_action_textarea,
#corrective_action_textarea,
#preventive_action_textarea {
width: 100%;
}

.panel .panel-heading {
border-radius: 0px;
background-color:#800000;
color:#fff;
}

#submit-button {
margin: 25px 0px 50px 0px;
}

.form-control[disabled],
.form-control[readonly],
fieldset[disabled] .form-control {
    background-color: #fff;
}

input.form-control:focus {
    box-shadow: none;
}

.hide-file-uploader {
    display: none;
}

</style>
@stop
@section('content')
@include('errors.validationErrors')
<!-- HEADING -->
<center><H1 style='color:#800000'>QUALITY DEVIATION NOTICE</H1></center>
<!-- START -->
<div class="container" style='font-size:12px;padding:0px'>
    <!-- PRODUCT DESCRIPTION/ PROBLEM DETAILS -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">PRODUCT DESCRIPTION/ PROBLEM DETAILS</h3>
        </div>
        <div class="panel-body">
            <!-- FIRST COLUMN -->
            <div class="col-lg-4 col-md-3 col-sm-6 text-left">
                <!-- CUSTOMER -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Customer:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5">
                        <p class="t"> {{ $qdn->customer }} </p>
                    </div>
                </div>
                <!-- PACKAGE TYPE -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Package Type:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5"><p class="t">{{ $qdn->package_type }}</p></div>
                </div>
                <!-- DEVICE NAME -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Device Name:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5"><p class="t">{{ $qdn->device_name }}</p></div>
                </div>
                <!-- LOT ID NUMBER -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Lot ID No.:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5"><p class="t">{{ $qdn->lot_id_number }}</p></div>
                </div>
                <!-- LOT QUANTITY -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Lot Quantity:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5"><p class="t">{{ $qdn->lot_quantity }}</p></div>
                </div>
            </div>
            <!-- SECOND COLUMN -->
            <div class="col-lg-4 col-md-3 col-sm-6 text-left">
                <!-- JOB ORDER NUMBER -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Job Order No.:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5"><p class="t">{{ $qdn->job_order_number }}</p></div>
                </div>
                <!-- MACHINE -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Machine:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5"><p class="t">{{ $qdn->machine }}</p></div>
                </div>
                <!-- STATION -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Station:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5"><p class="t">{{ $qdn->station }}</p></div>
                </div>
                <!-- MAJOR -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Major:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 text-left"><?=$qdn->major == "major" ? '[x]' : '[&nbsp;&nbsp;]';?></div>
                </div>
                <!-- MINOR -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Minor:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 text-left"><?=$qdn->major != "major" ? '[x]' : '[  ]';?></div>
                </div>
            </div>
            <!-- THIRD COLUMN -->
            <div class="col-lg-4 col-md-6 col-sm-6 text-left">
                <!-- QDN NO -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">QDN No.:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5"><p class="t" style='color:Red;font-weight:bold'>{{ $qdn->control_id }}</p></div>
                </div>
                <!-- TEAM RESPONSIBLE -->
                <div class="row">
                    <div class ="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Team Responsible:</div>
                    <div class ="col-lg-6 col-md-6 col-sm-6 col-xs-5">
                        <p class="t">
                            {{
                                implode("<br>",array_flatten(
                                $qdn->involvePerson()
                                    ->select('department')
                                    ->get()
                                    ->toArray())
                                )
                            }}
                        </p>
                    </div>
                </div>
                <!-- ISSUED BY -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Issued By:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5">
                        <p class="t">
                            {{ $qdn->involvePerson()->first()->originator_name }}
                        </p>
                    </div>
                </div>
                <!-- ISSUED TO -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Issued To:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5">
                        <p class="t">
                            {{
                                implode("<br>",array_flatten(
                                $qdn->involvePerson()
                                    ->select('receiver_name')
                                    ->get()
                                    ->toArray())
                                )
                            }}
                        </p>
                    </div>
                </div>
                <!-- DATE AND TIME -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 bold">Date and Time:</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5">
                        <p class="t">
                            {{ Carbon::parse($qdn->created_at) }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="container text-center col-lg-12 col-sm-12">
                <br/><br/>
                <?=
                $qdn->problem_description == ""
                    ? "<br/><br/>"
                    : $qdn->problem_description . "<br/><br/>";
                ?>
            </div>
        </div>
    </div>
    <!-- CONTAINEMENT ACTION WHO -->
    <!-- START OF FORM -->
    <form method='POST' enctype="multipart/form-data" action=''>
        @include('report.partials._section1')
        <div class="text-right container">
            <button
                type    ='submit'
                name    ='submit-button'
                id    ='submit-button'
                onclick ="return confirm('Are You Sure You Want To Submit?')"
                class   ="btn btn-default btn-lg"
            >
                <span class="fa fa-save"></span> UPDATE
            </button>
        </div>
    </form>
</div>
@endsection
@section('script')
<script src="/vendor/js/bootstrap-datepicker.js"></script>

<script>
$(function(){
    $('#containment-action-taken').datepicker()
        .on('change', function(){
            $('#containment-action-taken').datepicker('hide');
        });
    $('#corrrective-action-taken').datepicker()
        .on('change', function(){
            $('#corrrective-action-taken').datepicker('hide');
        });
    $('#preventive-action-taken').datepicker()
        .on('change', function(){
            $('#preventive-action-taken').datepicker('hide');
        });

$('span#upload-btn').on('click',function(){
    $(this).siblings('.hide-file-uploader').children('input#upload-file').click();
});

$('input#upload-file').on('change', function(){
    var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
    $(this).parent().siblings('span#upload-btn').text(filename)
    .append(" <i class='fa fa-pencil'></i>");

});
});
</script>
@stop