<?php

namespace Laravel\Http\Controllers\adminApps;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Laravel\adminModels\b2me_admins as helset;
use Laravel\adminModels\crud_edit_settings as crudSettings;

class setovanjeB2meAdminsController extends Controller
{

	//public $sema='';
	//public $tabela='helena_setovanje';
	public function __construct()
	{
		$obj1 = new helset;  
		$this->sema = $obj1->samoSema;
		$this->tabela = $obj1->tabelaBezSeme; 
		$this->tabelSaSemom = $obj1->table; 
	
	}
     public function setovanjeTransferaIndex()
    {

         $koloneThead =  DB::select("
		      	select '<th style = \"width:119px;\">

		       	<button type=\"button\" class=\"btn btn-primary\" onclick=\"funkcijaKlikPretraga()\" id = \"modal_pretraga\">
				 Flitriranje
				</button>
		      	</th>'||string_agg('<th id = \"'||column_name||'\">'||upper(column_name)||'</th>','') as kolone
				from information_schema.columns
				where table_schema = '".$this->sema."' and table_name = '".$this->tabela."'

			");
         $koloneLista =  DB::select("
		      	select string_agg(column_name,',') as kolone
				from information_schema.columns
				where table_schema = '".$this->sema."' and table_name = '".$this->tabela."'

			");
         foreach($koloneLista as $obj){
			   $param2 =  $obj->kolone;
			  

			}
       $prom = json_encode($koloneThead);
      foreach(json_decode($prom) as $obj){
			   $param =  '<tr>'.$obj->kolone.'</tr>';
			  

			}
			//echo $this->tabela;
        return view('admin/b2me_admins',compact('param','param2'));	
    
    }
    public function helenaSetovanjaR()
    {
    		$andr = new helset;
    		$crud = crudSettings::where('tabela','=',$this->tabelSaSemom)->wherein('tip_kolone',['ORDER_DESC','ORDER_ASC'])->first();
    		$tipoviKolonaArr = array();
    		$opisKolona =  DB::select("

				      		select 
				      	c.column_name as kolona,c.data_type as tip,aa.opis,c.is_nullable
						from information_schema.columns c left outer join
						(
							SELECT c.column_name,pgd.description as opis
							FROM pg_catalog.pg_statio_all_tables as st
							  inner join pg_catalog.pg_description pgd on (pgd.objoid=st.relid)
							  inner join information_schema.columns c on (pgd.objsubid=c.ordinal_position
							    and  c.table_schema=st.schemaname and c.table_name=st.relname)
							    where c.table_schema = '".$this->sema."' and c.table_name = '".$this->tabela."'
						) aa
						on (aa.column_name = c.column_name)
						where  c.table_schema = '".$this->sema."' and c.table_name = '".$this->tabela."'	
						

					");

		            foreach($opisKolona as $objOpis)
		                     { // Vrti po redovima
		                     	$kolona = $objOpis->kolona;
		                     	$tip = $objOpis->tip;
		                     	$tipoviKolonaArr[$kolona]=$tip;
		                     }

    		
    		if ($crud === null) 
    		{
				   $meniji = helset::all();
			}
			else 
			{
				if ($crud['tip_kolone'] == 'ORDER_DESC')
		    		{
		    			$parametar1 = $crud['kolona'];
		    			$parametar2 = 'DESC';
		    		}
		    	else 
		    		{
		    			$parametar1 = $crud['kolona'];
		    			$parametar2 = 'ASC';
		    		}
				$meniji = helset::orderBy($parametar1, $parametar2)->get();
			}
    		
           $broj = count($meniji);
                if ($broj < 1){
                    return '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                }';
                } 
                else 
                {
                	$stringTabela = '';

              
                     foreach($meniji as $obj)
                     { // Vrti po redovima
	                     	$stringTabela = $stringTabela.'<tr>';
	                     	$stringTabela = $stringTabela.
	                     	'
	                     	<td>
		                     	<div style="display: grid; grid-template-columns: auto auto;">
			                     	<button style="width:60px;background:transparent;border:none;border-radius:0px;" id = "edit" class="btnDynamic "><i class="fa fa-pen" ></i>Edit</button>

			                     	
			                     		<div class="dropdown">
										  <button  style="width:65px;background:transparent;border:none;border-radius:0px;"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btnDynamic "><i class="fa fa-plus"></i>More</button>

										  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										   	<button id = "clone"  class=" dropdown-item"><i class="fa fa-clone" ></i>Clone</button>
										   	<button id = "insert"  class=" dropdown-item"><i class="fa fa-plus" ></i>Insert</button>

										  </div>
										</div>
		                    	</div>
	                     	</td>


	                     	';
	                       foreach(json_decode($obj) as $key => $value) //vrti kolone 
								{

									if ($tipoviKolonaArr[$key]=='boolean')
									{
										$stringTabela = $stringTabela.'<td>'.(boolval($value) ? 'true' : 'false').'</td>';
									}
									else
									{
										$stringTabela = $stringTabela.'<td>'.$value.'</td>';
									}
									
								}
									
	                       	$stringTabela = $stringTabela.'</tr>';
	                	
	                    }
	                    return $stringTabela;
                }

    	    //return json_encode($meniji);
  	
    }
    public function helenaSetovanjaKreirajModal()
    {

		    	$modalPrviDeo = "<div class=\"modal\" id=\"myModal\">
							  <div class=\"modal-dialog modal-lg\">
							    <div class=\"modal-content\">

							      <div class=\"modal-header\">
							        <h4 class=\"modal-title\">CRUD</h4>
							        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
							      </div>

							   
							      <div class=\"modal-body\">
							       	<div class=\"container register-form\">
							            <div class=\"form\" id=\"form\">
							                <div class=\"noteSetovanjaHelena\">
							                    <p></p>
							                </div>
							                <div class=\"form-content\">
							                	<form id=\"forma\">
								                    <div class=\"row mt-2\">";

		    	
		         $apps =  DB::select("

				      		select 
				      	c.column_name as kolona,c.data_type as tip,aa.opis,c.is_nullable
						from information_schema.columns c left outer join
						(
							SELECT c.column_name,pgd.description as opis
							FROM pg_catalog.pg_statio_all_tables as st
							  inner join pg_catalog.pg_description pgd on (pgd.objoid=st.relid)
							  inner join information_schema.columns c on (pgd.objsubid=c.ordinal_position
							    and  c.table_schema=st.schemaname and c.table_name=st.relname)
							    where c.table_schema = '".$this->sema."' and c.table_name = '".$this->tabela."'
						) aa
						on (aa.column_name = c.column_name)
						where  c.table_schema = '".$this->sema."' and c.table_name = '".$this->tabela."'	
						

					");
		         	$modalBody = "";
		            foreach($apps as $obj)
		                     { // Vrti po redovima
		                     		$kolona = $obj->kolona;
		                     		$opis = $obj->opis;
		                     		$tip = $obj->tip;
		                     		$is_nullable = $obj->is_nullable;
		                     		//print_r($tip.'<br>');
		                     		$crud = crudSettings::where('tabela','=',$this->tabelSaSemom)->where('tip_kolone','READONLY')->where('kolona',$kolona)->first();
		                     		$crudSelect = crudSettings::where('tabela','=',$this->tabelSaSemom)->where('tip_kolone','SELECT')->where('kolona',$kolona)->first();
		                     		$selectbox2 = "{$crudSelect['select_query']}";
									if ($selectbox2!='')
									{
										$selectCreate = "<select  class=\"form-control\" id=\"{$kolona}\">{$selectbox2}</select>";
									}

		                     		
		                     		if ($is_nullable=='NO')
		                     		{
		                     			$is_nullable = 'required';
		                     		}
		                     		else
		                     		{
		                     			$is_nullable = '';
		                     		}
		                     		//echo $obj->tip.'<br>';
		                     		if ($obj->tip == 'character varying')
		                     		{
		                     			if ($selectbox2 =='')
		                     			{
		                     				
			                     			$modalBody = $modalBody.
			                     			" 
				                     			<div class=\"col-md-4\">
						                            <div class=\"form-group\">
						                            	<label>".strtoupper($kolona)."</label>
						                                <input type=\"text\" class=\"form-control\" title=\"{$opis}\" placeholder=\"{$kolona} *\" id=\"{$kolona}\" {$is_nullable} {$crud['tip_kolone']} />
						                            </div>
					                        	</div>
				                        	";
			                        	}
			                        	else
			                        	{
			                        		
			                        		$modalBody = $modalBody.
			                     			" 
				                     			<div class=\"col-md-4\">
						                            <div class=\"form-group\">
						                            	<label>".strtoupper($kolona)."</label>
						                                {$selectCreate}
						                            </div>
					                        	</div>
				                        	";
			                        	}
		                     		}
		                     		elseif ($obj->tip == 'numeric')
		                     		{
		                     			if ($selectbox2 =='')
		                     			{
			                     			$modalBody = $modalBody.
			                     			" 
				                     			<div class=\"col-md-4\">
						                            <div class=\"form-group\">
						                            	<label>".strtoupper($kolona)."</label>
						                                <input type=\"number\" class=\"form-control\" title=\"{$opis}\" placeholder=\"{$kolona} *\" id=\"{$kolona}\" {$is_nullable} {$crud['tip_kolone']} />
						                            </div>
					                        	</div>
				                        	";
				                        }
			                        	else
			                        	{

			                        		$modalBody = $modalBody.
			                     			" 
				                     			<div class=\"col-md-4\">
						                            <div class=\"form-group\">
						                            	<label>".strtoupper($kolona)."</label>
						                                {$selectCreate}
						                            </div>
					                        	</div>
				                        	";
			                        	}
		                     		}
		                     		elseif ($obj->tip == 'timestamp without time zone')
		                     		{
		                     					$modalBody = $modalBody.
			                     			" 
				                     			<div class=\"col-md-4\">
						                            <div class=\"form-group\">
						                            	<label>".strtoupper($kolona)."</label>
						                                <input type=\"datetime\" class=\"form-control datum\" title=\"{$opis}\" placeholder=\"{$kolona} *\" id=\"{$kolona}\" {$is_nullable} {$crud['tip_kolone']} />
						                            </div>
					                        	</div>
				                        	";
		                     		}
		                     		elseif ($obj->tip == 'boolean')
		                     		{
		                     			$modalBody = $modalBody.
			                     			" 
				                     			<div class=\"col-md-4\">
						                            <div class=\"form-group\">
						                            	<label>".strtoupper($kolona)."</label>
						                                <select  class=\"form-control\" id=\"{$kolona}\">
						                                	<option value=\"true\">DA</option>
						                                	<option value=\"false\">NE</option>
						                                </select>
						                            </div>
					                        	</div>
				                        	";

		                     		}

						        	
							 }
					$modalZadnjiDeo = "</div>
											                    <button type=\"button\" id = \"edituj\" class=\"btn btn-primary\">Izmena</button>
											                    <button type=\"button\" id = \"unesi\" class=\"btn btn-primary\">Unos</button>
											                    <button type=\"button\" id = \"pretrazi\" class=\"btn btn-primary\">Pretrazi</button>
											                </form>
										                </div>
										            </div>
										        </div>
										      </div>

										      <div class=\"modal-footer\">
										        <button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\">Close</button>
										      </div>

										    </div>
										  </div>
										</div>";
						$modalceo = $modalPrviDeo.$modalBody.$modalZadnjiDeo;
		    	// $prom = json_encode($apps);
		    	return $modalceo;
  	
    }
    public function helenaEditovanjeTabele(request $request)
    	{	
        	try
	        	{ 
	        		$jsonVrednost = json_decode($request->jsonEditValues);//koje kolone ne mogu da updatuju
		            $obj = new helset;  
		            $nazivTabele = $obj->table; 
		            $crud = crudSettings::where('tabela','=',$nazivTabele)->where('tip_kolone','=','UPDATE_KEY')->get();
		            $update_keys = array();  
		           	foreach ($crud as $crud) 
		           		{
						    array_push($update_keys,$crud->kolona);
						}
					foreach($jsonVrednost as $key => $value) 
		               	{
		               		if (in_array($key, $update_keys))
		               		{
		               			 $uslovi[] = [$key,'=',$value];

		               		}
		               	}
		           	$updated_values = array();       
		              foreach($jsonVrednost as $key => $value) 
		               	{
		               		if (!in_array($key, $update_keys))
		               		{
		               			$updated_values[$key] = $value;
		               		}
					        
					    }
					 //   $postojiPk = helset::where($uslovi)->first();
	           		helset::where($uslovi)->update($updated_values);


	            }
	        catch(Exception $e)
		        {
		           echo $e->getMessage();
		        }

    	}
    public function helenaInsertReda(request $request)
    	{	
        	try
	        	{ 
	        		$jsonVrednost = json_decode($request->jsonEditValues);//koje kolone ne mogu da updatuju
		            $obj = new helset;  
		            $nazivTabele = $obj->table; 
		            $proveriInsert = crudSettings::where('tabela','=',$nazivTabele)->where('tip_kolone','=','INSERT_KEY')->get();
		            //$update_keys = array();  
		           	foreach ($proveriInsert as $red) 
		           		{
		           			$kljuc = $red->kolona;
		           			

		           			$nizKluceva = explode(',', $kljuc); //split string into array seperated by ', '
		           			
		           			$vratiGresku = array();
		           			$uslovZaProveru = [];
		      
								foreach($nizKluceva as $vrednost) //loop over values
								{	
									$prom = "$vrednost";
									$uslovZaProveru[] = [$vrednost,'=',$jsonVrednost->$prom];
								}
							
		           			$postojiPk = helset::where($uslovZaProveru)->first();

		           			if ($postojiPk != null) 
		           			{
							   $vratiGresku['greska'] = "Postoji red po kljucu: $kljuc";
							   $vratiGresku['klasa'] = 'error';
							   return $vratiGresku;
							}
						}
						$insertObjekat = new helset;     
       
					foreach($jsonVrednost as $key => $value) 
		               	{
		               		 $insertObjekat->$key =  $value;
		               	}
		        
	           		$insertObjekat->save();
	           			$vratiGresku['greska'] = "Uspesno insertovanje";
					   $vratiGresku['klasa'] = 'success';
					   return $vratiGresku;

	            }
	        catch(Exception $e)
		        {
		           echo $e->getMessage();
		        }

    	}
    
    
 }

