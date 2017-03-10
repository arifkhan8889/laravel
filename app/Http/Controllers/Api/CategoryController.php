<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category as Category;

class CategoryController extends Controller
{
  /**
     * index
     * 
     * This is used to show the user list
     * 
     * @return Response
     */
   function index(Request $req){
      $response = Category::all();
      $aaData = array();
            foreach ($response as $row) {
                $singleListArray = array();
                $singleListArray['id'] = $row['id'];
                $singleListArray['title'] = $row['title'];
                $singleListArray['description'] = $row['description'];
                $singleListArray['active'] = $row['active'] ? 'Yes' : 'No';
                $singleListArray['created_at'] = $row['created_at'];
                $singleListArray['updated_at'] = $row['updated_at'];
                $aaData[] = $singleListArray;
            }
      return response()->json(["data" => $aaData], 200, [], JSON_PRETTY_PRINT);
   }
  
     /**
     * store 
     * 
     * Store a new user data.
     *
     * @param  Request  $request
     * @return Response
     */
   function store(Request $request){
     $title = $request->input('title');
     $description = $request->input('description');
     $active = $request->input('active');
     $data = array();
     if($title == ''){
            $msg['message'] = 'Title required';
            return response()->json(["data" => $msg]);
     }
     $data['title'] = $title;
     $data['description'] = $description;
     $data['active'] = $active;
     $data['created_at'] = date('Y-m-d H:i:s');
     $data['updated_at'] = date('Y-m-d H:i:s');
     Category::create($data);
     $msg['message'] = 'Category Added Successfully';
     return response()->json(["data" => $msg]);
   }
   /**
    * 
    * update
    * 
    *  This is used to load user edit page
    * 
    * @param  Request  $request
    * @param     int $id
    * @return    Response
    */
   function update(Request $request){
        $title = $request->input('title');
        $description = $request->input('description');
        $active = $request->input('active');
        if($title==''){
            $msg['message'] = 'category name is required';
            return response()->json(["data" => $msg]);
        }
        $response = Category::where('title',$title)->get();
        print_r($response->toArray());exit;
        $data = array();
        $data['title'] = $title;
        $data['description'] = $description;
        $data['active'] = $active;
        $data['updated_at'] = date('Y-m-d H:i:s');
        Category::create($data);
        $msg['message'] = 'Category Added Successfully';
        return response()->json(["data" => $msg]);  
   }
   /**
    * destroy
    * 
    * This is used to destroy user
    *
    * @param int $id
    * @return Response
    */
   function destroy($id){
       DB::table('users')->delete($id);
       Session::flash('message','User Deleted Successfully!!');
       return redirect('user');
   }  
}
