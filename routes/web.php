<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// SETOVANJE BILANSA USPEHA
Route::get('setovanje_bilansa_uspeha', 'bilansiUspehaController@setovanje_bilansa_uspeha');
Route::get('zaglavljeKonta', 'bilansiUspehaController@zaglavljeKonta')->name('zaglavljeKonta');
Route::get('neklasifikovanaKonta', 'bilansiUspehaController@neklasifikovanaKonta')->name('neklasifikovanaKonta');
Route::get('tableDetail', 'bilansiUspehaController@tableDetail')->name('tableDetail');

Route::get('klasifikujKonto','bilansiUspehaController@klasifikujKonto');
Route::get('obrisiKlasifikacijuKonta','bilansiUspehaController@obrisiKlasifikacijuKonta');
// --------!!!!!!!!-------------


// SETOVANJE BILANSA STANJA
Route::get('setovanje_bilansa_stanja', 'bilansiStanjeController@setovanje_bilansa_stanja');
Route::get('zaglavljeKontaStanja', 'bilansiStanjeController@zaglavljeKontaStanja')->name('zaglavljeKontaStanja');
Route::get('neklasifikovanaKontaStanja', 'bilansiStanjeController@neklasifikovanaKontaStanja')->name('neklasifikovanaKontaStanja');
Route::get('tableDetailStanja', 'bilansiStanjeController@tableDetailStanja')->name('tableDetailStanja');

// --------!!!!!!!!-------------

// ANDROID MANIPULACIJA
		//Registracija korisnika
			Route::get('korisnici_i_prava', 'korisniciIPravaController@korisnici_i_prava');
			Route::get('androidUsers', 'korisniciIPravaController@androidUsers')->name('androidUsers');
			Route::get('androidAppsForUser/{korisnik}', 'korisniciIPravaController@androidAppsForUser')->name('androidAppsForUser');
			Route::post('upisAndUSer', 'korisniciIPravaController@upisAndUSer')->name('upisAndUSer');
			Route::post('updateAndUser', 'korisniciIPravaController@updateAndUser')->name('updateAndUser');
			Route::get('deleteAndUser', 'korisniciIPravaController@deleteAndUser')->name('deleteAndUser');
			Route::get('appsnotforuser','korisniciIPravaController@appsnotforuser')->name('appsnotforuser');
			Route::get('poveziKorisnikaIAplikaciju','korisniciIPravaController@poveziKorisnikaIAplikaciju')->name('poveziKorisnikaIAplikaciju');
			Route::get('sakrijAppOdKorisnika','korisniciIPravaController@sakrijAppOdKorisnika')->name('sakrijAppOdKorisnika');
		//Aplikacije
			Route::get('aplikacijeIndex', 'aplikacijeController@aplikacijeIndex');
			Route::get('androidMeniji', 'aplikacijeController@androidMeniji')->name('androidMeniji');
			Route::get('androidAplikacije/{meni}/{jezik}', 'aplikacijeController@androidAplikacije')->name('androidAplikacije');
			Route::get('androidSveAPlikacije', 'aplikacijeController@androidSveAPlikacije')->name('androidSveAPlikacije');
			Route::get('androidTabovi/{aplikacija}', 'aplikacijeController@androidTabovi')->name('androidTabovi');
			Route::get('androidSviTabovi', 'aplikacijeController@androidSviTabovi')->name('androidSviTabovi');
			Route::get('androidTaboviStavke/{aplikacija}/{br_taba}/{jezik}', 'aplikacijeController@androidTaboviStavke')->name('androidTaboviStavke');
			Route::get('meniUnos','aplikacijeController@meniUnos')->name('meniUnos');
			Route::get('meniIzmena','aplikacijeController@meniIzmena')->name('meniIzmena');
			Route::get('aplikacijaUnos','aplikacijeController@aplikacijaUnos')->name('aplikacijaUnos');
			Route::get('aplikacijaIzmena','aplikacijeController@aplikacijaIzmena')->name('aplikacijaIzmena');
			Route::get('tabUnos','aplikacijeController@tabUnos')->name('tabUnos');
			Route::get('tabIzmena','aplikacijeController@tabIzmena')->name('tabIzmena');
			Route::get('tabStavkeUnos','aplikacijeController@tabStavkeUnos')->name('tabStavkeUnos');
			Route::get('tabStavkeIzmena','aplikacijeController@tabStavkeIzmena')->name('tabStavkeIzmena');
			Route::get('tabStavkeBrisanje','aplikacijeController@tabStavkeBrisanje')->name('tabStavkeBrisanje');
			Route::get('tabBrisanje','aplikacijeController@tabBrisanje')->name('tabBrisanje');
			Route::get('aplikacijeBrisanje','aplikacijeController@aplikacijeBrisanje')->name('aplikacijeBrisanje');
			Route::get('meniBrisanje','aplikacijeController@meniBrisanje')->name('meniBrisanje');
			Route::get('tabStavkaBrisanje','aplikacijeController@tabStavkaBrisanje')->name('tabStavkaBrisanje');

