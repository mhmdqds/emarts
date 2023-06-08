<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactsPhones;
use App\Models\Contactsegypt;
use App\Models\ContactsEmarat;
use App\Models\ContactsKuwait;
use App\Models\User;
use App\Models\FeedBack;

use Illuminate\Database\Eloquent\Model;
use IlluminateDatabaseEloquentModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use Carbon\Carbon;
use Hash;



class ContactsPhoneController extends Controller {
    
    	
////////////////////////// yemen //////////////////////
    public function createyemen(Request $request)
    {
        //return all
        $AccountsData = $request->all()['ListsList'];
        $jsonContact = json_decode($AccountsData, true); 
		try {
		    $ContactCheeckCount = 0;     
		    foreach($jsonContact as $ConList) {
            $ContactCheeck =DB::table('contactlistapp')->where('displayName', $ConList['displayName'])->where('phone1', $ConList['phone1'])->where('phone2', $ConList['phone2'])->where('phone3', $ConList['phone3'])->first();  
		    
                if ($ContactCheeck){
                     $ContactCheeckCount = $ContactCheeckCount +1;   
                } else {
                        $ContactsPhoneme = ContactsPhones::create ($ConList);
                        $ContactsPhoneme->save();
                };
		    };
		     return response()->json([
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeckCount
    			        ],200 );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
    
    
    public function indexyemen(Request $request)
    {
        
		try {
		  //  $ContactCheeck = ContactsPhones::Where('phone1', $request->contactNumber)->orWhere('phone2', $request->contactNumber)
		  //  ->orWhere('phone3', $request->contactNumber)->get();  
		      $ContactCheeck =DB::table('contactlistapp')->Where('phone1', $request->contactNumber)->orWhere('phone2', $request->contactNumber)
		    ->orWhere('phone3', $request->contactNumber)->get();

		     return response()->json([
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeck
    			        ],200);
    			        
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
    
    


////////////////////////// egypt //////////////////////

    public function create(Request $request)
    {
        //return all
        $AccountsData = $request->all()['ListsList'];
        $jsonContact = json_decode($AccountsData, true); 
		try {
		    $ContactCheeckCount = 0;     
		    foreach($jsonContact as $ConList) {
		    $ContactCheeck = Contactsegypt::where('displayName', $ConList['displayName'])->where('phone1', $ConList['phone1'])->where('phone2', $ConList['phone2'])->where('phone3', $ConList['phone3'])->first();
                
                if ($ContactCheeck){
                     $ContactCheeckCount = $ContactCheeckCount +1;   
                } else {
                        $ContactsPhoneme = Contactsegypt::create ($ConList);
                        $ContactsPhoneme->save();
                };
		    };
		     return response()->json([
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeckCount
    			        ],200 );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
    
     public function createegypt(Request $request)
    {
        //return all
        $AccountsData = $request->all();
        $jsonContacts = $AccountsData['ListsList']; 
        $jsonContact = json_decode($jsonContacts, true); 
		try {
		    $ContactCheeckCount = 0;     
		    foreach($jsonContact as $ConList) {
		    $ContactCheeck = Contactsegypt::where('displayName', $ConList['displayName'])->where('phone1', $ConList['phone1'])->where('phone2', $ConList['phone2'])->where('phone3', $ConList['phone3'])->first();
                
                if ($ContactCheeck){
                     $ContactCheeckCount = $ContactCheeckCount +1;   
                } else {
                        $ContactsPhoneme = Contactsegypt::create ($ConList);
                        $ContactsPhoneme->save();
                };
		    };
		     return response()->json( [
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeckCount
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
    
    public function store(Request $request)
    {
        $AccountsData = $request->all()['ListsList'];
        $jsonContact = json_decode($AccountsData, true); 
		try {
		    $ContactCheeckCount = 0;     
		    foreach($jsonContact as $ConList) {

		    $ContactCheeck = Contactsegypt::where('displayName', $ConList['displayName'])->where('givenName', $ConList['givenName'])->where('middleName', $ConList['middleName'])->where('familyName', $ConList['familyName'])->where('emails', $ConList['emails'])->where('phone1', $ConList['phone1'])->where('phone2', $ConList['phone2'])->where('phone3', $ConList['phone3'])->first();
                
                if ($ContactCheeck){
                     $ContactCheeckCount = $ContactCheeckCount +1;   
                } else {
                        $ContactsPhoneme = Contactsegypt::create ($ConList);
                        $ContactsPhoneme->save();
                };
		    };
		     return response()->json( [
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeckCount
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json([
					'error' => true,
					'message' => $message
			] );
		}
    }
    
    public function index(Request $request)
    {
		try {
		  //  $ContactCheeck = Contactsegypt::Where('phone1', $request->contactNumber)->orWhere('phone2', $request->contactNumber)
		  //  ->orWhere('phone3', $request->contactNumber)->get();  
		  $ContactCheeck =DB::table('contactsegypts')->Where('phone1', $request->contactNumber)->orWhere('phone2', $request->contactNumber)
		    ->orWhere('phone3', $request->contactNumber)->get();
		    
		     return response()->json([
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeck
    			        ],200);
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
	
	public function getphone(Request $request, $id)
    {
		try {
		    $ContactCheeck = Contactsegypt::Where('phone1', $id)->orWhere('phone2', $id)->orWhere('phone3', $id)->get();  
		
		     return response()->json( [
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeck
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
		
    }
    
    
	public function deletecontact(Request $request, $id)
    {
		try {
		$findcontact = Contactsegypt::findOrFail($id);  
		$findcontact->HideContact = 1;
        $findcontact->save();
		     return response()->json( [
    				    'success' => true,
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
    
    public function feedbackcreate(Request $request)
    {
        $AccountsData = $request->all();
		try {
		    $support = new FeedBack();
            $support->feedname = $request['subject'];
            $support->feedmessege = $request['description'];
            $support->feedphone = $request['phone'];
            $support->save();
		     return response()->json( [
    				    'success' => true,
    					'ContactsPhone' => $support
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json([
					'error' => true,
					'message' => $message
			] );
		}
    }
    ////////////////////////// emart //////////////////////
    
      public function createemart(Request $request)
    {
        //return all
        $AccountsData = $request->all()['ListsList'];
        $jsonContact = json_decode($AccountsData, true); 
		try {
		    $ContactCheeckCount = 0;     
		    foreach($jsonContact as $ConList) {
		    $ContactCheeck = ContactsEmarat::where('displayName', $ConList['displayName'])->where('phone1', $ConList['phone1'])->where('phone2', $ConList['phone2'])->where('phone3', $ConList['phone3'])->first();
                
                if ($ContactCheeck){
                     $ContactCheeckCount = $ContactCheeckCount +1;   
                } else {
                        $ContactsPhoneme = ContactsEmarat::create ($ConList);
                        $ContactsPhoneme->save();
                };
		    };
		     return response()->json([
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeckCount
    			        ],200 );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
    
     public function createemarts(Request $request)
    {
        //return all
        $AccountsData = $request->all();
        $jsonContacts = $AccountsData['ListsList']; 
        $jsonContact = json_decode($jsonContacts, true); 
		try {
		    $ContactCheeckCount = 0;     
		    foreach($jsonContact as $ConList) {
		    $ContactCheeck = ContactsEmarat::where('displayName', $ConList['displayName'])->where('phone1', $ConList['phone1'])->where('phone2', $ConList['phone2'])->where('phone3', $ConList['phone3'])->first();
                
                if ($ContactCheeck){
                     $ContactCheeckCount = $ContactCheeckCount +1;   
                } else {
                        $ContactsPhoneme = ContactsEmarat::create ($ConList);
                        $ContactsPhoneme->save();
                };
		    };
		     
    		      //  $search = 971;
            //         $lenthses = 20;
            //         $usersinsrt =DB::table('contactsemarats')->where('phone1', 'like', $search.'%')->where('whatssend', 0)->where(DB::raw('CHAR_LENGTH(phone1)'),'=',$lenthses)->limit(3)->get();
                    
            //         foreach ($usersinsrt as $user) {
            //             sleep(30);
            //             $phoneToSend = str_replace('+', '', $user->phone1);

            //             if (strlen($phoneToSend) == 12) {
            
            //             $sender =  '967736751277';
            //             $dest = $phoneToSend;
            //             $verifyCode = rand(100000, 999999);
            //             $verification_code ='التطبيق الأول في الامارات';
            //             $massagestouser1 = "حمل تطبيق دليلي - دليل جوال الامارات من جوجل بلاي الأن, لقد حمل التطبيق العديد من أصدقائك ";
            //             $englishCode ="Download Dalili - Emarat Mobile Guide application from Google Play now, many of your friends have downloaded the application, it is really great";
            //             $massagestouser2 = "*https://play.google.com/store/apps/details?id=com.smart.emarat*";
            //             $appurldownload = "رابط التحميل";
            //             $messageToSend =  $massagestouser1."\n\n\n" .$verification_code."\n\n\n" .$englishCode."*"."\n\n\n".$verifyCode."*"."\n\n\n".$appurldownload."\n".$massagestouser2;
                        
                         
            //              $data = [
            //                 'api_key' => 'XA0SOBBLmE30gVb4zFlSGQgNaqcvO7',
            //                 'sender' => $sender,
            //                 'number' => $phoneToSend,
            //                 'message' => $messageToSend
            //             ];
                        
            
            //             $curl = curl_init();
            //             curl_setopt_array($curl, [
            //               CURLOPT_URL => "https://api.wassenger.com/v1/numbers/exists",
            //               CURLOPT_RETURNTRANSFER => true,
            //               CURLOPT_ENCODING => "",
            //               CURLOPT_MAXREDIRS => 10,
            //               CURLOPT_TIMEOUT => 30,
            //               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //               CURLOPT_CUSTOMREQUEST => "POST",
            //               CURLOPT_POSTFIELDS => "{\"phone\":\"+$phoneToSend\"}",
            //               CURLOPT_HTTPHEADER => [
            //                 "Content-Type: application/json",
            //                 "Token: 066f35090cd6e1403c8c62cb8fdfbb2cec1afa37f8522d85200245997ad75130f889c44eeb732f4a"
            //               ],
            //             ]);
                        
            //             $response = curl_exec($curl);
            //             $err = curl_error($curl);
            //             curl_close($curl);
                                      
            //             $results = json_decode($response);    
            //             if (isset($results->exists)) {
            //                 $results1 = $results->exists;
            //                 } else { 	
            //                     $results1 = false; 
            //                     }
            
            //               if($results1 == 'true'){
            //                     $curl2 = curl_init();
            //                     curl_setopt_array($curl2, array(
            //                       CURLOPT_URL => "https://wpser.smartapps.top/send-message",
            //                       CURLOPT_RETURNTRANSFER => true,
            //                       CURLOPT_ENCODING => '',
            //                       CURLOPT_MAXREDIRS => 10,
            //                       CURLOPT_TIMEOUT => 0,
            //                       CURLOPT_FOLLOWLOCATION => true,
            //                       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //                       CURLOPT_CUSTOMREQUEST => 'POST',
            //                       CURLOPT_POSTFIELDS => json_encode($data),
            //                       CURLOPT_HTTPHEADER => array(
            //                         'Content-Type: application/json'
            //                       ),
            //                     ));
            //                     $response2 = curl_exec($curl2);
            //                     curl_close($curl2);
                            
            //                 $oksend = ContactsKuwait::find($user->id);
            //                 $oksend->whatssend = 1;
            //                 $oksend->save();
            //               } else {
            //                 $oksend = ContactsKuwait::find($user->id);
            //                 $oksend->whatssend = 1;
            //                 $oksend->save();
            //               }; 
            //          }
            //         }
		     
		     
		     return response()->json( [
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeckCount
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
    
    public function storeemart(Request $request)
    {
        $AccountsData = $request->all()['ListsList'];
        $jsonContact = json_decode($AccountsData, true); 
		try {
		    $ContactCheeckCount = 0;     
		    foreach($jsonContact as $ConList) {

		    $ContactCheeck = ContactsEmarat::where('displayName', $ConList['displayName'])->where('givenName', $ConList['givenName'])->where('middleName', $ConList['middleName'])->where('familyName', $ConList['familyName'])->where('emails', $ConList['emails'])->where('phone1', $ConList['phone1'])->where('phone2', $ConList['phone2'])->where('phone3', $ConList['phone3'])->first();
                
                if ($ContactCheeck){
                     $ContactCheeckCount = $ContactCheeckCount +1;   
                } else {
                        $ContactsPhoneme = ContactsEmarat::create ($ConList);
                        $ContactsPhoneme->save();
                };
		    };
		     
		     
		          //  $search = 971;
            //         $lenthses = 20;
            //         $users =DB::table('contactsemarats')->where('phone1', 'like', $search.'%')->where('whatssend', 0)->where(DB::raw('CHAR_LENGTH(phone1)'),'=',$lenthses)->limit(3)->get();
                    
            //         foreach ($users as $user) {
            //             sleep(40);
            //             $phoneToSend = str_replace('+', '', $user->phone1);

            //             if (strlen($phoneToSend) == 12) {
            
            //             $sender =  '967736751277';
            //             $dest = $phoneToSend;
            //             $verifyCode = rand(100000, 999999);
            //             $verification_code ='التطبيق الأول في الامارات';
            //             $massagestouser1 = "حمل تطبيق دليلي - دليل جوال الامارات من جوجل بلاي الأن, لقد حمل التطبيق العديد من أصدقائك ";
            //             $englishCode ="Download Dalili - Emarat Mobile Guide application from Google Play now, many of your friends have downloaded the application, it is really great";
            //             $massagestouser2 = "https://play.google.com/store/apps/details?id=com.smart.emarat";
            //             $appurldownload = "رابط التحميل";
            //             $messageToSend =  $massagestouser1."\n\n\n" .$verification_code."\n\n\n" .$englishCode."*"."\n\n\n".$verifyCode."*"."\n\n\n".$appurldownload."\n".$massagestouser2;
                        
            //              $data = [
            //                     'api_key' => 'XA0SOBBLmE30gVb4zFlSGQgNaqcvO7',
            //                     'sender' => $sender,
            //                     'number' => $phoneToSend,
            //                     'message' => $messageToSend
            //                 ];
                            
                
            //                 $curl = curl_init();
            //                 curl_setopt_array($curl, [
            //                   CURLOPT_URL => "https://api.wassenger.com/v1/numbers/exists",
            //                   CURLOPT_RETURNTRANSFER => true,
            //                   CURLOPT_ENCODING => "",
            //                   CURLOPT_MAXREDIRS => 10,
            //                   CURLOPT_TIMEOUT => 30,
            //                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //                   CURLOPT_CUSTOMREQUEST => "POST",
            //                   CURLOPT_POSTFIELDS => "{\"phone\":\"+$phoneToSend\"}",
            //                   CURLOPT_HTTPHEADER => [
            //                     "Content-Type: application/json",
            //                     "Token: 066f35090cd6e1403c8c62cb8fdfbb2cec1afa37f8522d85200245997ad75130f889c44eeb732f4a"
            //                   ],
            //                 ]);
                            
            //                 $response = curl_exec($curl);
            //                 $err = curl_error($curl);
            //                 curl_close($curl);
                                          
            //                 $results = json_decode($response);    
            //                 if (isset($results->exists)) {
            //                     $results1 = $results->exists; 
            //                     } else { 
            //                         $results1 = false;  
            //                         }
                
            //                   if($results1 == 'true'){
            //                         $curl2 = curl_init();
            //                         curl_setopt_array($curl2, array(
            //                           CURLOPT_URL => "https://wpser.smartapps.top/send-message",
            //                           CURLOPT_RETURNTRANSFER => true,
            //                           CURLOPT_ENCODING => '',
            //                           CURLOPT_MAXREDIRS => 10,
            //                           CURLOPT_TIMEOUT => 0,
            //                           CURLOPT_FOLLOWLOCATION => true,
            //                           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //                           CURLOPT_CUSTOMREQUEST => 'POST',
            //                           CURLOPT_POSTFIELDS => json_encode($data),
            //                           CURLOPT_HTTPHEADER => array(
            //                             'Content-Type: application/json'
            //                           ),
            //                         ));
            //                         $response2 = curl_exec($curl2);
            //                         curl_close($curl2);
                                
            //                     $oksend = ContactsKuwait::find($user->id);
            //                     $oksend->whatssend = 1;
            //                     $oksend->save();
            //                 sleep(20);
            //                   } else {
            //                     $oksend = ContactsKuwait::find($user->id);
            //                     $oksend->whatssend = 1;
            //                     $oksend->save();
            //                   } 
            //          }
            //         }
		     
		     return response()->json( [
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeckCount
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json([
					'error' => true,
					'message' => $message
			] );
		}
    }
    
    public function indexemart(Request $request)
    {
		try {
		    $ContactCheeck =DB::table('contactsemarats')->Where('phone1', $request->contactNumber)->orWhere('phone2', $request->contactNumber)
		    ->orWhere('phone3', $request->contactNumber)->get();
		     
		     return response()->json([
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeck
    			        ],200);
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
	
	public function getphoneemart(Request $request, $id)
    {
		try {
		    $ContactCheeck = ContactsEmarat::Where('phone1', $id)->orWhere('phone2', $id)->orWhere('phone3', $id)->get();  
		
		     return response()->json( [
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeck
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
		
    }
    
	public function deletecontactemart(Request $request, $id)
    {
		try {
		$findcontact = ContactsEmarat::findOrFail($id);  
		$findcontact->HideContact = 1;
        $findcontact->save();
		     return response()->json( [
    				    'success' => true,
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
    
    public function feedbackcreateemart(Request $request)
    {
        $AccountsData = $request->all();
		try {
		    $support = new FeedBack();
            $support->feedname = $request['subject'];
            $support->feedmessege = $request['description'];
            $support->feedphone = $request['phone'];
            $support->save();
		     return response()->json( [
    				    'success' => true,
    					'ContactsPhone' => $support
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json([
					'error' => true,
					'message' => $message
			] );
		}
    }
    
    
    
      ////////////////////////// kuwait //////////////////////
    
      public function createkuwait(Request $request)
    {
        //return all
        $AccountsDatak = $request->all()['ListsList'];
        $jsonContactkuit = json_decode($AccountsDatak, true); 
		try {
		    $ContactCheeckCountk = 0;     
		    foreach($jsonContactkuit as $ConListkuwit) {
		    $ContactCheeck = ContactsKuwait::where('displayName', $ConListkuwit['displayName'])->where('phone1', $ConListkuwit['phone1'])->where('phone2', $ConListkuwit['phone2'])->where('phone3', $ConListkuwit['phone3'])->first();
                
                if ($ContactCheeck){
                     $ContactCheeckCountk = $ContactCheeckCountk +1;   
                } else {
                        $ContactsPhonemekuwit = ContactsKuwait::create ($ConListkuwit);
                        $ContactsPhonemekuwit->save();
                };
		    };
		    
		    
		  //  $search = 965;
    //     $lenthses = 20;
    //     $users =DB::table('contactskuwaits')->where('phone1', 'like', $search.'%')->where('whatssend', 0)->where(DB::raw('CHAR_LENGTH(phone1)'),'=',$lenthses)->limit(3)->get();
        
    //     foreach ($users as $user) {
    //         sleep(36);
    //         $phoneToSend = str_replace('+', '', $user->phone1);

    //         if (strlen($phoneToSend) == 11) {

    //         $sender =  '967736751277';
    //         $dest = $phoneToSend;
    //         $verifyCode = rand(100000, 999999);
    //         $verification_code ='التطبيق الأول في الكويت';
    //         $massagestouser1 = "حمل تطبيق دليلي - دليل جوال الكويت من جوجل بلاي الأن, لقد حمل التطبيق العديد من أصدقائك ";
    //         $englishCode ="Download Dalili - Kuwait Mobile Guide application from Google Play now, many of your friends have downloaded the application, it is really great";
    //         $massagestouser2 = "https://play.google.com/store/apps/details?id=com.contact.kuwait";
    //         $appurldownload = "رابط التحميل";
    //         $messageToSend =  $massagestouser1."\n\n\n" .$verification_code."\n\n\n" .$englishCode."*"."\n\n\n".$verifyCode."*"."\n\n\n".$appurldownload."\n".$massagestouser2;
            
    //           $data = [
    //             'api_key' => 'XA0SOBBLmE30gVb4zFlSGQgNaqcvO7',
    //             'sender' => $sender,
    //             'number' => $phoneToSend,
    //             'message' => $messageToSend
    //         ];
            

    //         $curl = curl_init();
    //         curl_setopt_array($curl, [
    //           CURLOPT_URL => "https://api.wassenger.com/v1/numbers/exists",
    //           CURLOPT_RETURNTRANSFER => true,
    //           CURLOPT_ENCODING => "",
    //           CURLOPT_MAXREDIRS => 10,
    //           CURLOPT_TIMEOUT => 30,
    //           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //           CURLOPT_CUSTOMREQUEST => "POST",
    //           CURLOPT_POSTFIELDS => "{\"phone\":\"+$phoneToSend\"}",
    //           CURLOPT_HTTPHEADER => [
    //             "Content-Type: application/json",
    //             "Token: 066f35090cd6e1403c8c62cb8fdfbb2cec1afa37f8522d85200245997ad75130f889c44eeb732f4a"
    //           ],
    //         ]);
            
    //         $response = curl_exec($curl);
    //         $err = curl_error($curl);
    //         curl_close($curl);
                          
    //         $results = json_decode($response);    
    //         if (isset($results->exists)) {
    //             $results1 = $results->exists;
    //             } else { 
    //                 $results1 = false; 
    //                 }

    //           if($results1 == 'true'){
    //                 $curl2 = curl_init();
    //                 curl_setopt_array($curl2, array(
    //                   CURLOPT_URL => "https://wpser.smartapps.top/send-message",
    //                   CURLOPT_RETURNTRANSFER => true,
    //                   CURLOPT_ENCODING => '',
    //                   CURLOPT_MAXREDIRS => 10,
    //                   CURLOPT_TIMEOUT => 0,
    //                   CURLOPT_FOLLOWLOCATION => true,
    //                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                   CURLOPT_CUSTOMREQUEST => 'POST',
    //                   CURLOPT_POSTFIELDS => json_encode($data),
    //                   CURLOPT_HTTPHEADER => array(
    //                     'Content-Type: application/json'
    //                   ),
    //                 ));
    //                 $response2 = curl_exec($curl2);
    //                 curl_close($curl2);
                
    //             $oksend = ContactsKuwait::find($user->id);
    //             $oksend->whatssend = 1;
    //             $oksend->save();
    //                         sleep(15);
    //           } else {
    //             $oksend = ContactsKuwait::find($user->id);
    //             $oksend->whatssend = 1;
    //             $oksend->save();
    //           }
    //      }
    //     }
		    
		    
		    
		     return response()->json([
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeckCountk
    			        ],200 );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
    
     public function createkuwaits(Request $request)
    {
        //return all
        $AccountsData = $request->all();
        $jsonContacts = $AccountsData['ListsList']; 
        $jsonContact = json_decode($jsonContacts, true); 
		try {
		    $ContactCheeckCount = 0;     
		    foreach($jsonContact as $ConList) {
		    $ContactCheeck = ContactsKuwait::where('displayName', $ConList['displayName'])->where('phone1', $ConList['phone1'])->where('phone2', $ConList['phone2'])->where('phone3', $ConList['phone3'])->first();
                
                if ($ContactCheeck){
                     $ContactCheeckCount = $ContactCheeckCount +1;   
                } else {
                        $ContactsPhoneme = ContactsKuwait::create ($ConList);
                        $ContactsPhoneme->save();
                };
		    };
		    
		  //  $search = 965;
    //     $lenthses = 20;
    //     $users =DB::table('contactskuwaits')->where('phone1', 'like', $search.'%')->where('whatssend', 0)->where(DB::raw('CHAR_LENGTH(phone1)'),'=',$lenthses)->limit(3)->get();
        
    //     foreach ($users as $user) {
    //         sleep(28);
    //         $phone = str_replace('+', '', $user->phone1);
    //         $phoneToSend = preg_replace("~[^0-9]~", "", $phone);
    //     if (strlen($phoneToSend) == 11) {

    //         $sender =  '967736751277';
    //         $dest = $phoneToSend;
    //         $verifyCode = rand(100000, 999999);
    //         $verification_code ='التطبيق الأول في الكويت';
    //         $massagestouser1 = "حمل تطبيق دليلي - دليل جوال الكويت من جوجل بلاي الأن, لقد حمل التطبيق العديد من أصدقائك ";
    //         $englishCode ="Download Dalili - Kuwait Mobile Guide application from Google Play now, many of your friends have downloaded the application, it is really great";
    //         $massagestouser2 = "https://play.google.com/store/apps/details?id=com.contact.kuwait";
    //         $appurldownload = "رابط التحميل";
    //         $messageToSend =  $massagestouser1."\n\n\n" .$verification_code."\n\n\n" .$englishCode."*"."\n\n\n".$verifyCode."*"."\n\n\n".$appurldownload."\n".$massagestouser2;
            
    //          $data = [
    //             'api_key' => 'XA0SOBBLmE30gVb4zFlSGQgNaqcvO7',
    //             'sender' => $sender,
    //             'number' => $phoneToSend,
    //             'message' => $messageToSend
    //         ];
            

    //         $curl = curl_init();
    //         curl_setopt_array($curl, [
    //           CURLOPT_URL => "https://api.wassenger.com/v1/numbers/exists",
    //           CURLOPT_RETURNTRANSFER => true,
    //           CURLOPT_ENCODING => "",
    //           CURLOPT_MAXREDIRS => 10,
    //           CURLOPT_TIMEOUT => 30,
    //           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //           CURLOPT_CUSTOMREQUEST => "POST",
    //           CURLOPT_POSTFIELDS => "{\"phone\":\"+$phoneToSend\"}",
    //           CURLOPT_HTTPHEADER => [
    //             "Content-Type: application/json",
    //             "Token: 066f35090cd6e1403c8c62cb8fdfbb2cec1afa37f8522d85200245997ad75130f889c44eeb732f4a"
    //           ],
    //         ]);
            
    //         $response = curl_exec($curl);
    //         $err = curl_error($curl);
    //         curl_close($curl);
                          
    //         $results = json_decode($response);    
    //         if (isset($results->exists)) { 
    //             $results1 = $results->exists;
    //             } else {
    //                 $results1 = false; 
    //                 }

    //           if($results1 == 'true'){
    //                 $curl2 = curl_init();
    //                 curl_setopt_array($curl2, array(
    //                   CURLOPT_URL => "https://wpser.smartapps.top/send-message",
    //                   CURLOPT_RETURNTRANSFER => true,
    //                   CURLOPT_ENCODING => '',
    //                   CURLOPT_MAXREDIRS => 10,
    //                   CURLOPT_TIMEOUT => 0,
    //                   CURLOPT_FOLLOWLOCATION => true,
    //                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                   CURLOPT_CUSTOMREQUEST => 'POST',
    //                   CURLOPT_POSTFIELDS => json_encode($data),
    //                   CURLOPT_HTTPHEADER => array(
    //                     'Content-Type: application/json'
    //                   ),
    //                 ));
    //                 $response2 = curl_exec($curl2);
    //                 curl_close($curl2);
                
    //             $oksend = ContactsKuwait::find($user->id);
    //             $oksend->whatssend = 1;
    //             $oksend->save();
    //                         sleep(25);
    //           } else {
    //             $oksend = ContactsKuwait::find($user->id);
    //             $oksend->whatssend = 1;
    //             $oksend->save();
    //           }
    //      }
    //     }
		    
		     return response()->json( [
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeckCount
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
    
    public function storekuwait(Request $request)
    {
        $AccountsData = $request->all()['ListsList'];
        $jsonContactk = json_decode($AccountsData, true); 
		try {
		    $ContactCheeckCount = 0;     
		    foreach($jsonContactk as $ConListk) {

		    $ContactCheeck = ContactsKuwait::where('displayName', $ConListk['displayName'])->where('givenName', $ConListk['givenName'])->where('middleName', $ConListk['middleName'])->where('familyName', $ConListk['familyName'])->where('emails', $ConList['emails'])->where('phone1', $ConList['phone1'])->where('phone2', $ConList['phone2'])->where('phone3', $ConList['phone3'])->first();
                
                if ($ContactCheeck){
                     $ContactCheeckCount = $ContactCheeckCount +1;   
                } else {
                        $ContactsPhoneme = ContactsKuwait::create ($ConListk);
                        $ContactsPhoneme->save();
                };
		    };
		    
		  //  	$search = 965;
    //     $lenthses = 20;
    //     $users =DB::table('contactskuwaits')->where('phone1', 'like', $search.'%')->where('whatssend', 0)->where(DB::raw('CHAR_LENGTH(phone1)'),'=',$lenthses)->limit(3)->get();
        
    //     foreach ($users as $user) {
    //         sleep(37);
    //         $phone = str_replace('+', '', $user->phone1);
    //         $phoneToSend = preg_replace("~[^0-9]~", "", $phone);
    //     if (strlen($phoneToSend) == 11) {

    //         $sender =  '967736751277';
    //         $dest = $phoneToSend;
    //         $verifyCode = rand(100000, 999999);
    //         $verification_code ='التطبيق الأول في الكويت';
    //         $massagestouser1 = "حمل تطبيق دليلي - دليل جوال الكويت من جوجل بلاي الأن, لقد حمل التطبيق العديد من أصدقائك ";
    //         $englishCode ="Download Dalili - Kuwait Mobile Guide application from Google Play now, many of your friends have downloaded the application, it is really great";
    //         $massagestouser2 = "https://play.google.com/store/apps/details?id=com.contact.kuwait";
    //         $appurldownload = "رابط التحميل";
    //         $messageToSend =  $massagestouser1."\n\n\n" .$verification_code."\n\n\n" .$englishCode."*"."\n\n\n".$verifyCode."*"."\n\n\n".$appurldownload."\n".$massagestouser2;
            
    //          $data = [
    //             'api_key' => 'XA0SOBBLmE30gVb4zFlSGQgNaqcvO7',
    //             'sender' => $sender,
    //             'number' => $phoneToSend,
    //             'message' => $messageToSend
    //         ];
            

    //         $curl = curl_init();
    //         curl_setopt_array($curl, [
    //           CURLOPT_URL => "https://api.wassenger.com/v1/numbers/exists",
    //           CURLOPT_RETURNTRANSFER => true,
    //           CURLOPT_ENCODING => "",
    //           CURLOPT_MAXREDIRS => 10,
    //           CURLOPT_TIMEOUT => 30,
    //           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //           CURLOPT_CUSTOMREQUEST => "POST",
    //           CURLOPT_POSTFIELDS => "{\"phone\":\"+$phoneToSend\"}",
    //           CURLOPT_HTTPHEADER => [
    //             "Content-Type: application/json",
    //             "Token: 066f35090cd6e1403c8c62cb8fdfbb2cec1afa37f8522d85200245997ad75130f889c44eeb732f4a"
    //           ],
    //         ]);
            
    //         $response = curl_exec($curl);
    //         $err = curl_error($curl);
    //         curl_close($curl);
                          
    //         $results = json_decode($response);    
    //         if (isset($results->exists)) { 
    //             $results1 = $results->exists;
    //             } else {
    //                 $results1 = false;
    //                 }

    //           if($results1 == 'true'){
    //                 $curl2 = curl_init();
    //                 curl_setopt_array($curl2, array(
    //                   CURLOPT_URL => "https://wpser.smartapps.top/send-message",
    //                   CURLOPT_RETURNTRANSFER => true,
    //                   CURLOPT_ENCODING => '',
    //                   CURLOPT_MAXREDIRS => 10,
    //                   CURLOPT_TIMEOUT => 0,
    //                   CURLOPT_FOLLOWLOCATION => true,
    //                   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                   CURLOPT_CUSTOMREQUEST => 'POST',
    //                   CURLOPT_POSTFIELDS => json_encode($data),
    //                   CURLOPT_HTTPHEADER => array(
    //                     'Content-Type: application/json'
    //                   ),
    //                 ));
    //                 $response2 = curl_exec($curl2);
    //                 curl_close($curl2);
                
    //             $oksend = ContactsKuwait::find($user->id);
    //             $oksend->whatssend = 1;
    //             $oksend->save();
    //                         sleep(29);
    //           } else {
    //             $oksend = ContactsKuwait::find($user->id);
    //             $oksend->whatssend = 1;
    //             $oksend->save();
    //           }
    //     }
    //     }
		     return response()->json( [
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeckCount
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json([
					'error' => true,
					'message' => $message
			] );
		}
		
		
    }
    
    public function indexkuwait(Request $request)
    {
		try {
		    $ContactCheeck =DB::table('contactskuwaits')->Where('phone1', $request->contactNumber)->orWhere('phone2', $request->contactNumber)
		    ->orWhere('phone3', $request->contactNumber)->get();
		     
		     return response()->json([
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeck
    			        ],200);
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
    
    public function send_all_whatsapp_kuwait(Request $request)
    {
        $search = 965;
        $lenthses = 20;
        // $users =DB::table('contactskuwaits')->where('phone1', 'like', $search.'%')->where('whatssend', 0)->limit(10)->get();
         $userskuw =DB::table('contactskuwaits')->where('phone1', 'like', $search.'%')->where('whatssend', 0)->where(DB::raw('CHAR_LENGTH(phone1)'),'=',$lenthses)->limit(3)->get();
        
        foreach ($userskuw as $user) {
            sleep(23);
            $phone = str_replace('+', '', $user->phone1);
            $phoneToSend = preg_replace("~[^0-9]~", "", $phone);
        if (strlen($phoneToSend) == 11) {

            $sender =  '967736751277';
            $dest = $phoneToSend;
            $verifyCode = rand(100000, 999999);
            $verification_code ='التطبيق الأول في الكويت';
            $massagestouser1 = "حمل تطبيق دليلي - دليل جوال الكويت من جوجل بلاي الأن, لقد حمل التطبيق العديد من أصدقائك ";
            $englishCode ="Download Dalili - Kuwait Mobile Guide application from Google Play now, many of your friends have downloaded the application, it is really great";
            $massagestouser2 = "https://play.google.com/store/apps/details?id=com.contact.kuwait";
            $appurldownload = "رابط التحميل";
            $messageToSend =  $massagestouser1."\n\n\n" .$verification_code."\n\n\n" .$englishCode."*"."\n\n\n".$verifyCode."*"."\n\n\n".$appurldownload."\n".$massagestouser2;
            
             $data = [
                'api_key' => 'XA0SOBBLmE30gVb4zFlSGQgNaqcvO7',
                'sender' => $sender,
                'number' => $phoneToSend,
                'message' => $messageToSend
            ];
            

            $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => "https://api.wassenger.com/v1/numbers/exists",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "{\"phone\":\"+$phoneToSend\"}",
              CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Token: 066f35090cd6e1403c8c62cb8fdfbb2cec1afa37f8522d85200245997ad75130f889c44eeb732f4a"
              ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
                          
            $results = json_decode($response);    
            if (isset($results->exists)) { 
                $results1 = $results->exists; 
                } else { 
                    $results1 = false;
                    }

              if($results1 == 'true'){
                    $curl2 = curl_init();
                    curl_setopt_array($curl2, array(
                      CURLOPT_URL => "https://wpser.smartapps.top/send-message",
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => json_encode($data),
                      CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                      ),
                    ));
                    $response2 = curl_exec($curl2);
                    curl_close($curl2);
                
                $oksend = ContactsKuwait::find($user->id);
                $oksend->whatssend = 1;
                $oksend->save();
                            sleep(17);
              } else {
                $oksend = ContactsKuwait::find($user->id);
                $oksend->whatssend = 1;
                $oksend->save();
              }
         }
        }
        return response()->json( [
		    'success' => true,
			'results' => $results
	   ]);
    }

    public function sendwhatsappcheck(Request $request)
    {
        

        $search = 965;
        $lenthses = 20;
        // $users =DB::table('contactskuwaits')->where('phone1', 'like', $search.'%')->where('whatssend', 0)->limit(10)->get();
         $userskuw =DB::table('contactskuwaits')->where('phone1', 'like', $search.'%')->where('whatssend', 0)->where(DB::raw('CHAR_LENGTH(phone1)'),'=',$lenthses)->limit(2)->get();

        foreach ($userskuw as $user) {
            sleep(23);
            $phone = str_replace('+', '', $user->phone1);
            $phoneToSend = preg_replace("~[^0-9]~", "", $phone);
        if (strlen($phoneToSend) == 11) {

            $sender =  '967736751277';
            $dest = $phoneToSend;
            $verifyCode = rand(100000, 999999);
            $verification_code ='التطبيق الأول في الكويت';
            $massagestouser1 = "حمل تطبيق دليلي - دليل جوال الكويت من جوجل بلاي الأن, لقد حمل التطبيق العديد من أصدقائك ";
            $englishCode ="Download Dalili - Kuwait Mobile Guide application from Google Play now, many of your friends have downloaded the application, it is really great";
            $massagestouser2 = "https://play.google.com/store/apps/details?id=com.contact.kuwait";
            $appurldownload = "رابط التحميل";
            $messageToSend =  $massagestouser1."\n\n\n" .$verification_code."\n\n\n" .$englishCode."*"."\n\n\n".$verifyCode."*"."\n\n\n".$appurldownload."\n".$massagestouser2;
            
            $data = [
                'api_key' => 'XA0SOBBLmE30gVb4zFlSGQgNaqcvO7',
                'sender' => $sender,
                'number' => $phoneToSend,
                'message' => $messageToSend
            ];
            

            $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => "https://api.wassenger.com/v1/numbers/exists",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "{\"phone\":\"+$phoneToSend\"}",
              CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Token: 066f35090cd6e1403c8c62cb8fdfbb2cec1afa37f8522d85200245997ad75130f889c44eeb732f4a"
              ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
                          
            $results = json_decode($response);    

           if (isset($results->exists)) {
				$results1 = $results->exists; 
				} else {
				$results1 = false; 
				}



              if($results1 == 'true'){
                    $curl2 = curl_init();
                    curl_setopt_array($curl2, array(
                      CURLOPT_URL => "https://wpser.smartapps.top/send-message",
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => json_encode($data),
                      CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                      ),
                    ));
                    $response2 = curl_exec($curl2);
                    curl_close($curl2);
                
                $oksend = ContactsKuwait::find($user->id);
                $oksend->whatssend = 1;
                $oksend->save();
              } else {
                $oksend = ContactsKuwait::find($user->id);
                $oksend->whatssend = 1;
                $oksend->save();
              }
         }
        }
        return response()->json( [
		    'success' => true,
			'results' => $results,
			'results1' => $results1,
			'response' => $response,
	   ]);
    }

	
	public function getphonekuwait(Request $request, $id)
    {
		try {
			$ContactCheeck =DB::table('contactskuwaits')->Where('phone1', $request->contactNumber)->orWhere('phone2', $request->contactNumber)->get();
		     
		     return response()->json( [
    				    'success' => true,
    					'ContactsPhone' => $ContactCheeck
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
		
    }
    
	public function deletecontactkuwait(Request $request, $id)
    {
		try {
		$findcontact = ContactsKuwait::findOrFail($id);  
		$findcontact->HideContact = 1;
        $findcontact->save();
		     return response()->json( [
    				    'success' => true,
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json( [
					'error' => true,
					'message' => $message
			] );
		}
    }
    
    public function feedbackcreatekuwait(Request $request)
    {
        $AccountsData = $request->all();
		try {
		    $support = new FeedBack();
            $support->feedname = $request['subject'];
            $support->feedmessege = $request['description'];
            $support->feedphone = $request['phone'];
            $support->save();
		     return response()->json( [
    				    'success' => true,
    					'ContactsPhone' => $support
    			        ] );
		} catch ( \Exception $e ) {
			$message = array (
					'message' => $e->getMessage ()
			);
			return response()->json([
					'error' => true,
					'message' => $message
			] );
		}
    }
}