<table class="table table-bordered">
    <thead>
        <tr>
            {{--
            @for($i=0; $i<7; $i++)
                <th scope="col" class=
                @if($i == 5)
                    "text-primary ">
                @elseif($i == 6)
                    "text-danger ">
                @else
                    "">
                @endif
                    {{jddayofweek($i, 2)}}
                </th>
            @endfor
            --}}
            <th scope="col" class="">Mon</th>
            <th scope="col" class="">Tue</th>
            <th scope="col" class="">Wen</th>
            <th scope="col" class="">Thu</th>
            <th scope="col" class="">Fri</th>
            <th scope="col" class="text-primary">Sat</th>
            <th scope="col" class="text-danger">Sun</th>
        </tr>
    </thead>
    
    <tbody>
        <?php $daysLength = count($days); ?>
        <?php $daysInWeek = 7; ?>
        <?php $cols = ceil($daysLength / $daysInWeek); ?>
        @for($i=0; $i<$cols; $i++)
            <tr>
            @for($j=0; $j<$daysInWeek; $j++)
                {{-- *exception handling part* --}}
                <?php $exists = isset($days[$daysInWeek*$i + $j]); ?>
                @if($exists == false) @break @endif
                
                
                {{-- *render part* --}}
                
                {{-- empty day --}}
                @if($days[$daysInWeek*$i + $j] == 0)
                    <td class="">-</td>
                    @continue;
                @endif
                
                {{-- real day --}}
                <?php $name = ""; ?>
                {{-- set text color --}}
                @if(($daysInWeek*$i + $j + 2) % 7 == 0) {{-- Satday --}}
                    <?php $classText = "text-primary"; ?>
                @elseif(($daysInWeek*$i + $j + 1) % 7 == 0) {{-- Sunday --}}
                    <?php $classText = "text-danger"; ?>
                @else
                    <?php $classText = ""; ?>
                @endif
                <?php // special holidays
                    if(isset( $holidays[$days[$daysInWeek*$i + $j]] )){
                        $classText = "text-danger";
                        $name = $holidays[$days[$daysInWeek*$i + $j]];;
                    }
                ?>
                
                {{-- style background color of today --}}
                @if( $days[$daysInWeek*$i + $j] == (new \DateTime())->format('d') && $month == (new \DateTime())->format('m') && $year == (new \DateTime())->format('Y'))
                    <?php $classTd = "today"; ?>
                @else
                    <?php $classTd = ""; ?>
                @endif
                
                {{-- render --}}
                <td class="{{$classTd}} ">
                    <a href="{{ route('events.showScheduleHub', ['year'=>2017, 'month'=>9, 'day'=>12]) }}" style="text-decoration: none; color:black;">
                        <p class="{{$classText}}">{{ $days[$daysInWeek*$i + $j] }}</p>
                        <small class="{{$classText}}">{{$name}}</small>
                        {{-- render events --}}
                        @include('commons.events', [
                            'year' => $year,
                            'month' => $month,
                            'day' => $days[$daysInWeek*$i + $j],
                        ])
                    </a>
                </td>
            @endfor
            </tr>
        @endfor
       
    </tbody>
</table>

<div id="color">
   <div id="privateevent"> <P>&nbsp;&nbsp;private event:&nbsp;<img src="{{secure_asset('images/private.png')}}" id="pp">&nbsp;&nbsp;&nbsp;&nbsp;group event:&nbsp;<img src="{{secure_asset('images/group.png')}}" id="pp">&nbsp;&nbsp;&nbsp;&nbsp;undefined event:&nbsp;<img src="{{secure_asset('images/undifined.png')}}" id="pp"></P></div>
  
</div>    
 