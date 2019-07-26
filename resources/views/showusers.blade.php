<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>MailMan - Users</title>
@include('headdata')
    </head>
    <body>
@include('cookieConsent::index')
@include('navbar')
    <main>
        <div class="container">
	    <div class="row">
		<div class="col m10">
                    <h2>Mail users</h2>
		</div>
		<div class="col m2">
		    <a class="waves-effect waves-light modal-trigger add-button" href="#create-modal"><ion-icon size="large" name="add-circle"></ion-icon></a>
		</div>
	    </div>
            <div class="row">
                <div class="col m12">
                    <table class="striped">
			<thead>
			    	<tr>
				    <th>Username</th>
				    <th>Domain</th>
				    <th>Options</th>
				</tr>
			</thead>
			<tbody>
			    @foreach($users as $user)
				<tr>
					<td>{{ $user->username }}</td>
					<td>{{ $user->domain->name }}</td>
					<td>
					    <a class="waves-effect waves-light btn-flat modal-trigger" href="#edit-modal-{{ $user->id }}">Edit</a>
					    <a href="{{route('Admin.deleteUser', ['id' => $user->id])}}"><button type="button" class="btn-flat">Delete</button></a>
					</td>
				</tr>
			    @endforeach
			</tbody>
		    </table>
                </div>
            </div>
        </div>
    </main>
@include('footer')

  <div id="create-modal" class="modal">
    <form method="post" action="{{route('Admin.addUser')}}">
    <div class="modal-content">
      <h4>Add a new mail user</h4>
          @csrf
          <div class="container">
            <div class="row">
              <div class="input-field col m6 s12">
              <input name="username" id="u_id" type="text" class="validate" required>
              <label for="u_id">Username</label>
          </div>
          <div class="col m1 valign-wrapper s2">
              <h5>@</h5>
          </div>
          <div class="input-field col m5 s10">
              <select id="d_id" name="domain_id">
                  <option value="" disabled selected>Choose a domain</option>
		  @foreach($domains as $domain)
		    <option value="{{ $domain->id }}">{{ $domain->name }}</option>
		  @endforeach
              </select>
              <label for="d_id">Domain</label>
          </div>

            </div>
            <div class="row">
          <div class="input-field col m12">
              <input name="password" id="p_id" type="password" class="validate" required>
              <label for="p_id">Password</label>
          </div>
      </div>
      <div class="row">
          <div class="input-field col m12">
              <input name="password_confirm" id="pc_id" type="password" class="validate" required>
              <label for="pc_id">Confirm password</label>
          </div>
      </div>
          </div>
    </div>
    <div class="modal-footer" style="text-align:center;">
      <button type="submit" href="#!" class="modal-close waves-effect waves-light btn blue darken-2">Add</button>
    </div>
    </form>
  </div>

@foreach($users as $user)
  <div id="edit-modal-{{ $user->id }}" class="modal">
    <form method="post" action="{{route('Admin.updateUser', ['id' => $user->id] )}}">
      <div class="modal-content">
        <h4>Edit {{ $user->username.'@'.$user->domain->name }}</h4>
        @csrf
        <div class="contrainer">
          <div class="row">
            <div class="input-field col m12">
              <input name="password" placeholder="New password" id="p_id" type="password" class="validate" required>
              <label for="p_id">New password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col m12">
              <input name="password_confirm" id="pc_id" placeholder="Confirm new password" type="password" class="validate" required>
              <label for="pc_id">Confirm new password</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="text-align:center;">
        <button type="submit" href="#!" class="modal-close waves-effect waves-light btn blue darken-2">Edit</button>
      </div>
    </form>
  </div>
@endforeach

<script>
$(document).ready(function(){
    $('.modal').modal();
    $('select').formSelect();
  });

</script>

    </body>
</html>
