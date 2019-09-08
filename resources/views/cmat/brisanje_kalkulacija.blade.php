   @extends('layouts.admin_dash')



@section('page_heading','BRISANJE KALKULACIJA')
@section('section')


<div>
            <div class="row">
               
                <div class="col-12 ">
                     <form id="forma">
                        <div >
                            <div class='row col-auto mb-3'>
                                <label class="col-auto">Broj kalkulacije:</label>
                                <input class="form-control col-md-1 col-xs-auto" for="validationDefault05" type="text" id="naziv" required>
                            </div>
                              <div class='row col-auto mb-1 justify-content-start'>
                                <div class="col-auto">
                                    <label class="col-lg-3  col-md-12 col-sm-12 col-xs-12">Radnja:</label>
                                </div>
                                <div class="col-auto">
                                       <select class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" id="radnja">
                                 
                                    </select>
                                </div>
                            </div>
                   
                        </div> 

                        <button class="btn btn-danger  mt-3" type="submit"  id="unos">Obrisi</button>
                       {{--  <button class="btn btn-success  mt-3" type="button"  id="izmena">Izmena</button>
                        <button class="btn btn-danger mt-3" type='reset' id="reset">Reset</button> --}}
                   </form>
                </div>
           
              
            </div>
   
   
</div>

<script>
  $("#forma").submit(function(e) {

                e.preventDefault();
              
                $.get("{{ route('obrisiKalkulacije') }}",{
                    brojKalkulacije : $('#naziv').val(),
                    orgjed : $('#radnja').val(),
                
                  
                },function(d){
                    if (d != ''){
                      alert(d);
                      console.log(d);
                    }
                    console.log(d);
            //alert(d);
                  //  tblZaposlenja.ajax.reload();

                    $('#forma').trigger("reset");
                    addNumberToRight('a');
            
                });
        });
  
$("#naziv").focus().val("000000");


$("#naziv").on('keyup',function(e){

  addNumberToRight(e);
});

 function addNumberToRight(param){
          noviKarakter = param.key;
         // alert('s00');
          var number = $("#naziv").val();
          var duzinaSaNovim = number.length;
          output = [],
          sNumber = number.toString();
          brojNula = 0;

            for (var i = 0, len = sNumber.length; i < len; i += 1) {
                //output.push(+sNumber.charAt(i));
                if (sNumber.charAt(i) == 0){
                  brojNula++;

                }
                else
                {
                  i=len;
                }
            }
          if (duzinaSaNovim == 7){ 
           // alert(duzinaSaNovim);
                if (sNumber.charAt(0) == 0){
                  //alert('us');
                 sNumber= sNumber.substr(1);//Brisemo prvu nulu kada se doda broj
                 $("#naziv").val(sNumber);
                }
                else
                {
                  //alert(duzinaSaNovim);

                  sNumber = sNumber.substring(0, duzinaSaNovim - 1); // Brisemo poslednju cifru ako je upisano svih 6 karaktera
                  $("#naziv").val(sNumber);
                }

          }
           if (duzinaSaNovim < 7){// Obrada pri brisanju brojeva (Dodaje se)
                potrebanBrojNula = 6 - duzinaSaNovim;
                for (var i = 1; i <=potrebanBrojNula; i++) {// Proveravamo koliko nula je potrebno ispred broja(Desi se problem kada se zadrzi taster zato sto je KEYUP)
                  sNumber = '0' + sNumber;
                }
                //alert(potrebanBrojNula);
             
               $("#naziv").val(sNumber);
           }
           if (duzinaSaNovim > 7){
         
             
                sNumber = sNumber.slice(0,6);
                $("#naziv").val(sNumber);
            }

       };

        function popuniRadnje(param)

            {
                
                //alert($('#selektovaniRed').text());
                $.get("zaposlenjaRadnje",{
                pretraga:param,
       
             
            },function(result){
                
                obj = JSON.parse(result);
                //console.log(obj[0]);
                var brRedova=obj.length;
                        $("#radnja").empty();
                
                        //alert(obj[0].aplikacija);
                        
                       for (var i = 0; i < brRedova; i++) 
                        {

                                $("#radnja").append(
                                                    $("<option></option>") 
                                                        .text(obj[i].nazobj)
                                                        .val(obj[i].orgjed)
                                                   ); 
                                              
                        }

                  });
               
        

            }
            popuniRadnje('param');

</script>

@endsection