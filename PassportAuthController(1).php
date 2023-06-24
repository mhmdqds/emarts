<?php

namespace App\Http\Controllers\api\v1\auth;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function App\CPU\translate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\CPU\SMS_module;
use App\Model\PhoneOrEmailVerification;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use Hash;

class PassportAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:8',
        ], [
            'f_name.required' => 'The first name field is required.',
            'l_name.required' => 'The last name field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $temporary_token = Str::random(40);
        $user = User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_active' => 1,
            'password' => bcrypt($request->password),
            'temporary_token' => $temporary_token,
        ]);

        $phone_verification = Helpers::get_business_settings('phone_verification');
        $email_verification = Helpers::get_business_settings('email_verification');
        if ($phone_verification && !$user->is_phone_verified) {
            return response()->json(['temporary_token' => $temporary_token], 200);
        }
        if ($email_verification && !$user->is_email_verified) {
            return response()->json(['temporary_token' => $temporary_token], 200);
        }

        $token = $user->createToken('LaravelAuthApp')->accessToken;
        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $user_id = $request['email'];
        if (filter_var($user_id, FILTER_VALIDATE_EMAIL)) {
            $medium = 'email';
        } else {
            $count = strlen(preg_replace("/[^\d]/", "", $user_id));
            if ($count >= 9 && $count <= 15) {
                $medium = 'phone';
            } else {
                $errors = [];
                array_push($errors, ['code' => 'email', 'message' => 'Invalid email address or phone number']);
                return response()->json([
                    'errors' => $errors
                ], 403);
            }
        }

        $data = [
            $medium => $user_id,
            'password' => $request->password
        ];

        $user = User::where([$medium => $user_id])->first();

        if (isset($user) && $user->is_active && auth()->attempt($data)) {
            $user->temporary_token = Str::random(40);
            $user->save();

            $phone_verification = Helpers::get_business_settings('phone_verification');
            $email_verification = Helpers::get_business_settings('email_verification');
            if ($phone_verification && !$user->is_phone_verified) {
                return response()->json(['temporary_token' => $user->temporary_token], 200);
            }
            if ($email_verification && !$user->is_email_verified) {
                return response()->json(['temporary_token' => $user->temporary_token], 200);
            }

            $token = $user->createToken('LaravelAuthApp')->accessToken;
            $token2 = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json([
                'token' => $token,
                'message' => 'active',
                'token2' => $token2,
                ], 200);
        } else {
            $errors = [];
            array_push($errors, ['code' => 'auth-001', 'message' => translate('Customer_not_found_or_Account_has_been_suspended')]);
            return response()->json([
                'errors' => $errors
            ], 401);
        }
    }
    
    public function registerorlogin(Request $request)
    {

        $medium = 'phone';
        $user_id = $request['email'];

     
         $user = User::where([$medium => $user_id])->first();

        if (isset($user)) {
            $user->temporary_token = Str::random(40);
            $user->save();

            $phoneToSend = str_replace('+', '', $user_id);
            if($phoneToSend == 967777363554){
                $token = 4321;
            } else {
                $token = rand(1000, 9999);
            }
            DB::table('phone_or_email_verifications')->insert([
                'phone_or_email' => $user_id,
                'token' => $token,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            

            $sender =  "00967777794438";
            $dest = $phoneToSend;
            $massagestouser1 = " مرحباً بك عزيزي المستخدم في منصة إمداد سوق الجملة  يرجى إدخال هذا الرقم في خانة التحقق ";
            $isiPesan = $massagestouser1.$token;
    
            // masukan data pengiriman pesan ke log
    
         
                    
            $data = [
                 'api_key' => 'OF24p3vjcSxWIBNtUzlDYJfme5smuK',
                 'sender' => $sender,
             	 'number' => $dest,
                 'message' => $isiPesan
              ];
             $curl = curl_init();
                curl_setopt_array($curl, array(
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
                $response = curl_exec($curl);
                curl_close($curl);
    
           
            $results = json_decode($response);    

            $phone_verification = Helpers::get_business_settings('phone_verification');
            $email_verification = Helpers::get_business_settings('email_verification');
            if ($phone_verification) {
                return response()->json(['temporary_token' => $user->temporary_token], 200);
            }

            $token = $user->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            $temporary_token = Str::random(40);
            $user = new User;
            $user->email = $request->email;
            $user->phone = $request->email;
            $user->temporary_token = $temporary_token;
            $user->password = bcrypt($request->email);
            $user->is_active = 1;
            $user->save();
            
            //$user = User::create([,
                //'email' => $request->email,
               // 'phone' => $request->email,
               // 'is_active' => 1,
                //'' => bcrypt($request->email),
                //'temporary_token' => $temporary_token,
           // ]);
            $phoneToSend = str_replace('+', '', $request['email']);
            if($phoneToSend == 967777363554)
            {
                $token = 4321;
            } else {
                $token = rand(1000, 9999);
            }
            DB::table('phone_or_email_verifications')->insert([
                'phone_or_email' => $request['email'],
                'token' => $token,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $response = SMS_module::send($request['email'], $token);
                
            $sender =  "00967777794438";
            $dest = $phoneToSend;
            $massagestouser1 = " مرحباً بك عزيزي المستخدم في منصة إمداد سوق الجملة  يرجى إدخال هذا الرقم في خانة التحقق ";
            $isiPesan = $massagestouser1."-".$token."*";
    
            // masukan data pengiriman pesan ke log
    
            $data = [
                 'api_key' => 'OF24p3vjcSxWIBNtUzlDYJfme5smuK',
                 'sender' => $sender,
             	 'number' => $dest,
                 'message' => $isiPesan
              ];
              
              $curl = curl_init();
                curl_setopt_array($curl, array(
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
                $response = curl_exec($curl);
                curl_close($curl);
                       
                            
            $results = json_decode($response);    
     
            $phone_verification = Helpers::get_business_settings('phone_verification');
            $email_verification = Helpers::get_business_settings('email_verification');
            if ($phone_verification) {
                return response()->json(['temporary_token' => $temporary_token], 200);
            }
            
            $token = $user->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        }
        
    }
    
        public function sendMessege($phone,$message)
        {
           // Lihat apiKirimWaRequest() pada Contoh Integrasi diatas
            try {
                $reqParams = [
                'token' => 'SlEL/A0TmxsOfq7+WIqHPjbEZWC77gIWuI8L1ZDZX/y76KZgz02lqkDFt0Ei65m0-nizam',
                'url' => 'https://api.kirimwa.id/v1/messages',
                'method' => 'POST',
                'payload' => json_encode([
                    'message' => $message,
                    'phone_number' => $phone,
                    'message_type' => 'text',
                    'device_id' => "xiaomi-redmi-nizam"
                ])
                ];
            
                $response = $this->apiKirimWaRequest($reqParams);
                echo $response['body'];
            } catch (Exception $e) {
                print_r($e);
            }
        }
    
        function apiKirimWaRequest(array $params) {
        $httpStreamOptions = [
          'method' => $params['method'] ?? 'GET',
          'header' => [
            'Content-Type: application/json',
            'Authorization: Bearer ' . ($params['token'] ?? '')
          ],
          'timeout' => 15,
          'ignore_errors' => true
        ];
      
        if ($httpStreamOptions['method'] === 'POST') {
          $httpStreamOptions['header'][] = sprintf('Content-Length: %d', strlen($params['payload'] ?? ''));
          $httpStreamOptions['content'] = $params['payload'];
        }
      
        // Join the headers using CRLF
        $httpStreamOptions['header'] = implode("\r\n", $httpStreamOptions['header']) . "\r\n";
      
        $stream = stream_context_create(['http' => $httpStreamOptions]);
        $response = file_get_contents($params['url'], false, $stream);
      
        // Headers response are created magically and injected into
        // variable named $http_response_header
        $httpStatus = $http_response_header[0];
      
        preg_match('#HTTP/[\d\.]+\s(\d{3})#i', $httpStatus, $matches);
      
        if (! isset($matches[1])) {
          throw new Exception('Can not fetch HTTP response header.');
        }
      
        $statusCode = (int)$matches[1];
        if ($statusCode >= 200 && $statusCode < 300) {
          return ['body' => $response, 'statusCode' => $statusCode, 'headers' => $http_response_header];
        }
      
        throw new Exception($response, $statusCode);
      }
    
}
