<?php

/**
 * @author Kollan Hillary
 *
 */

require "Connection.php";

class Photo extends Connection
{
    public $db;
    public $timestamp;
    
    public function __construct()
    {
        $this->db =  new Connection();
        $this->conn = $this->db->connect();
        $this->timestamp = date("Y-m-d H:i:s");
    }

/**
 * Gets all photos for a user 
 * @return array
 */
    public function all($user_id){
       
        $stmt = $this->conn->prepare("SELECT image FROM photos WHERE user_id = ?");    
                $stmt->bind_param("s", $user_id['user_id']);
                
                // check if user has photos
                if ($stmt->execute() > 0) {
                    $photos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                            return $photos;                       
                } else {
                            return null;
                }
                
}

/**
 * stores photo directory for a user 
 * @return array
 */

    public function insert($photos){
        $photo_url = "http://".gethostbyname(gethostname())."/mobile/public/images/".$photos['image'];
        $stmt = $this->conn->prepare("INSERT INTO photos(user_id, album_id, caption, image, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $photos['user_id'], $photos['album_id'], $photos['caption'], $photo_url, $this->timestamp, $this->timestamp);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
 * Gets all albums for a user 
 * @return array
 */
public function albums($user_id){
    
     $stmt = $this->conn->prepare("SELECT album_name, id FROM albums WHERE user_id = ?");    
             $stmt->bind_param("s", $user_id['user_id']);
             
             // check if user has photos
             if ($stmt->execute() > 0) {
                 $albums = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                         return $albums;                       
             } else {
                         return null;
             }
             
}


}