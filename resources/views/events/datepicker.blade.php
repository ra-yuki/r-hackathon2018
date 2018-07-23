<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!--<script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript" language="javascript"></script>-->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.en-AU.min.js"></script>
    </head>
    <body>
        <div class="form-group" id="datepicker-default">
          <div class="col-sm-9 form-inline">
            <div class="input-group date">
              <input type="text" class="form-control" value="">
              <div class="input-group-addon">
                <i class="glyphicon glyphicon-calendar"></i>
              </div>
            </div>
          </div>
        </div>
        <script>
        $(function(){
            //Default
            $('#datepicker-default .date').datepicker({
                format: "yyyy/mm/dd",
                language: 'ja',
                autoclose: true
            });
            
        });
        </script>
    </body>
</html>