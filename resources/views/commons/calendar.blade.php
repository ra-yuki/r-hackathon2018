<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Mon</th>
            <th scope="col">Tue</th>
            <th scope="col">Wen</th>
            <th scope="col">Thu</th>
            <th scope="col">Fri</th>
            <th scope="col">Sat</th>
            <th scope="col">Sun</th>
        </tr>
    </thead>
    <tbody>
        <?php $daysLength = count($days); ?>
        <?php $daysInWeek = 7; ?>
        <?php $cols = ceil($daysLength / $daysInWeek); ?>
        @for($i=0; $i<$cols; $i++)
            <tr>
            @for($j=0; $j<$daysInWeek; $j++)
                @if($days[$daysInWeek*$i + $j] == 0)
                    <td>-</td>
                @else
                    <td>{{ $days[$daysInWeek*$i + $j] }}</td>
                @endif
            @endfor
            </tr>
        @endfor
    </tbody>
</table>