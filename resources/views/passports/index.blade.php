<!-- index.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    <br />
    <!-- session here success message -->
    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif

     <!-- end of session success message -->
     <a href="passports/create">
       <button type="button" class="btn btn-primary" name="button">Add Passport Photo</button>
     </a>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Date</th>
        <th>Email</th>
        <th>File</th>
        <th>Phone Number</th>
        <th>Passport Office</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>

      @foreach($passports as $passport)
      @php
        $date=date('Y-m-d', $passport['date']);
        @endphp
      <tr>
        <td>{{$passport['id']}}</td>
        <td>{{$passport['name']}}</td>
        <td>{{$date}}</td>
        <td>{{$passport['email']}}</td>
        <td>
          <img style="width:20%;height:20%;" src="images/{{ $passport->filename }}" />

        </td>

        <td>{{$passport['number']}}</td>
        <td>{{$passport['office']}}</td>

        <td><a href="{{ action('PassportController@edit', $passport['id'])}}" class="btn btn-warning">Edit</a></td>

        <td>
          <form action="{{action('PassportController@destroy', $passport['id'])}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>



      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  </body>
</html>
