<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Attachment;
use App\Board;
class AttachmentsController extends Controller
{


    public function __construct(){
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1.전송받은 파일을 지정된 폴더에 저장한다. / 어느폴더 ?
        // 2.파일정보를 attachments에 저장장한다.
        // 3.잘 저장 되었다는 결과를 client에게 송신한다.
        // 4.public/files/사용자_아이디/

        // $attachment = null;
        // \Log::debug('AttachmentsController store', ['stpe'=>1]);
        if($request->hasFile('file')) {

            /****** 1번 구현 *******/ 
            $file = $request->file('file');
            
            $filename = /*str_random().*/filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL); //getClientOriginalName 파일 원본이름으로 저장
            $bytes = $file->getSize();  //받은 파일의 사이즈를 구함.
            $user = \Auth::user();  //users ORM
            $path = public_path('files') . DIRECTORY_SEPARATOR .  $user->id;    //public_path : 실제 경로를 리턴해준다.
            
            //파일을 저장할 폴더가 없으면 생성
            if (!File::isDirectory($path)) {    //라라벨에 $path라는 폴더의 유무를 확인하고 true/false값을 반환
                File::makeDirectory($path, 0777, true, true);   //해당 디렉토리에대한 권한을 부여
            }
            
            $file->move($path, $filename);//$path (어느 폴더로) $filename(어떤 이름으로) 저장
          /****************************/

            /****** 2번 구현 *******/ 
            $payload = [    //추가할 정보
                    'filename'=>$filename,
                    'bytes'=> $bytes,
                    'mime'=>$file->getClientMimeType()
                ];
                
            $attachment =  Attachment::create($payload);    //데이터 삽입
             /****************************/
        }

        // \Log::debug('AttachmentsController store', ['stpe'=>7]);
        return response()->json($attachment, 200);//200(정상수행)



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $filename =  $request->filename;
        $attachment = Attachment::find($id);
        $attachment->deleteAttachedFile($filename);
        $attachment->delete();
        $user = \Auth::user();
        /*
        $path = public_path('files') . DIRECTORY_SEPARATOR .  $user->id . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        */
        return $filename;  
    }
}
