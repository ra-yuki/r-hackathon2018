<div class="col-xs-12">
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $e)
                {{ $e }}
            @endforeach
        </div>
    @endif
    @if(session('messageDanger'))
        <div class="alert alert-danger">
            {{ session('messageDanger') }}
        </div>
    @endif
    @if(session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
    
    <?php $exists = isset($messages); ?>
    @if($exists && count($messages) > 0)
        @foreach($messages as $m)
            <div class="alert alert-info">
                {!! $m !!}
            </div>
        @endforeach
    @endif
</div>