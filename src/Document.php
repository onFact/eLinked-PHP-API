<?PHP
namespace eLinked;

class Document {
    
    function __construct(&$api) {
        $this->api = $api;
    }
    
    public function parse($filename, $body) { 
        $response = $this->api->post('documents.json', array(
            'filename' => $filename,
            'body' => $body,
        ));   
        
        if($response['http_code'] == 403) { 
            if($response['data']['name'] == 'MissingXUserKeyException') {
                throw new MissingXUserKeyException();
            }
            if($response['data']['name'] == 'MissingXSoftwareKeyException') {
                throw new MissingXSoftwareKeyException();
            }
        } 
        
        if($response['http_code'] == 400) {
            if($response['data']['name'] == 'FilenameParameterMissingException') {
                throw new FilenameParameterMissingException();
            }
            if($response['data']['name'] == 'BodyParameterMissingException') {
                throw new BodyParameterMissingException();
            }
            if($response['data']['name'] == 'NoFileParserAvailableException') {
                throw new NoFileParserAvailableException();
            } 
        } 
        
        if($response['http_code'] >= 200 && $response['http_code'] < 300) {
            return $response['data'];
        } elseif($response['http_code'] == '500') { 
            throw new InternalException(); 
        } else {
            throw new UnknownErrorException();
        }
    }
    
}