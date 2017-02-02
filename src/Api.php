<?PHP
namespace eLinked;
 
require_once('Document.php'); 
require_once('Exceptions.php'); 

class Api {
    
    private $apiRoot = "https://api.elinked.be/"; 
    
    function __construct($xSoftwareKey, $xUserKey) { 
        // Configuration 
        $this->xSoftwareKey = $xSoftwareKey;
        $this->xUserKey = $xUserKey;
        
        // Initialization
        $this->Document = new Document($this);
        
    }
    
    function get($endpoint, $decode = 'json') { 
        $ch = curl_init($this->apiRoot . str_replace('.json','',$endpoint) . '.json');        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(       
            'X-Software-Key: ' . $this->xSoftwareKey,
            'X-User-Key: ' . $this->xUserKey,
        ));                                                    
        try {
            $result = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
            
            switch($decode) {
                case "json":
                    $result = json_decode($result, true);
                    break;
            }

            return array(
                'http_code' => $httpcode,
                'data' => $result
            );
        } catch(Exception $e) {
            throw new FailedConnectionException();
        } 
    }
    
    function post($endpoint, $data) {  
        $json = json_encode($data); 
        $ch = curl_init($this->apiRoot . str_replace('.json','',$endpoint) . '.json');                       
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);  
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                       
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($json),   
            'X-Software-Key: ' . $this->xSoftwareKey,
            'X-User-Key: ' . $this->xUserKey,
        ));                                  
        try {
            $result = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            return array(
                'http_code' => $httpcode,
                'data' => json_decode($result, true)
            );
        } catch(Exception $e) {
            throw new FailedConnectionException();
        } 
    }  
    
    function put($endpoint, $data) {     
        $json = json_encode($data); 
        $ch = curl_init($this->apiRoot . str_replace('.json','',$endpoint) . '.json');        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");                                                                     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                       
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($json),   
            'X-Software-Key: ' . $this->xSoftwareKey,
            'X-User-Key: ' . $this->xUserKey,
        ));                                     
        try {
            $result = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            return array(
                'http_code' => $httpcode,
                'data' => json_decode($result, true)
            );
        } catch(Exception $e) {
            throw new FailedConnectionException();
        } 
    }
    
    function delete($endpoint) {   
        $json = json_encode($data); 
        $ch = curl_init($this->apiRoot . str_replace('.json','',$endpoint) . '.json');        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");                                                                     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);           
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(      
            'X-Software-Key: ' . $this->xSoftwareKey,
            'X-User-Key: ' . $this->xUserKey,
        ));                                      
        try {
            $result = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            return array(
                'http_code' => $httpcode,
                'data' => json_decode($result, true)
            );
        } catch(Exception $e) {
            throw new FailedConnectionException();
        } 
    }
    
    
}