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
        $classBtnColor = ($e->fixed) ? 'event' : 'group-event' ;
        $timeFromSplit = explode(':', explode(' ', $e->dateTimeFromSelf)[1]);
        $timeToSplit = explode(':', explode(' ', $e->dateTimeToSelf)[1]);
        $timeFrom = $timeFromSplit[0]. ":". $timeFromSplit[1];
        $timeTo = $timeToSplit[0]. ":". $timeToSplit[1];
    ?>
    <?php $from = explode(':', explode(' ', $e->dateTimeFromSelf)[1])[0]; ?>
    <?php $to = explode(':', explode(' ', $e->dateTimeToSelf)[1])[0]; ?>
    
    <a class="event-card" href="{{route('events.show', ['id' => $e->id])}}">
        <div class="{{$classBtnColor}}">
            {{-- {!! link_to_route('events.show', $e->title, ['id' => $e->id], ['class' => ""]) !!} --}}
            <div>{{$e->title}}</div>
            <small>{{$timeFrom}}-{{$timeTo}}</small>
            <br>
        </div>
    </a>
@endforeach