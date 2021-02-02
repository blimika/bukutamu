<form class="form-horizontal">
    <div class="form-group row">
      <label for="bulan" class="col-sm-1 control-label">Filter</label>
      
      <div class="col-md-2">
          <select name="tahun" id="tahun" class="form-control">
           @foreach ($dataTahun as $iTahun)
           <option value="{{$iTahun->tahun}}" @if (request('tahun')==$iTahun->tahun or $tahun==$iTahun->tahun)
           selected
          @endif>{{$iTahun->tahun}}</option>
           @endforeach
          </select>
      </div>

      <div class="col-md-2">
          <button type="submit" class="btn btn-success">Filter</button>
      </div>
    </div>
</form>
