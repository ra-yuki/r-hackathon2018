<h1>{{$year}}/{{$month}}</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Mon</th>
            <th scope="col">Tue</th>
            <th scope="col">Wen</th>
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
                {{-- exception handling --}}
                <?php $exists = isset($days[$daysInWeek*$i + $j]); ?>
                @if($exists == false) @break @endif
                
                {{-- render --}}
                @if($days[$daysInWeek*$i + $j] == 0)
                    <td>-</td>
                @else
                    @if(($daysInWeek*$i + $j + 1) % 6 == 0)
                        <td class="text-primary">[{{$daysInWeek*$i + $j + 1}}] {{ $days[$daysInWeek*$i + $j] }}</td>
                    @elseif(($daysInWeek*$i + $j + 1) % 7 == 0)
                        <td class="text-danger">[{{$daysInWeek*$i + $j + 1}}] {{ $days[$daysInWeek*$i + $j] }}</td>
                    @else
                        <td>[{{$daysInWeek*$i + $j + 1}}] {{ $days[$daysInWeek*$i + $j] }}</td>
                    @endif
                @endif
            @endfor
            </tr>
        @endfor
    </tbody>
</table>