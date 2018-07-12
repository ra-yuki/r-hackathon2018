@foreach($events as $e)
    <div class="row">
        <div class="col-xs-4">
            {!! link_to_route('events.show', $e->title, ['id' => $e->id], ['class' => '']) !!}
        </div>
    </div>
@endforeach