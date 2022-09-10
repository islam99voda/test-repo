@extends('layouts.app')
    <div class="form-group">
      <form method="POST" action="{{route('profile.update')}}">
        @csrf
        @method('PUT')
      <label for="exampleFormControlInput1">country</label>
      <input type="text" class="form-control" id="exampleFormControlInput1" name="country" >
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Example select</label>
      <select class="form-control" name="gender">
        <option value="mail">mail</option>
        <option value="femail">femail</option>
      </select>
    </div>

    <label for="exampleFormControlInput1">facebook</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" name="facebook" >
    <div class="form-group">
      <label for="exampleFormControlTextarea1">jops</label>
      <textarea class="form-control" name="job" rows="3"></textarea>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
