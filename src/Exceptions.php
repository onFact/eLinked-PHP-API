<?PHP
namespace eLinked;

// Generic Exception
class Exception extends \Exception {}

// Auth Exceptions
class MissingXUserKeyException extends Exception {}; 
class MissingXSoftwareKeyException extends Exception {}; 


// Post Document Exceptions
class FilenameParameterMissingException extends Exception {}; 
class BodyParameterMissingException extends Exception {}; 
class NoFileParserAvailableException extends Exception {}; 

// Other
class InternalException extends Exception {};
class UnknownErrorException extends Exception {};