<?php
use Tymon\JWTAuth\Exceptions\JWTException;

class APIController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function register_device()
    {
        $deviceType = Request::get('deviceType');
        $screenWidth = Request::get('screenWidth');
        $screenHeight = Request::get('screenHeight');
        $pushToken = Request::header('pushToken');
        $deviceName = Request::get('deviceName');
        $check = ['deviceType' => $deviceType, 'screenWidth' => $screenWidth, 'screenHeight' => $screenHeight,
            'deviceName' => $deviceName];
        $rules = [
            'deviceType' => 'required',
            'deviceName' => 'required',
            'screenWidth' => 'required|numeric',
            'screenHeight' => 'required|numeric',
        ];
        $deviceTypeSample = array('android', 'ios', 'winphone');
        if (!in_array($deviceType, $deviceTypeSample)) {
            return Response::json(array(
                'success' => 0,
                'message' => 'deviceType must in Android,ios,winphone'
            ));
            exit;
        }

        $validator = Validator::make($check, $rules);
        if ($validator->passes()) {
            if (User::check_token($pushToken)) {
                $id = DB::table('devices')->insertGetId(
                    array(
                        'deviceType' => $deviceType,
                        'deviceName' => $deviceName,
                        'screenWidth' => $screenWidth,
                        'screenHeight' => $screenHeight
                    )
                );
                if ($id) {
                    return Response::json(array(
                        'success' => 1,
                        'message' => 'success',
                        'data' => $id
                    ));
                } else return Response::json(array(
                    'success' => 0,
                    'message' => 'fail'
                ));
            } else return Response::json(array(
                'success' => 0,
                'message' => 'token invalid'
            ));
        }
        if ($validator->fails()) return Response::json(array(
            'success' => 0,
            'message' => 'data input invalid'
        ));
    }

    public function getDataUser($id){
        $token= Request::header('token');
        $data= DB::table('users')->where('id',$id)->select('email','image','name','lastLogin')->first();
//        $localFileName  = public_path() . '/assets/imageOfUser' . $data->email.'/'.$data->image;
//        $fileData = file_get_contents($localFileName);
//        $ImgfileEncode = base64_encode($fileData);
        if (User::check_token($token)){
            return Response::json(array(
                'success'=>1,
                'data' =>$data,
                'image' =>url().'/assets/imageOfUser' . $data->email.'/'.$data->image
            ));
        } else return Response::json(array(
            'success'=>0,
            'message' =>'token failed.'
        ));
    }

    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $email = Request::get('email');
        $password = Request::get('password');
        $credentials = ['email' => $email, 'password' => $password];
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];
        $validator = Validator::make($credentials, $rules);
        if ($validator->passes()) {
            if (Auth::attempt($credentials)) {
                try {
                    // attempt to verify the credentials and create a token for the user
                    $token = time() . JWTAuth::attempt($credentials);
                    if (!$token) {
                        return Response::json(['error' => 'invalid_credentials'], 401);
                    }
                } catch (JWTException $e) {
                    // something went wrong whilst attempting to encode the token
                    return Response::json(['error' => 'could_not_create_token'], 500);
                }
                DB::table('users')->where('id', '=', Auth::id())->update(array(
                    'token' => $token,
                    'lastLogin' => date('Y-m-d h:i:s',time()+7*3600)
                ));

                return Response::json(array(
                    'success' => 1,
                    'message' => 'Successfully login.',
                    'token' => $token,
                    'lastLogin' =>date('Y-m-d h:i:s',time()+7*3600),
                    'id'=>Auth::id()
                ));
            } else return Response::json(array(
                'success' => 0,
                'message' => 'Email or password fail!'
            ));
        }
    }

    public function logout() {
        $token=Request::get('token');
//        $token=base64_encode($token2);
        JWTAuth::invalidate($token);
    }


    public function register()
    {
        $name = Request::get('name');
        $email = Request::get('email');
        $password = Request::get('password');

        if (Request::hasFile("image")) {
            $destinationPath = public_path() . '/assets/imageOfUser' . $email;
            $img=Request::file('image');
            $file = Request::file('image')->getClientOriginalName();

            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);

//            echo $filename . ' ' . $extension;
            $images=$filename.'.'.$extension;
            $img->move($destinationPath, $images);
        }
        //Join array elements with a string

        $data = ['name' => $name, 'email' => $email, 'password' => $password, 'images' => $images];
        $rules = [
            'name' => '',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];
        $validator = Validator:: make($data, $rules);
        if ($validator->passes()) {
            $success = DB::table('users')->insertGetId(
                array(
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'image' => $images,
                    'created_at' => date('Y-m-d h:m:s')
                )
            );

            if ($success) {
                $result = Response::json(array(
                    'success' => 1,
                    'message' => 'Create user successfully',
                    'data' => $data,
                    'id' =>$success
                ));
            } else {
                $result = Response::json(array(
                    'success' => 0,
                    'message' => 'Cannot create user, please again!',
                    'data' => null
                ));
            }
            return $result;
        }

        if ($validator->fails()) {
            $result = Response::json(array(
                'success' => 0,
                'message' => 'Please check information!',
            ));
            return $result;
        }
    }

    public function get_categories()
    {
        $data = DB::table('categorys')->get();
        if ($data) return Response::json(array(
            'success' => 1,
            'categories' => $data
        ));
        else if (!$data) return Response::json(array(
            'success' => 0,
            'message' => 'Error load categories'
        ));
    }
}