// --------!!!!!!!!-------------
// ZAPISI
Route::get('zapisiIndex', 'adminApps\zapisiController@zapisiIndex');
Route::get('zapisiSqlLogger', 'adminApps\zapisiController@zapisiSqlLogger')->name('zapisiSqlLogger');
Route::get('nivelacijeUnos','cmatMPO\nivelacijeController@nivelacijeUnos')->name('nivelacijeUnos');
// --------!!!!!!!!-------------

// SETOVANJE TRASNFERA
Route::get('setovanjeTransferaIndex', 'adminApps\setovanjeTransferaController@setovanjeTransferaIndex');
Route::get('helenaSetovanjaR', 'adminApps\setovanjeTransferaController@helenaSetovanjaR')->name('helenaSetovanjaR');
Route::get('helenaSetovanjaKreirajModal', 'adminApps\setovanjeTransferaController@helenaSetovanjaKreirajModal')->name('helenaSetovanjaKreirajModal');
Route::post('helenaEditovanjeTabele', 'adminApps\setovanjeTransferaController@helenaEditovanjeTabele')->name('helenaEditovanjeTabele');
Route::post('helenaInsertReda', 'adminApps\setovanjeTransferaController@helenaInsertReda')->name('helenaInsertReda');

// --------!!!!!!!!-------------

// SETOVANJE B2ME ADMINS
Route::get('b2me_amdinsV', 'adminApps\setovanjeB2meAdminsController@setovanjeTransferaIndex')->name('b2me_amdinsV');
Route::get('b2me_amdinsR', 'adminApps\setovanjeB2meAdminsController@helenaSetovanjaR')->name('b2me_amdinsR');
Route::get('b2me_amdinsM', 'adminApps\setovanjeB2meAdminsController@helenaSetovanjaKreirajModal')->name('b2me_amdinsM');
Route::post('b2me_amdinsE', 'adminApps\setovanjeB2meAdminsController@helenaEditovanjeTabele')->name('b2me_amdinsE');
Route::post('b2me_amdinsI', 'adminApps\setovanjeB2meAdminsController@helenaInsertReda')->name('b2me_amdinsI');

// --------!!!!!!!!-------------

// SETOVANJE WP_WEB_MENI_GRUPE
Route::get('wp_web_meni_grupeV/{sema}/{tabela}', 'adminApps\wp_web_meni_grupeController@wp_web_meni_grupeV')->name('wp_web_meni_grupeV');
Route::get('wp_web_meni_grupeR/{sema}/{tabela}', 'adminApps\wp_web_meni_grupeController@wp_web_meni_grupeR')->name('wp_web_meni_grupeR');
Route::get('wp_web_meni_grupeM/{sema}/{tabela}', 'adminApps\wp_web_meni_grupeController@wp_web_meni_grupeM')->name('wp_web_meni_grupeM');
Route::post('wp_web_meni_grupeE/{sema}/{tabela}', 'adminApps\wp_web_meni_grupeController@wp_web_meni_grupeE')->name('wp_web_meni_grupeE');
Route::post('wp_web_meni_grupeI/{sema}/{tabela}', 'adminApps\wp_web_meni_grupeController@wp_web_meni_grupeI')->name('wp_web_meni_grupeI');

