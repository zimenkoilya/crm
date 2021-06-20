<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>工程表PDF</title>
    <style>
        html {
            -webkit-text-size-adjust: 100%; /* 2 */
            -webkit-tap-highlight-color: transparent; /* 3*/
        }
        body {
            font-family: "Hiragino Kaku Gothic Pro", "ヒラギノ角ゴ Pro", "Yu Gothic Medium", "游ゴシック Medium", YuGothic, "游ゴシック体", "メイリオ", sans-serif;
            color: #333;
        }
        *, ::before, ::after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            border-style: solid;
            border-width: 0;
        }
        .proccess__wrap {
            padding: 0 20px;
            height: 100%;
        }
        .proccess__wrap__inner {
            height: 100%;
        }
        .proccess__wrap__inner table {
            border: 1px solid #e2e2e2;
            border-collapse: collapse;
        }
​
        .proccess__wrap__inner thead {
            border: none;
            height: 35px;
        }
        .proccess__wrap__inner thead th,
        .proccess__wrap__inner thead td {
            padding: 0px 10px;
            height: 35px;
        }
        .proccess__wrap__inner thead th:nth-child(n+3) {
            width: 140px;
            background: #F1F3F6;
        }
        .proccess__wrap__inner tbody {
            border: none;
        }
        .proccess__wrap__inner tbody th {
            font-weight: 400;
        }
        .proccess__wrap__inner tbody th.th-date {
            border-top: 1px solid #e2e2e2;
            border-right: 1px solid #e2e2e2;
            border-left: 1px solid #e2e2e2;
            border-bottom: 0px solid #F1F3F6;
            background: #F1F3F6;
            font-weight: 700;
            vertical-align: top;
            line-height: 60px;
            padding: 0 5px;
        }
        .proccess__wrap__inner tbody th.th-date-other {
            background: #F1F3F6;
            border-top: 0;
            border-right: 1px solid #e2e2e2;
            border-left: 1px solid #e2e2e2;
            border-bottom: 0px solid #F1F3F6;
        }
        .proccess__wrap__inner tbody th.th-date-others {
            background: #F1F3F6;
            border-top: 0;
            border-right: 1px solid #e2e2e2;
            border-left: 1px solid #e2e2e2;
            border-bottom: 1px solid #e2e2e2;
        }
        .proccess__wrap__inner tbody th.th-headline {
            background: #F1F3F6;
            font-weight: 700;
            padding: 0 5px;
        }
        .proccess__wrap__inner tbody th,
        .proccess__wrap__inner tbody td {
            height: 130px;
            font-size: 15px;
        }
        .proccess__wrap__inner tr {
            border: none;
            page-break-inside: avoid;
        }
        .proccess__wrap__inner tr:nth-child(3n) {
            border-bottom: 1px solid #e2e2e2;
        }
        .proccess__wrap__inner th,
        .proccess__wrap__inner td {
            border: 1px solid #e2e2e2;
        }
        .proccess__wrap__inner ul {
            list-style: none;
            font-size: 14px;
            background: #fbfbfb;
            width: 100%;
            height: 100%;
            margin: 0;
        }
        .proccess__wrap__inner table li {
            margin-bottom: 5px;
            border-top: 0;
            border-right: 0;
            border-left: 0;
            padding-left: 5px;
            padding-right: 5px;
            height: 19px;
            border-bottom: 1px solid #f4f4f4;
            font-size: 14px
        }
        .proccess__wrap__inner table li:first-child {
            padding-top: 3px;
        }
        .proccess__wrap__inner table li:last-child {
            margin-bottom: 0px;
            padding-bottom: 10px;
            border-bottom: none;
        }
        .proccess__wrap__inner table li.one:last-child {
            border-bottom: 2px solid rgb(213, 0, 0);
        }
        .proccess__wrap__inner table li.two:last-child {
            border-bottom: 2px solid rgb(230, 124, 115);
        }
        .proccess__wrap__inner table li.three:last-child {
            border-bottom: 2px solid rgb(244, 81, 30);
        }
        .proccess__wrap__inner table li.four:last-child {
            border-bottom: 2px solid rgb(246, 191, 38);
        }
        .proccess__wrap__inner table li.five:last-child {
            border-bottom: 2px solid rgb(51, 182, 121);
        }
        .proccess__wrap__inner table li.six:last-child {
            border-bottom: 2px solid rgb(11, 128, 67);
        }
        .proccess__wrap__inner table li.seven:last-child {
            border-bottom: 2px solid rgb(3, 155, 229);
        }
        .proccess__wrap__inner table li.eight:last-child {
            border-bottom: 2px solid rgb(63, 81, 181);
        }
        .proccess__wrap__inner table li.nine:last-child {
            border-bottom: 2px solid rgb(121, 134, 203);
        }
        .proccess__wrap__inner table li.ten:last-child {
            border-bottom: 2px solid rgb(97, 97, 97);
        }
        /* --- option  --- */
        .proccess__wrap__inner .no-border {
            border-width: 1px !important;
            /* border-color: white !important; */
        }
        .proccess__wrap__inner .no-color {
            background: #fff !important;
            border-top: 1px solid white;
            border-left: 1px solid white;
            border-right: 1px solid white;
        }
        .proccess__wrap__inner .no-colors {
            background: #fff !important;
            border-top: 1px solid white;
        }
    </style>
</head>

