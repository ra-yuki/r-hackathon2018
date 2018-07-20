<div class="col-xs-12">
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
</div>