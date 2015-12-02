<?php

namespace app\Http\Controllers;

use Request;
use Input;

class HomeController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Home Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $cube_temp;
    
    public function __construct() {
        //$this->middleware('guest');
        $this->cube_temp = array();
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {
        return view('welcome');
    }

    public function summary() {
        $result = array("status" => false);
        
        if (Request::isMethod('post') && Request::ajax()) {
            if (Input::has('indata')) {
                $result["status"] = true;
                
                $split = explode('<br />', nl2br(Input::get('indata')));
                $test_tam = trim($split[0]);
                $test_start = 1;
                
                for ($test = 1; $test <= $test_tam; $test++) {
                    $cube = explode(" ", trim($split[$test_start]));
                    $this->cube_temp = array();
                    
                    $cube_tam = $cube[0];
                    $cube_op = $cube[1];
                    $cube_opts = "";

                    $test_end = $test_start + $cube_op + 1;

                    for ($position = $test_start + 1; $position < $test_end; $position++) {
                        $sql = explode(" ", trim($split[$position]));
                        $cube_opts .= $this->processOperation($sql);
                        
                    }
                    
                    $test_start = $test_end;
                    $result["tests"][$test] = '<div class="col-md-4"><div class="well"><h3>Prueba '.$test.'</h3><p>'.$cube_opts.'</p></div></div>';
                }
            }
        }
        
        return response()->json($result);
    }
    
    private function processOperation($sql) {
        $summary = "";
        $type = $sql[0];
        
        switch ($type) {
            case "UPDATE":
                $point = (int) $sql[1] . $sql[2] . $sql[3];
                $this->cube_temp[$point] = (int) $sql[4];

                break;
            case "QUERY":
                $point_start = (int) $sql[1] . $sql[2] . $sql[3];
                $point_end = (int) $sql[4] . $sql[5] . $sql[6];
                $summary = 0;
                
                foreach ($this->cube_temp as $point => $value) {
                    if($point >= $point_start && $point <= $point_end){
                        $summary +=  $value;
                    }
                }

                $summary .= "</br>";
                break;
        }
        
        return $summary;
    }
    
}