<body>

    <?php
        $charges = $charges_other;
        $_chargeCount = count($charges);
        $_print = false;
    ?>

    <div class="proccess">
        <div class="proccess__wrap">
            <div class="proccess__wrap__inner">
                @php $qq = 0; @endphp
                @for ($chargeIndex = 0; $chargeIndex < $_chargeCount; $chargeIndex += $showCount)
                @for ($i = 0; $i < $showCount; $i ++)
                    @if (isset($charges[$chargeIndex + $i]->name))
                        @php $qq++; @endphp
                    @endif
                @endfor
                @if($qq !== 8)
                    <h1 style="height: 35px;"></h1>
                @else
                <h1>工程表</h1>
                @endif
                <?php $_first = false; ?>
                <?php
                    $loopIndex = 0;
                    $_print = false;
                ?>
                <?php
                    $loopIndex ++;
                    $_print = true;
                ?>
                @if ($loopIndex % 5 === 1)
                <table style="width: 100%; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th class="no-border no-color" style="width: 5%;"></th>
                            <th class="no-border no-colors" style="width: 6%;"></th>
                            @php $kk = 0; @endphp
                            @for ($i = 0; $i < $showCount; $i ++)
                                @if (isset($charges[$chargeIndex + $i]->name))
                                    @php $kk++; @endphp
                                    <th style="width: 11%;">{{ mb_strimwidth($charges[$chargeIndex + $i]->name, 0, 12, '…') }}</th>
                                @endif
                            @endfor
                            @if($kk !== 8)
                                <td style="width: {{88-11*$kk}}%; background-color:white; border-color:white;" ></td>
                            @endif
                        </tr>
                    </thead>
                    {{-- 日程 AM/PM/案件調整 START --}}
                    @foreach ($dates as $dateIndex => $date)
                        <?php $prevTimeTypes = [1 => 'AM', 2 => 'PM', 0 => '案件調整']; ?>
                        @foreach ($prevTimeTypes as $key => $timeType)
                        <tbody>
                            <tr>
                                @if($key == 1)<th class="th-date">{{ $date['date'] }}</th>
                                @elseif($key == 2)<th class="th-date-other"></th>
                                @else  <th class="th-date-others"></th>
                                @endif
                                <th class="th-headline">{{ $timeType }}</th>
                                @php $j = 0; @endphp
                                @for ($i = 0; $i < $showCount; $i ++)
                                    {{--  案件の場合  --}}
                                    @if (isset($charges[$chargeIndex + $i]->name))
                                    <td>
                                        @if (isset($date[$key]['project']))

                                            @foreach ($date[$key]['project'] as $projectIndex => $project)

                                                @if ($project->worker_id === $charges[$chargeIndex + $i]->id && $project->charge_id !==0)

                                                    <ul>
                                                        <li>{{ mb_strimwidth($project->projectTypeName(), 0, 17, '…') }}</li>
                                                        <li>{{ mb_strimwidth($project->name, 0, 17, '…') }}</li>
                                                        <li>{{ mb_strimwidth($project->worker_id, 0, 17, '…') }}</li>
                                                        <li>{{ mb_strimwidth($project->charge->name, 0, 17, '…') }}</li>
                                                        <li>{{ mb_strimwidth($project->projectOrderer->company, 0, 17, '…') }}</li>
                                                        @if($project->process_color_id == 1)<li class="one">
                                                        @elseif($project->process_color_id == 2)<li class="two">
                                                        @elseif($project->process_color_id == 3)<li class="three">
                                                        @elseif($project->process_color_id == 4)<li class="four">
                                                        @elseif($project->process_color_id == 5)<li class="five">
                                                        @elseif($project->process_color_id == 6)<li class="six">
                                                        @elseif($project->process_color_id == 7)<li class="seven">
                                                        @elseif($project->process_color_id == 8)<li class="eight">
                                                        @elseif($project->process_color_id == 9)<li class="nine">
                                                        @elseif($project->process_color_id == 10)<li class="ten">
                                                        @else<li>
                                                        @endif
                                                        {{ mb_strimwidth($project->address, 0, 17, '…') }}</li>
                                                    </ul>

                                                @else
                                                    @if (isset($date[$key]['charge_remark']))
                                                        @foreach ($date[$key]['charge_remark'] as $temp)
                                                            @if($temp->charge_id == $charges[$chargeIndex + $i]->id)
                                                                <ul><li>{{mb_strimwidth($temp->remarks, 0, 70, '…')}}</li></ul>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endif

                                            @endforeach
                                        @else
                                            @php $check = 1; @endphp
                                        @endif
                                        @if(isset($check))
                                            @if($check == 1)
                                                @php $check = 0; @endphp
                                                @if (isset($date[$key]['charge_remark']))
                                                    @foreach ($date[$key]['charge_remark'] as $temp)
                                                        @if($temp->charge_id == $charges[$chargeIndex + $i]->id)
                                                            <ul><li>{{mb_strimwidth($temp->remarks, 0, 70, '…')}}</li></ul>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                    @endif
                                    {{--  メモの場合  --}}

                                    {{--  空の場合の表示  --}}
                                    @if (!isset($date[$key]['charge_remark']) && !isset($date[$key]['project']))
                                    @endif
                                @endfor

                            </tr>
                        </tbody>
                        @endforeach
                    @endforeach
                    {{-- 日程 END --}}

                </table>
                @endif
                    @if ($loopIndex % 5 === 0)
                    @endif
                    @if ($chargeIndex < $_chargeCount)
                    @endif
                @endfor
            </div>
        </div>
    </div>

</body>
</html>
