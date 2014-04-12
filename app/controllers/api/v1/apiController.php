<?php

namespace Controllers\Api\V1;

use Asset;
use Sentry;
use BaseController;
use CollectionPlaylistAsset;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Request;
use User;
use DB;


class ApiController extends BaseController {

    public function users($id = null){

        $isAdvanced = count(array_keys(Request::query()));
        if($isAdvanced){
            //Is Advanced

            //search usage - /v1/users?search=de&fields=email,id,username

            $search = strlen(Request::query('search')) ? Request::query('search') : '.*';

            //fields
            $fields = explode(",", Request::query('fields'));
            $columns = strlen(Request::query('fields')) ? "" : "*";

            if(strlen(Request::query('fields'))){
                foreach ($fields as $value) {
                    $columns .=  $value . ',';
                }
                $columns = rtrim($columns, ',');
            }

            return $query = DB::select(DB::raw("SELECT $columns from users WHERE username REGEXP '$search';"));
        }
        else{
            //normal
            if($id==null){
                return $users = User::all();
            }
            else{
                try{
                    return User::findOrFail($id);
                }
                catch(ModelNotFoundException $e){

                }
            }

        }








    }

    public function cpa($id){
        $cpa = new CollectionPlaylistAsset;
        return $cpa->get_cpa_by_user_id($id);
    }

    public function assets($id = null, $token = null){
        if($id==null){
           return Asset::all();
        }
        else{

        	if (is_numeric($id) && $token == null) {

				$user = User::find($id);
				$assets = array();
				foreach ($user->assets as $asset)
				{
					$assets[] = $asset["attributes"];
				}
				return $assets;

        	}else{
        		switch ($token) {
        			case 'unassigned':
        				return Asset::unassigned($id);
        				break;

        			default:
        				return array();
        				break;
        		}

        	}





        }
    }


    public function test(){
        return json_encode(array(Request::query(), Request::ajax(), Request::cookie()));
    }



}
//Route::get('allusers', function(){
//$users = User::all();
//$data = array();
//foreach ($users as $key => $user) {
//    $data[$key] = $user->username .":".$user->id;
//    // $data[$key]['tokens'] = array();
//    // $data[$key]['tokens'][0] = $user->username;
//    // $data[$key]['tokens'][1] = "$user->id";
//}
//return $data;
//});
