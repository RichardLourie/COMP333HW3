 <?php

class SongController extends BaseController
{

    /** 

* "/user/list" Endpoint - Get list of users 
6
*/
    public function listAction()
    {
        $strErrorDesc = '';

        $requestMethod = $_SERVER["REQUEST_METHOD"];

        $arrQueryStringParams = $this->getQueryStringParams();


        if (strtoupper($requestMethod) == 'GET') {

            try {

                $songModel = new songModel();
                $intLimit = 10;

                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {

                    $intLimit = $arrQueryStringParams['limit'];
                }

                $arrRatings = $songModel->getSongs($intLimit);

                $responseData = json_encode($arrRatings);
            } catch (Error $e) {

                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';

            }

        } else {

            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';

        }

        // send output 

        if (!$strErrorDesc) {

            $this->sendOutput(

                $responseData,

                array('Content-Type: application/json', 'HTTP/1.1 200 OK')

            );

        } else {

            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 

                array('Content-Type: application/json', $strErrorHeader)

            );

        }

    }

    public function createAction()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if(strtoupper($requestMethod) == 'POST'){
            // retrieve user registration data from the request body

            //$postData = json_decode(file_get_contents('php://input'),true);
            $postData = array($_GET['username'],$_GET['artist'], $_GET['song'], $_GET['rating']);

            //instantiate usermodel
            $songModel = new SongModel();
            $result = $songModel->createRatings($postData);

            $this->sendOutput(json_encode($result),

                array('Content-Type: application/json', 'HTTP/1.1 200 OK')

            );
        }
    }
    public function updateAction()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if(strtoupper($requestMethod) == 'POST'){
            // retrieve user registration data from the request body

            //$postData = json_decode(file_get_contents('php://input'),true);
            $postData = array($_GET['ratingid'],$_GET['artist'], $_GET['song'], $_GET['rating']);

            //instantiate usermodel
            $songModel = new SongModel();
            $result = $songModel->updateRatings($postData);

            $this->sendOutput(json_encode($result),

                array('Content-Type: application/json', 'HTTP/1.1 200 OK')

            );
        }
    }
}