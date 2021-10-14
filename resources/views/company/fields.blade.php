<div class="form-group row">
    <label for="company-name" class="col-sm-2 col-form-label">Company Name</label>
    <div class="col-sm-10">
        <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" 
            id="company-name" placeholder="Company Name" name="name" value="{{ old('name', $company->name) }}">
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
    </div>
</div>