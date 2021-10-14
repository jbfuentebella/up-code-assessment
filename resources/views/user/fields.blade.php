<div class="form-group row">
    <label for="user-name" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
        <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" 
            id="user-name" placeholder="Name" name="name" value="{{ old('name', $user->name) }}">
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
    </div>
</div>