@section('head-plus')
    <link rel="stylesheet" href ="{{ secure_asset('css/mypage.css') }}">
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
            
            <div id="list" class="row">
                <div class="col-xs-8">
                    {!! link_to_route('events.showHub',$events[$i]->title, ['eventPath' => $events[$i]->eventPath], ['class' => '']) !!}
                </div>
            </div>
        @else
            <div id="list" class="row">
                <div class="col-xs-8">
                    {!! link_to_route('events.showHub', $events[$i]->title, ['eventPath' => $events[$i]->eventPath], ['class' => '']) !!}
                </div>
            </div>
        @endif
    @endfor