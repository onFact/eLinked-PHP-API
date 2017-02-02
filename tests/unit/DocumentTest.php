<?PHP
require_once('src/Api.php'); 

class FeedTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }   
    
    public function testNoFileName() {
        $eLinked = new eLinked\Api(ELINKED_X_SOFTWARE_KEY, ELINKED_X_USER_KEY); ;
        
        try {
            $eLinked->Document->parse("","");
        } catch(eLinked\Exception $e) { 
            $this->assertEquals(get_class($e),'eLinked\FilenameParameterMissingException'); 
        } 
    } 
    
    public function testNoFileBody() {
        $eLinked = new eLinked\Api(ELINKED_X_SOFTWARE_KEY, ELINKED_X_USER_KEY);
        
        try {
            $eLinked->Document->parse("efff_BE0010065432_F170001.xml","");
        } catch(eLinked\Exception $e) { 
            $this->assertEquals(get_class($e),'eLinked\BodyParameterMissingException'); 
        } 
    }
    
    public function testInvalidFile() {
        $eLinked = new eLinked\Api(ELINKED_X_SOFTWARE_KEY, ELINKED_X_USER_KEY);
        
        try {
            $eLinked->Document->parse("efff_BE0010065432_F170001.xml","abc");
        } catch(eLinked\Exception $e) { 
            $this->assertEquals(get_class($e),'eLinked\NoFileParserAvailableException'); 
        } 
    } 
    
    public function testPdfUbl() {
        $eLinked = new eLinked\Api(ELINKED_X_SOFTWARE_KEY, ELINKED_X_USER_KEY);
         
        $body = base64_encode(file_get_contents('tests/unit/data/pdf-with-ubl.pdf'));
        $document = $eLinked->Document->parse("testcase_pdf-with-ubl.pdf.pdf", $body); 
        $expected = json_decode(file_get_contents('tests/unit/data/pdf-with-ubl.json'), TRUE);
        $this->assertArray($expected, $document, "testPdfUbl");
    } 
    
    public function testPdf() {
        $eLinked = new eLinked\Api(ELINKED_X_SOFTWARE_KEY, ELINKED_X_USER_KEY);
         
        $body = base64_encode(file_get_contents('tests/unit/data/pdf.pdf'));
        $document = $eLinked->Document->parse("testcase_pdf.pdf", $body);  
        $expected = json_decode(file_get_contents('tests/unit/data/pdf.json'), TRUE);
        $this->assertArray($expected, $document, "testPdfUbl");
    } 
    
    public function assertArray($expected, $result, $testcase) {
        foreach($expected as $field => $value) {
            if(is_array($value)) {
                $this->assertArray($value, $result[$field], $testcase);
            } else {
                $this->assertEquals($value, $result[$field],'Testcase ' . $testcase  . ' error: ' .  $field . ' - ' . json_encode($result));
            }
        }
    } 
     
    
}
