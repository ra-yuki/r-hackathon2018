<?php
// get all the relevant events
$eventsMatched = [];
$date = (new \DateTime("$year-$month-$day"))->format('Y-m-d');
foreach($events as $e){
    if(preg_match("/$date/", $e->dateTimeFromSelf, $res) || preg_match("/$date/", $e->dateTimeToSelf, $res)){
        array_push($eventsMatched, $e);
    }
}
?>

@foreach($eventsMatched as $e)
    <?php
        // formatting
        if($e->fixed){
            if(isset($e->dateFrom)){ //group event
                $classBtnColor = 'group-event';
            }
            else { //pricate event
                $classBtnColor = 'event';
            }
        }
        else { //未確定
            $classBtnColor = 'undefined-event';
        }
        $timeFromSplit = explode(':', explode(' ', $e->dateTimeFromSelf)[1]);
        $timeToSplit = explode(':', explode(' ', $e->dateTimeToSelf)[1]);
        $timeFrom = $timeFromSplit[0]. ":". $timeFromSplit[1];
        $timeTo = $timeToSplit[0]. ":". $timeToSplit[1];
    ?>
    <?php $from = explode(':', explode(' ', $e->dateTimeFromSelf)[1])[0]; ?>
    <?php $to = explode(':', explode(' ', $e->dateTimeToSelf)[1])[0]; ?>
    
    @if($e->fixed)
        <a class="event-card" href="{{route('events.show', ['id' => $e->id])}}">
            <div class="{{$classBtnColor}}">
                <div>{{$e->title}}</div>
                <small>{{$timeFrom}}-{{$timeTo}}</small>
                <br>
            </div>
        </a>
    @else
        <a class="event-card" href="{{route('events.showHub', ['eventPath' => $e->eventPath])}}">
            <div class="{{$classBtnColor}}">
                <div>{{$e->title}}</div>
                <small>{{$timeFrom}}-{{$timeTo}}</small>
                <br>
            </div>
        </a>
    @endif
    
@endforeach