// --------!!!!!!!!-------------


// --------!!!!!!!!-------------
// BRISANJE KALKULACIJA
Route::get('brisanjeKalkulacijaIndex', 'adminApps\brisanjeKalkulacija@brisanjeKalkulacijaIndex');
Route::get('obrisiKalkulacije', 'adminApps\brisanjeKalkulacija@obrisiKalkulacije')->name('obrisiKalkulacije');

// --------!!!!!!!!-------------

// BRISANJE KALKULACIJA
Route::get('brisanjeInternihFakturaIndex', 'adminApps\brisanjeInternihFaktura@brisanjeInternihFakturaIndex');
Route::get('obrisiInternuFakturu', 'adminApps\brisanjeInternihFaktura@obrisiInternuFakturu')->name('obrisiInternuFakturu');

// --------!!!!!!!!-------------

// --------!!!!!!!!-------------CMAT MPO RUTE
// --------!!!!!!!!-------------
		// NIVELACIJE ZAGLAVLEJ
		Route::get('nivelacijeZaglavljeIndex', 'cmatMPO\nivelacijeZaglavljeController@nivelacijeZaglavljeIndex');//Zaboravio sam sufiks Controller
		Route::get('nivelacijeZaglavljeSpisak', 'cmatMPO\nivelacijeZaglavljeController@nivelacijeZaglavljeSpisak')->name('nivelacijeZaglavljeSpisak');
		Route::get('nivelacijeZaglavljePoslednji', 'cmatMPO\nivelacijeZaglavljeController@nivelacijeZaglavljePoslednji')->name('nivelacijeZaglavljePoslednji');
		Route::get('nivelacijeZaglavljeUnos','cmatMPO\nivelacijeZaglavljeController@nivelacijeZaglavljeUnos')->name('nivelacijeZaglavljeUnos');
		Route::get('nivelacijeZaglavljeBrisanje','cmatMPO\nivelacijeZaglavljeController@nivelacijeZaglavljeBrisanje')->name('nivelacijeZaglavljeBrisanje');
		
		// --------!!!!!!!!-------------
		// NIVELACIJE STAVKE
		Route::get('nivelacijeIndex', 'cmatMPO\nivelacijeController@nivelacijeIndex');//Zaboravio sam sufiks Controller
		Route::get('nivelacijeSpisak/{broj}', 'cmatMPO\nivelacijeController@nivelacijeSpisak')->name('nivelacijeSpisak');
		Route::get('nivelacijeUnos','cmatMPO\nivelacijeController@nivelacijeUnos')->name('nivelacijeUnos');
		Route::get('nivelacijeArtikli', 'cmatMPO\nivelacijeController@nivelacijeArtikli')->name('nivelacijeArtikli');
		Route::get('nivelacijeObjekti', 'cmatMPO\nivelacijeController@nivelacijeObjekti')->name('nivelacijeObjekti');
		Route::get('nivelacijeBrisanje','cmatMPO\nivelacijeController@nivelacijeBrisanje')->name('nivelacijeBrisanje');
		Route::get('nivelacijeJasper/{id}','cmatMPO\nivelacijeController@nivelacijeJasper')->name('nivelacijeJasper');

		// --------!!!!!!!!-------------

		// -------!!!!!!!!------------
			//UKALK
			Route::get('ukalkIndex', 'cmatMPO\ukalkController@ukalkIndex');
			Route::get('ukalkSpisak', 'cmatMPO\ukalkController@ukalkSpisak')->name('ukalkSpisak');
			Route::get('ukalkUnos', 'cmatMPO\ukalkController@ukalkUnos')->name('ukalkUnos');

			Route::get('nivelacijeArtikliKalk', 'cmatMPO\nivelacijeController@nivelacijeArtikliKalk')->name('nivelacijeArtikliKalk'); //samo za 4 dobavljaca fiktivni artikli

			Route::get('kalkSpisak/{broj}', 'cmatMPO\ukalkController@kalkSpisak')->name('kalkSpisak');
			Route::get('kalkUnos', 'cmatMPO\ukalkController@kalkUnos')->name('kalkUnos');
			Route::get('kalkulacijaBrisanje', 'cmatMPO\ukalkController@kalkulacijaBrisanje')->name('kalkulacijaBrisanje');


