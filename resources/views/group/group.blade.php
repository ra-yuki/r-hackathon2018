<ul class="media-list">
@foreach ($groups as $group)
    <!--<?php $user = $group->user; ?>-->
    
           <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="panel panel-default">
                    <div>
                        
                        {!! link_to_route('groups.show',$group->name, ['id' => $group->id]) !!}<p>{!! nl2br(e($group->name)) !!}</p>{{ $group->created_at }}
                    </div>
                    <div>
                        @if (Auth::user()->id == $group->user_id)
                             
                            {!! Form::open(['route' => ['groups.destroy', $micropost->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['class' => 'btn btn-danger btn-xs']) !!}
                            {!! Form::close() !!}
                          
                        @endif
                    </div>
            
                </div>
            </div>
    
@endforeach

<!--{!! $microposts->render() !!}-->