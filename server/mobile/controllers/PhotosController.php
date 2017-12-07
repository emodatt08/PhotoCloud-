<?php
require_once __DIR__."/../config.php";
require_once SITE_ROOT. "/models/Photo.php";
require_once SITE_ROOT. "/controllers/helpers/headers.php";
class PhotosController extends Photo{

public $db;
public $photo_name;
public function __construct()
    {
        $this->photo =  new Photo();
        $this->response_header = new headers();
    }

public function all($request){
    if(isset($request['user_id'])){
        $photos = $this->photo->all($request);
        if($photos){
            $this->response["responseCode"] = "200";
            $this->response["responseMessage"] = "Successfully retrieved all images";
            $this->response["data"]["photos"] = $photos;
            $this->response_header->response();
            return $this->response_header->json($this->response);
        }else{
            $this->response["responseCode"] = "304";
            $this->response["responseMessage"] = "Failed, no photos for this user";    
            $this->response_header->response();
            return $this->response_header->json($this->response);
        }
       
    }else{
        $this->response["responseCode"] = "304";
        $this->response["responseMessage"] = "Required parameter is missing!";
        $this->response_header->response();
        return $this->response_header->json($this->response);
    }
    }


    public function albums_all($request){
        $this->response_header->logAction($request, 1, "POST", "", "albums_all");
        if(isset($request['user_id'])){
            $albums = $this->photo->albums($request);
            if($albums){
                $this->response["responseCode"] = "200";
                $this->response["responseMessage"] = "Successfully retrieved all albums";
                $this->response["data"]["albums"] = $albums;
                $this->response_header->response();
                $this->response_header->logAction($request, 1, "POST", $this->response, "albums_all");
                return $this->response_header->json($this->response);
            }else{
                $this->response["responseCode"] = "304";
                $this->response["responseMessage"] = "Failed, no albums for this user";    
                $this->response_header->response();
                $this->response_header->logAction($request, 1, "POST", $this->response, "albums_all");
                return $this->response_header->json($this->response);
            }
           
        }else{
            $this->response["responseCode"] = "304";
            $this->response["responseMessage"] = "Required parameter is missing!";
            $this->response_header->response();
            $this->response_header->logAction($request, 1, "POST", $this->response, "albums_all");  
            return $this->response_header->json($this->response);
        }
        }


 public function store($request){
    $this->response_header->logAction($request, 1, "POST", "", "store");
    if (isset($request['user_id']) && isset($request['album_id']) && $request['caption'] && isset($_FILES['image']['name'])) {
     $upload = $this->upload($request);
     if($upload != null){
         $request['image'] = $upload;
            $photo = $this->photo->insert($request);
        if($photo){
            $this->response["responseCode"] = "200";
            $this->response["responseMessage"] = "Successfully stored photo or photos";
            $this->response["data"]["photos"] = $photo;
            $this->response_header->response();
            $this->response_header->logAction($request, 1, "POST", $this->response, "store");
            return $this->response_header->json($this->response);

        }else{

            $this->response["responseCode"] = "304";
            $this->response["responseMessage"] = "Could not store data!";
            $this->response_header->response();
            $this->response_header->logAction($request, 1, "POST", $this->response, "store");
            return $this->response_header->json($this->response);
        }
        }else{
            $this->response["responseCode"] = "404";
            $this->response["responseMessage"] = "Required parameter is missing!";
            $this->response_header->response();
            $this->response_header->logAction($request, 1, "POST", $this->response, "store");
            return $this->response_header->json($this->response);
     }
    
    }
}
 
 public function upload($request){
    $fileData = pathinfo(basename($_FILES["image"]["name"]));
    
    $fileName = uniqid() . '.' . rand(). '.'. $fileData['extension'];
    
    $target_path = $_SERVER['DOCUMENT_ROOT']."/mobile/public/images/" . $fileName;
    
    while(file_exists($target_path))
    {
        $fileName = uniqid() . '.' . $fileData['extension'];
        $target_path = $_SERVER['DOCUMENT_ROOT']."/mobile/public/images/" . $fileName;
    }
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_path))
    {
        return $fileName;
    }else{
        return null;
    }

    }


}