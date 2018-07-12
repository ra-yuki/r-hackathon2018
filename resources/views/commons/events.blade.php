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
    <?php $classBtnColor = ($e->fixed) ? 'btn-success' : 'btn-default' ; ?>
    <?php $from = explode(':', explode(' ', $e->dateTimeFromSelf)[1])[0]; ?>
    <?php $to = explode(':', explode(' ', $e->dateTimeToSelf)[1])[0]; ?>
    {!! link_to_route('events.show', $e->title. " ". $from. "-". $to, ['id' => $e->id], ['class' => "btn btn-block $classBtnColor"]) !!}
@endforeach