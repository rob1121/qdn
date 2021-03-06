<?php

$count = 0;
?>
        <!DOCTYPE html>
<html>
<head>
    <TITLE>QDN</TITLE>
    <style>
        .logo {
            background-color: #800;
            color: #fff;
            font-weight: bold;
            text-align: center;
            margin: auto auto 10px auto;
            width: 40%;
        }

        table#frame {
            width: 100%;
            font-size: 10px;
        }

        table#frame,
        #frame th,
        #frame td {
            border-collapse: collapse;
            border: 1px solid #000;
            vertical-align: bottom;
        }

        #frame table {
            border-collapse: collapse;
            width: 100%;
        }

        #frame table,
        #frame table th,
        #frame table td {
            border: 0px;
        }

        #frame .label {
            width: 40%;
            text-align: right;
            font-weight: bold;
        }

        #frame .field {
            border-bottom: 1px solid black;
            width: 60%;
            text-align: left;
        }

        #frame td.sec1-col-1,
        #frame td.sec1-col-2,
        #frame td.sec1-col-3,
        #frame td.title,
        #frame td.comment,
        #frame td {
            border: 0px;
        }

        #frame td {
            border-bottom: 1px solid #000;
        }

        #frame .title {
            border-top: 1px solid black;
            font-weight: bold;
            color: #800;
            padding-bottom: 8px;
        }

        .sec1-col-1 {
            width: 37%;
        }

        .sec1-col-2 {
            width: 25%;
        }

        .sec1-col-3 {
            width: 38%;
        }

        .sec1-con-s,
        .sec1-con-m {
            height: 100px;
            text-align: center;
        }

        .s2,
        .s3 {
            padding-left: 12px;
            height: 50px;
        }

        #frame .comment {
            border-bottom: 1px solid black;
            padding: 0px 32px 0px 32px;
            vertical-align: top;
            text-align: center;
            height: 50px;
        }

        #frame #s2,
        #frame #s3 {
            border: 0px;
        }

        .s4 {
            height: 100px;
            overflow: hidden;
        }

        .approval-by,
        .verified-by {
            height: 80px;
            overflow: hidden;
        }

        #frame .s4 table tr td {
            text-align: center;
        }

        #frame .s4 table tr td.what {
            text-align: left;
            padding: 5px;
            padding-top: 12px;
        }

        #frame .s4 table tr td.who,
        #frame .s4 table tr td.when {
            padding: 5px;
            padding-top: 12px;
        }

        #frame td#comp-name {
            border: 0px;
            text-align: left;
        }

        #frame td#rev {
            border: 0px;
            text-align: right;
        }

        #signature {
            text-align: center;
            padding-top: 40px;
            font-weight: bold;
        }

        #signature-label {
            border-top: 1px solid black;
            margin: 0px 10px 0px 10px;
            font-weight: bold;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
