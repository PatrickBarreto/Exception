<?php

namespace Exception;

use \Exception as phpException;

class Exception {

    /**
     * this method going to instance the class and return and Exception Error
     *
     * @param string $message
     * @param integer $status
     * @param array|null $specialItensException
     */
    public function __construct(string $message, int $status, array $specialItensException = null){
        try{
            throw new phpException($message, $status);
        }catch(phpException $e){
            $this->setHeaders($e);
            echo  $this->buildReturn($e, $specialItensException);
            exit;
        }
    }

    /**
     * This method going to set response headers
     *
     * @param phpException $e
     * @return void
     */
    private function setHeaders(phpException $e) {
        header('Content-Type:application/json');
        http_response_code($e->getCode());
    }

    /**
     * This method going to build the return message
     *
     * @param phpException $e
     * @param object|null $specialItensException
     * @return string
     */
    private function buildReturn(phpException $e, array $specialItensException = null) {
 
        $return = [
            "erro" => $e->getMessage(),
            "status"=> $e->getCode()
        ];

        if ($specialItensException) {
            $return['aditional_informations'] = $specialItensException;
        }
        
        return json_encode($return, JSON_PRETTY_PRINT);
    }
}