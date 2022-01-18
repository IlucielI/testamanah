@extends('layouts/templete_backend')


@section('contents')
  <div class="container-fluid">
    <div class="container w-75 text-dark mt-5">
      <div class="row">
        <div class="col-md-4">
          <label for="name">Nomor Tebakan</label>
        </div>
        <div class="col-md-8">
          <input type="text" class="form-control" id="tebakan" placeholder="Nomor Tebakan" maxlength="5" minlength="5">
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-md-4">
        </div>
        <div class="col-md-8">
          <button type="button" class="btn btn-warning" id="tebak">Tebak!</button>
        </div>
      </div>
      <div id="container_tebak"></div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  let rahasia = String(Math.floor(10000 + Math.random() * 9000)).split('');
  console.log(rahasia);
  $("#tebak").click(function() {
    let tebakan = $("#tebakan").val().split('');
    // let total = 0;
    let Alhamdulillah = [];
    let Subhanallah= [];
    rahasia.forEach((value, i)=>{
      if(value == tebakan[i]){
        // total++;
        Alhamdulillah.push(tebakan[i]);
      }else{
        Subhanallah.push(tebakan[i]);
      }
    });
    let html = Alhamdulillah.length + ' Alhamdulillah ' + Subhanallah.length + ' Subhanallah ( angka ' + Alhamdulillah.toString() + " Alhamdulillah, " + Subhanallah.toString() + ' Subhanallah)';
    $('#container_tebak').html(html);
	});

</script>
@endsection