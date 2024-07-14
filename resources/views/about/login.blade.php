
    <div class="contaitner">
    <form action="{{route('about.entry')}}" method="POST" class="ms-auto me-auto mt-3" style="width: 500px">
    @csrf
    <div class="mb-3">
      <label class="form-label">Email address</label>
      <input type="email" class="form-comtrol" placeholder="Enter Username" name="email" required>
      @if($errors->has('email'))
        <div class="error">{{ $errors->first('email') }}</div>
      @endif
    </div>
 
  <div class="mb-3" style="margin-top: 5px" >
    <label class="form-label">Password</label>
    <input type="password" class="form-comtrol" placeholder="Enter Password" name="password" required>
    @if($errors->has('password'))
      <div class="error">{{ $errors->first('password') }}</div>
    @endif
  </div>

  <label>
    <input type="checkbox" checked="checked" name="remember"> Remember me
  </label>

  <div class=" " style="margin-top: 5px" >
    {{-- <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button> --}}
    <span class="password" style="margin-top: 5px" > <a href="#">forgot password?</a></span>
  </div>
 
  <button type="submit" class="btn btn-primary"  style="margin-top: 5px" >Submit</button>
</form>
    </div>












   





    