// --------!!!!!!!!------------- GLOBALNE




	// --------!!!!!!!!-------------CMAT MPO RUTE
					// --------!!!!!!!!-------------CMAT KADROVI RUTE
							Route::get('kadroviIndex', 'cmatMPO\kadroviController@kadroviIndex');
							Route::get('kadroviSpisak', 'cmatMPO\kadroviController@kadroviSpisak')->name('kadroviSpisak');
							Route::get('kadroviUnos', 'cmatMPO\kadroviController@kadroviUnos')->name('kadroviUnos');
					// --------!!!!!!!!-------------CMAT ZAPOSLENJA RUTE
							Route::get('zaposlenjaIndex', 'cmatMPO\zaposlenjaController@zaposlenjaIndex');
							Route::get('zaposlenjaSpisak', 'cmatMPO\zaposlenjaController@zaposlenjaSpisak')->name('zaposlenjaSpisak');
							Route::get('zaposlenjaKadrovi', 'cmatMPO\zaposlenjaController@zaposlenjaKadrovi')->name('zaposlenjaKadrovi');
							Route::get('zaposlenjaRadnje', 'cmatMPO\zaposlenjaController@zaposlenjaRadnje')->name('zaposlenjaRadnje');
							Route::get('zaposlenjaUnos', 'cmatMPO\zaposlenjaController@zaposlenjaUnos')->name('zaposlenjaUnos');
					// --------!!!!!!!!-------------CMAT OCENJIVANJE ZAPOSLENIH
							Route::get('oceneZaposleniIndex', 'cmatMPO\ocenaZaposlenihController@oceneZaposleniIndex');
							Route::post('oceneZaposleniSpisak', 'cmatMPO\ocenaZaposlenihController@oceneZaposleniSpisak')->name('oceneZaposleniSpisak');
							Route::post('ocenjeniSpisak', 'cmatMPO\ocenaZaposlenihController@ocenjeniSpisak')->name('ocenjeniSpisak');
							Route::get('ocenjivanjeUnos', 'cmatMPO\ocenaZaposlenihController@ocenjivanjeUnos')->name('ocenjivanjeUnos');
							Route::get('ocenaBrisanje', 'cmatMPO\ocenaZaposlenihController@ocenaBrisanje')->name('ocenaBrisanje');
					// --------!!!!!!!!-------------CMAT MAPIRANJE ARTIKALA SA ROBNIM GRUPAMA
							Route::get('rgIndex', 'cmatMPO\rgController@rgIndex');
							Route::post('artikliSpisak', 'cmatMPO\rgController@artikliSpisak')->name('artikliSpisak');
							Route::get('artikalVeza', 'cmatMPO\rgController@artikalVeza')->name('artikalVeza');
							Route::get('robneGrupeSpisak', 'cmatMPO\rgController@robneGrupeSpisak')->name('robneGrupeSpisak');
	// -------!!!!!!!!------------ 

Route::get('dobavljaciSpisak', 'DashboardController@dobavljaciSpisak')->name('dobavljaciSpisak');
Route::get('kreirajMeni', 'DashboardController@kreirajMeni')->name('kreirajMeni');

//	// -------!!!!!!!!------------
// AUTHENTICATION SISTEM
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// --------!!!!!!!!-------------