@foreach ($qdn->involvePerson()->get() as $name)

    @if ($count != 0)
        <div class="page-break"></div>
    @endif

    @php
        $count += 1;
    @endphp

    <h3 class="logo">{{ Str::upper('quality deviation notice') }}</h3>
    <table id="frame">
        <tr>
            <td colspan="3" class="title">
                {{
                Str::upper('PRODUCT DESCRIPTION/ PROBLEM DETAILS:')
                }}
            </td>
        </tr>
        <tr>
            <td class="sec1-col-1">
                <div class="sec1-con-m">
                    <table>
                        <tr>
                            <td class="label">Customer:</td>
                            <td class="field">{{ Str::upper($qdn->customer) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Package Type:</td>
                            <td class="field">{{ Str::upper($qdn->package_type) }}
                        </tr>
                        <tr>
                            <td class="label">Device Name:</td>
                            <td class="field">{{ Str::upper($qdn->device_name) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Lot ID No.:</td>
                            <td class="field">{{ Str::upper($qdn->lot_id_number) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Lot Quantity.:</td>
                            <td class="field">{{ Str::upper($qdn->lot_quantity) }}</td>
                        </tr>
                    </table>
                </div>
            </td>
            <td class="sec1-col-2">
                <div class="sec1-con-s">
                    <table>
                        <tr>
                            <td class="label">Job Order No.:</td>
                            <td class="field">{{ Str::upper($qdn->job_order_number) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Machine:</td>
                            <td class="field">{{ Str::upper($qdn->machine) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Station:</td>
                            <td class="field">{{ Str::upper($qdn->station) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Major:</td>
                            <td>{{ check($qdn, "major") }}</td>
                        </tr>
                        <tr>
                            <td class="label">Minor:</td>
                            <td>{{ check($qdn, "minor") }}</td>
                        </tr>
                    </table>
                </div>
            </td>
            <td class="sec1-col-3">
                <div class="sec1-con-m">
                    <table style="padding-right:10px">
                        <tr>
                            <td class="label">QDN No.:</td>
                            <td
                                    class="field"
                                    style='color:#800;font-weight:bold'
                            >{{ $qdn->control_id }}
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Team Responsible:</td>
                            <td class="field">
                                {{ Str::upper($name->station) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Issued By:</td>
                            <td class="field">
                                {{ Str::title($name->originator_name) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Issued To:</td>
                            <td class="field">{{ Str::title($name->receiver_name) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Date and Time:</td>
                            <td class="field">{{ $qdn->created_at }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="comment">{{ $qdn->problem_description }}</td>
        </tr>
        <tr>
            <td class="title" colspan='3'>
                {{ Str::upper('DISPOSITION:') }}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="s2">
                    {{-- SECOND SECTION --}}
                    <table>
                        <tr>
                            @foreach ($disposition_check as $dispo)
                                <td>
                                    {{
                                    $qdn->disposition == $dispo
                                    ? '[&nbsp;x&nbsp;]'
                                    : '[&nbsp;&nbsp;&nbsp;&nbsp;]'
                                    }}
                                    <strong>{{ Str::upper($dispo) }}</strong>
                                </td>
                            @endforeach
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan='3' class="title">
                {{ Str::upper('CAUSE OF DEFECTS/ FAILURE:') }}
            </td>
        </tr>
        {{-- THIRD SECTION --}}
        <tr>
            <td colspan="3" id="s3">
                <div class="s3">
                    <table>
                        <tr>
                            @foreach ($cod_check as $cod)
                                <td>
                                    {{
                                    $qdn->CauseOfDefect->cause_of_defect == $cod
                                    ? '[&nbsp;x&nbsp;]'
                                    : '[&nbsp;&nbsp;&nbsp;&nbsp;]'
                                    }}
                                    <strong>{{ Str::upper($cod) }}</strong>
                                </td>
                            @endforeach
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td class="comment" colspan="3">
                {{ $qdn->CauseOfDefect->cause_of_defect_description }}
            </td>
        </tr>
        <tr>
            <td class="title" colspan='3'>
                {{ Str::upper('containment action:') }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="s4">
                    <table>
                        <tr>
                            <td><strong>WHAT</strong></td>
                        </tr>
                        <tr>
                            <td class="what">{{ $qdn->containmentAction->what }}</td>
                        </tr>
                    </table>
                </div>
            </td>
            <td>
                <div class="s4">
                    <table>
                        <tr>
                            <td style="width:50%"><strong>WHO</strong></td>
                            <td style="width:50%"><strong>WHEN</strong></td>
                        </tr>
                        <tr>
                            <td class="who">{{ $qdn->containmentAction->who }}</td>
                            <td class="when">{{
                                    Carbon::parse($qdn->containmentAction->updated_at)
                                    ->format('m/d/Y')
                                }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td class="title" colspan='3'>
                {{ Str::upper('corrective action:') }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="s4">
                    <table>
                        <tr>
                            <td><strong>WHAT</strong></td>
                        </tr>
                        <tr>
                            <td class="what">{{ $qdn->correctiveAction->what }}</td>
                        </tr>
                    </table>
                </div>
            </td>
            <td>
                <div class="s4">
                    <table>
                        <tr>
                            <td style="width:50%"><strong>WHO</strong></td>
                            <td style="width:50%"><strong>WHEN</strong></td>
                        </tr>
                        <tr>
                            <td class="who">{{ $qdn->correctiveAction->who }}</td>
                            <td class="when">{{
                                    Carbon::parse($qdn->correctiveAction->updated_at)
                                    ->format('m/d/Y')
                                }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td class="title" colspan='3'>
                {{ Str::upper('preventive action:') }}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="s4">
                    <table>
                        <tr>
                            <td><strong>WHAT</strong></td>
                        </tr>
                        <tr>
                            <td class="what">{{ $qdn->preventiveAction->what }}</td>
                        </tr>
                    </table>
                </div>
            </td>
            <td>
                <div class="s4">
                    <table>
                        <tr>
                            <td style="width:50%"><strong>WHO</strong></td>
                            <td style="width:50%"><strong>WHEN</strong></td>
                        </tr>
                        <tr>
                            <td class="who">{{ $qdn->preventiveAction->who }}</td>
                            <td class="when">{{
                                Carbon::parse($qdn->preventiveAction->updated_at)
                                ->format('m/d/Y')
                            }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan='3' class="title">
                {{ Str::upper('approvals:') }}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="approval-by">
                    <table>
                        <tr>
                            <td id="signature">{{ Str::upper($qdn->closure->production) }}</td>
                            <td id="signature">{{ Str::upper($qdn->closure->process_engineering) }}</td>
                            <td id="signature">{{ Str::upper($qdn->closure->quality_assurance) }}</td>
                            <td id="signature">{{ Str::upper($qdn->closure->other_department) }}</td>
                        </tr>
                        <tr>
                            @foreach ($approvers as $approver)
                                <td style="text-align: center;">
                                    <div id="signature-label">{{ Str::upper($approver) }}</div>
                                </td>
                            @endforeach
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan='3' class="title">
                {{ Str::upper('verified by:') }}
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <div class="verified-by">
                    <table>
                        <tr>
                            <td style="text-align: left;padding-left:32px;width:85%"><strong>CONTAINMENT ACTION/S
                                    TAKEN?</strong></td>
                            <td style="text-align: left;width:5%"><strong>[&nbsp;x&nbsp;] YES</strong></td>
                            <td style="text-align: left;width:5%"><strong>[&nbsp;x&nbsp;] NO</strong></td>
                            <td style="text-align: left;width:5%"><strong>[&nbsp;x&nbsp;] NO</strong></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;padding-left:32px;width:85%"><strong>CORRECTIVE ACTION/S
                                    TAKEN?</strong></td>
                            <td style="text-align: left;width:5%"><strong>[&nbsp;x&nbsp;] YES</strong></td>
                            <td style="text-align: left;width:5%"><strong>[&nbsp;x&nbsp;] NO</strong></td>
                            <td style="text-align: left;width:5%"><strong>[&nbsp;x&nbsp;] NO</strong></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: left;width:60%;padding-top:30px">
                                <table>
                                    <tr>
                                        <td style="padding-left:32px;width:20%;text-align:right">
                                            <strong>Verified By:</strong>
                                        </td>
                                        <td>
                                            <div
                                                    style="
                                                    border-bottom:1px solid black;
                                                    width:50%;
                                                    text-align:center;
                                                    font-weight:bold;
                                                    "
                                            >{{ Str::upper($qdn->closure->close_by) }}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td colspan="2" style="text-align: left;width:40%">
                                <table>
                                    <tr>
                                        <td style="padding-left:32px;width:20%;text-align:right">
                                            <strong>Date:</strong>
                                        </td>
                                        <td>
                                            <div
                                                    style="
                                                    border-bottom:1px solid black;
                                                    width:50%;
                                                    text-align:center;
                                                    font-weight:bold;
                                                    "
                                            >{{ Carbon::parse($qdn->closure->updated_at)->format('m/d/Y') }}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <table id="frame" style="border:0px;font-weight:bold">
        <tr>
            <td id="comp-name" colspan="2">Telford Svc. Phils Inc.</td>
            <td id="rev">Rev. ##</td>
        </tr>
    </table>
@endforeach
</body>
</html>