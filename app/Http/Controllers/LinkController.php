<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Link;
use Illuminate\Support\Str;


  

class LinkController extends Controller
{

    public function index()
    {
        $shortCode = Link::latest()->get();
        return view('link.shortCode', compact('shortCode'));

    }

    public function generate(Request $request)
    {
        $request->validate([
           'longUrl' => 'required|url'
        ]);
       $longUrl=trim($request->longUrl);
        if(substr($longUrl, -1)=="/") {
            $longUrl=substr($longUrl, 0, -1);
        } 
        if (strlen($longUrl)>10) {
            $shortCode=$this->getShortCode($longUrl);
            if ($shortCode===0) {
                $create['long_url'] = $longUrl;
                $create['short_code'] = $this->generateShortCode();
                Link::create($create);
                return response()->json(['status'=>'succes','message' => 'Короткая ссылка создана.','short_url'=>request()->getSchemeAndHttpHost()."/".$create['short_code']] ,200);
            } else {
                
                return response()->json(['status'=>'succes','message' => 'Короткая ссылка уже существует.','short_url'=>request()->getSchemeAndHttpHost()."/".$shortCode] ,200);
            }
        } else {
            return response()->json(['status'=>'error','message' => 'Ваша ссылка слишком короткая! Ее длинна должна быть не меньше 10 символов.'] ,200);
        }
    }

    public function shortCode(Request $request,$shortUrl)
    {
        $domen=request()->getSchemeAndHttpHost();
        $shortCode=str_replace($domen."/", '', $shortUrl);
        $find = Link::where('short_code', $shortCode)->first();
            return redirect($find->long_url);  
    }
    
    private function getShortCode($longUrl)
    {
        $shortCode = Link::where('long_url', $longUrl)->get();
        if (count($shortCode)==0) {
            return 0;
        } else {
            return $shortCode[0]->short_code;
        }
    }
    /*private function getDomen($longUrl) 
    {
        $arr_url=explode("/",$longUrl);
        return $arr_url[0]."//".$arr_url[2];
         
    }*/
    
    private function generateShortCode() 
    {
        do {
            $shortCode=Str::random(6);
            $result = Link::where('short_code', $shortCode)->get();
        } while (count($result)>0) ;
        return $shortCode;  
    }        
            
    

}

