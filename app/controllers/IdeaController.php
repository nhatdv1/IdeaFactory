<?php
//use Davibennun\LaravelPushNotification\PushNotification;
//use Davibennun\LaravelPushNotification\Facades\PushNotification;
//use Pushnotification;

class IdeaController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $token = Request::header('token');
        if (User::check_token($token)) {
            $data = Idea::all();
            return Response::json(array(
                'success' => 1,
                'data' => $data
            ));
        } else return Response::json(array(
            'success' => 0,
            'message' => 'Token fail'
        ));
//        $a=new PushNotification();
//        $a->app('appNameIOS')
//            ->to($deviceToken)
//            ->send('Hello World, i`m a push message');
//        PushNotification::app('appNameIOS')
//            ->to($deviceToken)
//            ->send('Hello World, i`m a push message');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $token = Request::header('token');
        $category_id = Request::get('category_id');
        $title = Request::get('title');
        $description = Request::get('description');
        if (User::check_token($token) && Category::check_category($category_id) && Validation::check_Valid($title, $description)) {
            $id_user = DB::table('users')->where('token', $token)->pluck('id');
            $idea = new Idea();
            $idea->category_id = $category_id;
            $idea->title = $title;
            $idea->description = $description;
            $idea->date = date('Y-m-d');
            $idea->id_user = $id_user;
            $idea->save();
            return Response::json(array(
                'success' => 1,
                'message' => 'create idea successfully',
                'id' => $idea->id
            ));

        } else return Response::json(array(
            'success' => 0,
            'message' => 'Token or category_id fail or fields invalid'
        ));
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $token = Request::header('token');
        if (User::check_token($token)) {
            $idea = Idea::find($id);
            if ($idea) {
                return Response::json(array(
                    'success' => 1,
                    'data' => $idea
                ));
            } else {
                return Response::json(array(
                    'success' => 0,
                    'message' => 'Do not have idea with this id'
                ));
            }

        } else return Response::json(array(
            'success' => 0,
            'message' => 'Token fail'
        ));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $token = Request::header('token');
        if (User::check_token($token)) {
            $id_user1 = DB::table('users')->where('token', $token)->pluck('id');
            $id_user2 = DB::table('ideas')->where('id', $id)->pluck('id_user');
            if (!$id_user2) {
                return Response::json(array(
                    'success' => 0,
                    'message' => 'Do not have idea with this id'
                ));
                exit;
            }
            if ($id_user1 == $id_user2) {
                $idea = Idea::find($id);
                return Response::json(array(
                    'success' => 1,
                    'idea' => $idea
                ));
            } else return Response::json(array(
                'success' => 0,
                'message' => 'This idea not yours'
            ));
        } else return Response::json(array(
            'success' => 0,
            'message' => 'Token fail'
        ));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $token = Request::header('token');
        $category_id = Request::get('category_id');
        if (!$category_id) {
            return Response::json(array(
                'success' => 0,
                'message' => 'Category_id must have data'
            ));
            exit;
        }
        if (User::check_token($token)) {
            $id_user1 = DB::table('users')->where('token', $token)->pluck('id');
            $id_user2 = DB::table('ideas')->where('id', $id)->pluck('id_user');
            if ($id_user1 == $id_user2) {
                $idea = Idea::find($id);
                $idea->category_id = $category_id;
                $idea->title = Request::get('title');
                $idea->description = Request::get('description');
                $idea->id_user = $id_user1;
                $idea->save();
                return Response::json(array(
                    'success' => 1,
                    'message' => 'updated idea ' . $id
                ));
            } else return Response::json(array(
                'success' => 0,
                'message' => 'This idea not yours'
            ));
        } else return Response::json(array(
            'success' => 0,
            'message' => 'Token fail'
        ));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $token = Request::header('token');
        if (User::check_token($token)) {
            $id_user1 = DB::table('users')->where('token', $token)->pluck('id');
            $id_user2 = DB::table('ideas')->where('id', $id)->pluck('id_user');
            if ($id_user1 == $id_user2) {
                $idea = Idea::Find($id);
                $idea->delete();
                return Response::json(array(
                    'success' => 1,
                    'message' => 'delete idea ' . $id . ' success'
                ));
            } else return Response::json(array(
                'success' => 0,
                'message' => 'This idea not yours'
            ));
        } else return Response::json(array(
            'success' => 0,
            'message' => 'Token fail'
        ));
    }

    public function update_idea_like($id)
    {
        $idea = Idea::find($id);
        if ($idea) {
            $idea->number_like += 1;
            $idea->save();
            return Response::json(array(
                'success' => 1,
                'message' => 'Number like increase 1'
            ));
        } else return Response::json(array(
            'success' => 0,
            'message' => 'Do not have idea with this id'
        ));
    }

}
