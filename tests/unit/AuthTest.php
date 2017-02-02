<?PHP
require_once('src/Api.php'); 

class AuthTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }   
    
    public function testNoAuth() {
        $eLinked = new eLinked\Api("", ""); ;
        
        try {
            $eLinked->Document->parse("","");
        } catch(eLinked\Exception $e) { 
            $this->assertEquals(get_class($e),'eLinked\MissingXUserKeyException'); 
        } 
    } 
    
    public function testNoCompanyKey() {
        $eLinked = new eLinked\Api("", ELINKED_X_USER_KEY); ;
        
        try {
            $eLinked->Document->parse("","");
        } catch(eLinked\Exception $e) { 
            $this->assertEquals(get_class($e),'eLinked\MissingXSoftwareKeyException'); 
        } 
    } 
    
    public function testNoUserKey() {
        $eLinked = new eLinked\Api(ELINKED_X_SOFTWARE_KEY, "");
        
        try {
            $eLinked->Document->parse("efff_BE0010065432_F170001.xml","");
        } catch(eLinked\Exception $e) { 
            $this->assertEquals(get_class($e),'eLinked\MissingXUserKeyException'); 
        } 
    } 
     
    
}
