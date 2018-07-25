@section('head-plus')
    <link rel="stylesheet" href ="{{ secure_asset('css/mypage.css') }}">
    <link rel="stylesheet" href ="{{ secure_asset('css/commons/buttons.css') }}">
    <link rel="stylesheet" href ="{{ secure_asset('css/commons/generals.css') }}">
@endsection


<?php $count = count($events); ?>

{{-- render recently created events --}}
<!--<p>Recently Created</p>-->


{{-- render events month each --}}
    @for($i=0; $i<$count; $i++)
        <?php 
            // get year-month and yearPrev-monthPrev pair to compare later
            $date = explode(' ', $events[$i]->dateTimeFromSelf)[0];
            $yearMonthPair = explode('-', $date)[0] . '-' . explode('-', $date)[1];
            
            if(isset($events[$i-1])){
                $datePrev = explode(' ', $events[$i-1]->dateTimeFromSelf)[0];
                $yearMonthPrevPair = explode('-', $datePrev)[0] . '-' . explode('-', $datePrev)[1];
            }
        ?>
        @if( ($i == 0) || ($yearMonthPair != $yearMonthPrevPair) )
            <div id="month">
                <p style="margin-bottom:0;">{{$yearMonthPair}}</p>
            </div>
            
            <div class="row list">
                <a href="{{route('events.showHub', ['eventPath' => $events[$i]->eventPath])}}" class="no-decoration-black">
                    <div class="col-xs-10 bg-yellow py-05 wakugumi ">
                        {{$events[$i]->title}}
                    </div>
                </a>
            </div>
        @else
            <div class="row list">
                <a href="{{route('events.showHub', ['eventPath' => $events[$i]->eventPath])}}" class="no-decoration-black">
                    <div class="col-xs-10 bg-yellow py-05 wakugumi ">
                        {{$events[$i]->title}}
                    </div>
                </a>
            </div>
        @endif
    @endfor