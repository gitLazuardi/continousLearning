<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Http\Resources\Movies;
use App\Helpers\ApiHandler;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
class MovieController extends Controller
{
    public function omdb(Request $request) {
        $url = "http://www.omdbapi.com/?apikey=7b86ede0&s=".urlencode($request['s']); 
        $api = new ApiHandler();
        return $api->getPublic($url);
    }
    public function omdbDetail(Request $request) {
        $url = "http://www.omdbapi.com/?apikey=7b86ede0&i=".$request['i'];
        $api = new ApiHandler();
        return $api->getPublic($url);
    }

    public function index()
    {
        $movies = Movie::with('category')->latest()->get();
        return Movies::collection($movies);
    }

    public function indexCategory()
    {
        return response()->json(Category::all());
    }

    public function store()
    {
        request()->validate([
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        
        if (request('id')) {
            $movie = Movie::where('id', '=', request('id'));
            $movie->update([
                'category_id' => request('category_id'),
                'title' => request('title'),
                'description' => request('description'),
            ]);
        } else {
            $movie = Movie::create([
                'category_id' => request('category_id'),
                'title' => request('title'),
                'slug' => \Str::slug(request('title')),
                'description' => request('description'),
            ]);
        }
        return response()->json([
            'message' => 'Movie saved',
            'movie' => $movie,
        ]);
    }

    public function show(Movie $movie)
    {
        return $movie;
    }

    public function delete($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
    }

    public function ExportExcel($customer_data){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getProtection()->setSheet(true);
            $spreadSheet->getSecurity()->setLockWindows(true);
            $spreadSheet->getSecurity()->setLockStructure(true);
            $spreadSheet->getSecurity()->setWorkbookPassword('secret');
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($customer_data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Movies.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    function exportData(){
        $data = Movie::with('category')->get();
        $data_array [] = array("Movie Title","Category","Description");
        foreach($data as $data_item)
        {
            $data_array[] = array(
                'Title' =>$data_item->title,
                'Category' => $data_item->category->name,
                'Description' => $data_item->description,
            );
        }
        $this->ExportExcel($data_array);
    }
 
}
