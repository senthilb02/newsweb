<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\View;
class newsController extends Controller
{
    public function newsSearch(Request $request)
	{
		
		
		$searchv=$request->input('searchNews');
		$serachv[]="";
		if(!empty($searchv))
		{
			$response = Curl::to('https://newsapi.org/v2/everything?q='.rawurlencode($searchv).'&sortBy=publishedAt&apiKey=d1cac4085e5b4ab8b74e7fa1b3ade0bf')
			 ->get();
			$newssearch= json_decode($response,true);
			foreach($newssearch['articles'] as  $key => $v)
			{
				$serachv[] = $v;
		 
			}
			$serache=array_filter($serachv);
			return response()->json(['success'=>true,'searchv'=>$serache]);
		}
		else
		{
		return response()->json(['success'=>false,'message'=>'News is not avilable']);
		}
	}
	
	public function websitesearch(Request $request)
	{
		$searchv=$request->input('searchwebsite');
		$datef=$request->input('date');
		$datet=$request->input('datet');
		$serachv[]="";
		if(!empty($searchv) && !empty($datef) && !empty($datet) )
		{
		$response = Curl::to('https://newsapi.org/v2/everything?domains='.$searchv.'&from='.$datef.'&to='.$datet.'&apiKey=d1cac4085e5b4ab8b74e7fa1b3ade0bf')
			 ->get();
		$newssearch= json_decode($response,true);
		if($newssearch['status']=='error')
		{
			return response()->json(['success'=>false,'message'=>$newssearch['message']]);
		}
		else
		{
			foreach($newssearch['articles'] as  $key => $v)
			{
				$serachv[] = $v;
		 
			}
			$serache=array_filter($serachv);
		
		return response()->json(['success'=>true,'searchv'=>$serache]);
		}
		}
		else
		{
			return response()->json(['success'=>false,'message'=>'News is not avilable date']);
		}
	    }
	
}
