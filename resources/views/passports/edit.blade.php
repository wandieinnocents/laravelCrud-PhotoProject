
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>qLaravel 5.6 CRUD Tutorial With Example  </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  </head>
  <body>
    <div class="container">
      <h2>Edit A Form</h2><br  />
        <form method="post" action="{{ action('PassportController@update', $id)}}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <label for="name">Names:</label>
            <input type="text" class="form-control" name="name" value="{{ $passport->name}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="email">Email</label>
              <input type="text" class="form-control" name="email" value="{{$passport->email}}">
            </div>
          </div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="number">Phone Number:</label>
              <input type="text" class="form-control" name="number" value="{{$passport->number}}">
            </div>
          </div>

          <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <label for="number">Update Image:</label>
              <input type="file" name="filename" value="{{ $passport->filename }}">
           </div>
          </div>


          <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
              <strong>Date : </strong>
              <input class="date form-control"  type="text" id="datepicker" name="date" value="{{ $passport->date }}">
           </div>
          </div>



        <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-left:38px">
                <lable>Passport Office</lable>
                <select name="office">
                  <option value="Mumbai"  @if($passport->office=="Mumbai") selected @endif>Mumbai</option>
                  <option value="Chennai"  @if($passport->office=="Chennai") selected @endif>Chennai</option>
                  <option value="Delhi" @if($passport->office=="Delhi") selected @endif>Delhi</option>
                  <option value="Bangalore" @if($passport->office=="Bangalore") selected @endif>Bangalore</option>
                </select>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4" style="margin-top:60px">
            <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
          </div>
        </div>
      </form>
    </div>

    <!-- date picker -->
    <script type="text/javascript">
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
         });
    </script>

    <!-- end of date picker -->
  </body>
</html>
