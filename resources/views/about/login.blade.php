<div class="account_creation">
            <form action="{{ route('about.save') }}" method="POST" enctype="multipart/form-data"  >
            @csrf
            <div class="mb-3 col-md-1">
                <label class="form-label">FullName</label>
                <input type="text" class="form-control" name="name">
                @if($errors->has('name'))
            <div class="error">{{ $errors->first('name') }}</div>
          @endif
            </div>
          
            <div class="mb-3 col-md-1">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email">
            @if($errors->has('email'))
            <div class="error">{{ $errors->first('email') }}</div>
          @endif
          </div>
          
          <div class="mr-1 mb-3 col-md-1">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
            @if($errors->has('password'))
            <div class="error">{{ $errors->first('password') }}</div>
          @endif
          </div>

        
        <!-- UserRoles -->

          <div class="mb-3 col-md-1">
          <select name="user_roles" class="form-control" id="user_roles">
                                        <option value="0" disabled>Select User Role</option>
                                        <option value="1" @if (old('user_roles') == "1") {{ 'selected' }} @endif>admin</option>
                                        <option value="2" @if (old('user_roles') == "2") {{ 'selected' }} @endif>Customer</option>
                                    </select>
          </div>
          <button type="submit" class="cancelbtn">Submit</button>