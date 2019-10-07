<?php

namespace Laravel\Http\Controllers\adminApps;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
// use Laravel\adminModels\wp_web_meni_grupe as helset;
use Laravel\adminModels\crud_edit_settings as crudSettings;
use Laravel\Traits\BindsDynamically;



class helgk_KontaController extends Controller
{
	 use BindsDynamically;
	//public $sema='';
	//public $tabela='helena_setovanje';
	public function __construct(Request $request)
	{
		//$kojiModel =  $request->param;
		$modelName = '\Laravel\adminModels\\'.'gk_racia';
		$this->modelName = $modelName;
		// $this->kojiModel = $kojiModel;
		$obj1 = new $modelName;  
		$obj1->setTable($request->sema.'.'.$request->tabela);
		//$this->table = 'gk.racia';
		$this->sema = $request->sema;//$obj1->samoSema;
		$this->tabela =$request->tabela;
		$this->tabelSaSemom = $request->sema.'.'.$request->tabela; 
	
	}
     public function helgk_KontaV(Request $request)
    {

         $koloneThead =  DB::select("
		      	select '<th style = \"width:119px;\">

		       	<button type=\"button\" class=\"btn btn-primary btn-sm\" onclick=\"funkcijaKlikPretraga()\" id = \"modal_pretraga\">
				 Flitriranje
				</button>
				<button id = \"insert\"  class=\"button btn btn-success btn-sm\"><i class=\"fa fa-plus\" ></i>Insert</button>
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
			 $naslovApp =  DB::select("
		      	select naslov_aplikacije from wp.web_aplikacije where sema = '".$this->sema."' and tabela = '".$this->tabela."'

			");
         foreach($naslovApp as $objApp){
			   $naslovAplikacije =  $objApp->naslov_aplikacije;
			  

			}
       $prom = json_encode($koloneThead);
      foreach(json_decode($prom) as $obj){
			   $param =  '<tr>'.$obj->kolone.'</tr>';
			  

			}
			//echo $this->tabela;
			// $kojiModel = $this->kojiModel;
			$sema = $this->sema;
			$tabela = $this->tabela;
			// $andr = new $this->modelName;
			// $andr->setTable($this->sema.'.'.$this->tabela);
			// print_r($andr->get());
			
        return view('admin/helgk_Konta',compact('param','param2','naslovAplikacije','sema','tabela'));	
    
    }

    public function helgk_KontaR(Request $request)
    {
    		// $andr = new $this->modelName;
    		// $andr->setTable($this->sema.'.'.$this->tabela);
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
				   $meniji = new $this->modelName;
				   $meniji->setTable($this->sema.'.'.$this->tabela);
				   $as = $meniji->where('sifra','like','5%')->get();
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
		    		$meniji = new $this->modelName;
		    		$meniji->setTable($this->sema.'.'.$this->tabela);
				 	$as = $meniji->where('sifra','like','5%')->orderBy($parametar1, $parametar2)->get();
				 	//print_r(count($as));

			}
    		
           $broj = count($as);
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

              
                     foreach($as as $obj)
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
										   	<!--<button id = "insert"  class=" dropdown-item"><i class="fa fa-plus" ></i>Insert</button>-->

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



    public function helgk_KontaM(Request $request)
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
		              
		                     		if ($request->tip_modala == 'EDIT')
		                     		{
			                     		$crud = crudSettings::where('tabela','=',$this->tabelSaSemom)->where('tip_kolone','DISABLED_EDIT')->where('kolona',$kolona)->first();
			                     		if ($crud != null)
			                     		{
				                     		$iskljuceno = 'DISABLED';
				                     	}
				                     	else
				                     	{
				                     		$iskljuceno = '';
				                     	}
			                     	}
			                     	elseif ($request->tip_modala == 'INSERT') {
			                     		$crud = crudSettings::where('tabela','=',$this->tabelSaSemom)->where('tip_kolone','DISABLED_INSERT')->where('kolona',$kolona)->first();
			                     		if ($crud != null)
			                     		{
				                     		$iskljuceno = 'DISABLED';
				                     	}
				                     	else
				                     	{
				                     		$iskljuceno = '';
				                     	}
			                     	}
			                     	elseif ($request->tip_modala == 'FILTRIRANJE')
			                     	{
			                     		$iskljuceno = '';
			                     	}
		                     		
		                     		$crudSelect = crudSettings::where('tabela','=',$this->tabelSaSemom)->where('tip_kolone','SELECT')->where('kolona',$kolona)->first();
		                     		$selectbox2 = $crudSelect['select_query'];
		                     		
		                     

		                     		if ($is_nullable=='NO')
		                     		{
		                     			$is_nullable = 'required';
		                     		}
		                     		else
		                     		{
		                     			$is_nullable = '';
		                     		}


		                     		if ($selectbox2!='')
									{
										
										$selectCreateBodyArray = DB::select($selectbox2);
										$selectCreateBody = '';
										foreach($selectCreateBodyArray as $bod)
										{
											$selectCreateBody = $selectCreateBody."<option value='{$bod->key}'>{$bod->val}</option>";
										}

										$selectCreate = "<select  class=\"form-control\" id=\"{$kolona}\" {$is_nullable} $iskljuceno>{$selectCreateBody}</select>";
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
						                       <input type=\"text\"  class=\"form-control\" title=\"{$opis}\" data-toggle=\"popover\" data-html=\"true\" data-trigger=\"manual\"  data-content=\"\" placeholder=\"{$kolona} *\" id=\"{$kolona}\" {$is_nullable} $iskljuceno />
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
		                     		elseif ($obj->tip == 'numeric' || $obj->tip == 'integer')
		                     		{
		                     			if ($selectbox2 =='')
		                     			{
			                     			$modalBody = $modalBody.
			                     			" 
				                     			<div class=\"col-md-4\">
						                            <div class=\"form-group\">
						                            	<label>".strtoupper($kolona)."</label>
						                                <input type=\"number\" step=\"any\" class=\"form-control\" title=\"{$opis}\" placeholder=\"{$kolona} *\" id=\"{$kolona}\" {$is_nullable} $iskljuceno />
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
						                                <input type=\"datetime\" class=\"form-control datumVreme\" title=\"{$opis}\" placeholder=\"{$kolona} *\" id=\"{$kolona}\" {$is_nullable} $iskljuceno />
						                            </div>
					                        	</div>
				                        	";
		                     		}
		                     		elseif ($obj->tip == 'date')
		                     		{
		                     					$modalBody = $modalBody.
			                     			" 
				                     			<div class=\"col-md-4\">
						                            <div class=\"form-group\">
						                            	<label>".strtoupper($kolona)."</label>
						                                <input type=\"datetime\" class=\"form-control datum\" title=\"{$opis}\" placeholder=\"{$kolona} *\" id=\"{$kolona}\" {$is_nullable} $iskljuceno />
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
						//print_r($request->tip_modala);
		    	// $prom = json_encode($apps);
		    	 return $modalceo;
  	
    }
    public function helgk_KontaE(request $request)
    	{	
        	try
	        	{ 
	        		$jsonVrednost = json_decode($request->jsonEditValues);
		            // $obj = new $this->modelName;  
		            // $obj->setTable($this->sema.'.'.$this->tabela);
		            $nazivTabele = $this->sema.'.'.$this->tabela; 

		            $crud = crudSettings::where('tabela','=',$nazivTabele)->where('tip_kolone','=','UPDATE_KEY')->get();
		            if (count($crud)>0)
		            {
			            $update_keys = array();  
			           	foreach ($crud as $crud) 
			           		{
							    array_push($update_keys,$crud->kolona);
							}
							//print_r($update_keys);
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
			               			// echo $key.'--'.$value;
	               				if($value=='')
			               			{
			               				// echo "prazna\n";	
				               			$updated_values[$key] = null;
			               			}
			               		else
				               		{
				               			// echo "Ima vrednost\n";
				               			$updated_values[$key] = $value;
				               		}
			               		}
						        
						    }
						 //   $postojiPk = helset::where($uslovi)->first();
						    $vratiGresku = array();
						    $editModel = new $this->modelName;
						     $editModel->setTable($this->sema.'.'.$this->tabela);
						     $mod = $editModel->where($uslovi)->get();
						     if(count($mod)>1)
						     {
						     
						     		$vratiGresku = array();
								   	$vratiGresku['greska'] = "Postoji vise od jednog reda za izmenu, proverite!!";
								    $vratiGresku['klasa'] = 'error';
								    return $vratiGresku;
						     }
						         if(count($mod)<1)
						     {
						     
						     		$vratiGresku = array();
								   	$vratiGresku['greska'] = "Ne postoji red za izmenu, proverite kljuceve!!";
								    $vratiGresku['klasa'] = 'error';
								    return $vratiGresku;
						     }
						     //print_r($updated_values);
		          		$editModel->where($uslovi)->update($updated_values);
						     $vratiGresku = array();
		           		$vratiGresku['greska'] = "Uspesna izmena";
						    $vratiGresku['klasa'] = 'success';
						   return $vratiGresku;
					}
					else
					   {
					   	$vratiGresku = array();
					   	$vratiGresku['greska'] = "Morate podesiti kljuceve za Izmenu!!";
					    $vratiGresku['klasa'] = 'error';
					   return $vratiGresku;
					   }

					 

	            }
	        catch(Exception $e)
		        {
		        	//dd($ex->getMessage());
		          echo $e->getMessage();
		        }

    	}
    public function helgk_KontaI(request $request)
    	{	
        	try
	        	{ 
	        		$jsonVrednost = json_decode($request->jsonEditValues);//koje kolone ne mogu da updatuju
		            // $obj = new $this->modelName; 
		            // $obj->setTable($this->sema.'.'.$this->tabela);
		            $nazivTabele = $this->sema.'.'.$this->tabela; 
		            $proveriInsertKey = crudSettings::where('tabela','=',$nazivTabele)->where('tip_kolone','=','INSERT_KEY')->get();
		            $proveriInsertValue = crudSettings::where('tabela','=',$nazivTabele)->where('tip_kolone','=','INSERT_VALUE')->get();
		            //$update_keys = array();  
		            if (count($proveriInsertKey)>0){

		           	foreach ($proveriInsertKey as $red) 
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
							 $postojiPk = new $this->modelName;
					   			$postojiPk->setTable($this->sema.'.'.$this->tabela);
		           			$newPostojiPK = $postojiPk->where($uslovZaProveru)->first();
		           			if ($newPostojiPK != null && count($proveriInsertValue)<1) 
		           			{
							   $vratiGresku['greska'] = "Postoji red po kljucu: $kljuc";
							   $vratiGresku['klasa'] = 'error';
							   return $vratiGresku;
							}
						}
					}
						$insertObjekat = new $this->modelName;    
						$insertObjekat->setTable($this->sema.'.'.$this->tabela);
       
					foreach($jsonVrednost as $key => $value) 
		               	{
		               		if (count($proveriInsertValue)>0)
		               		{
		               		foreach ($proveriInsertValue as $val) 
		               			{
		               				
		               				if ($val->kolona == $key)
		               				{
		               					$novaVrednostArr = DB::Select($val->insert_query)[0];
		               					$novaVred = reset($novaVrednostArr);
		               					$insertObjekat->$key =  $novaVred;
		               				}
		               				else
		               				{
		               						$insertObjekat->$key =  $value;
		               				
		               				}
		               			
		               			}
		               		}
		               		else
		               		{
		               				$insertObjekat->$key =  $value;
		               		}
		               		
		               	}
		               	// print_r($insertObjekat);
		        
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

