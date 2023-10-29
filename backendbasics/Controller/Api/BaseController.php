<?php

class BaseController

{

    /** 

* __call magic method. 

*/

    public function __call($name, $arguments)

    {

        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));

    }

    /** 
13
* Get URI elements. 
14
*  
15
* @return array 
16
*/

    protected function getUriSegments()

    {

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $uri = explode( '/', $uri );

        return $uri;

    }

    /** 
26
* Get querystring params. 
27
*  
28
* @return array 
29
*/

    protected function getQueryStringParams()

    {

        return parse_str($_SERVER['QUERY_STRING'], $query);

    }


    /** 
36
* Send API output. 
37
* 
38
* @param mixed $data 
39
* @param string $httpHeader 
40
*/

    protected function sendOutput($data, $httpHeaders=array())

    {

        header_remove('Set-Cookie');

        if (is_array($httpHeaders) && count($httpHeaders)) {

            foreach ($httpHeaders as $httpHeader) {

                header($httpHeader);

            }

        }

        echo $data;

        exit;

    }

}