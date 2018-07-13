<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Mon</th>
            <th scope="col">Tue</th>
            <th scope="col">Wed</th>
            <th scope="col">Thu</th>
            <th scope="col">Fri</th>
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
                    <td>-</td>
                    @continue;
                @endif
                
                {{-- real day --}}
                <?php $name = ""; ?>
                {{-- set text color --}}
                @if(($daysInWeek*$i + $j + 2) % 7 == 0)
                    <?php $classText = "text-primary"; ?>
                @elseif(($daysInWeek*$i + $j + 1) % 7 == 0)
                    <?php $classText = "text-danger"; ?>
                @else
                    <?php $classText = ""; ?>
                @endif
                <?php 
                    if(isset( $holidays[$days[$daysInWeek*$i + $j]] )){
                        $classText = "text-danger";
                        $name = $holidays[$days[$daysInWeek*$i + $j]];;
                    }
                ?>
                {{-- render --}}
                <td>
                    <p class="{{$classText}}">{{ $days[$daysInWeek*$i + $j] }}</p>
                    <small class="{{$classText}}">{{$name}}</small>
                    {{-- render events --}}
                    @include('commons.events', [
                        'year' => $year,
                        'month' => $month,
                        'day' => $days[$daysInWeek*$i + $j],
                    ])
                </td>
            @endfor
            </tr>
        @endfor
    </tbody>
</table>