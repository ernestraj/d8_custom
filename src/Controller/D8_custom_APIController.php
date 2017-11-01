<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of D8APIController
 *
 * @author 206556655
 */

namespace Drupal\d8_cusom\Controller;

use Drupal\Core\Controller\ControllerBase;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class D8_custom_APIController extends ControllerBase {
 
  public function d8_post( Request $request ) {

    // This condition checks the `Content-type` and makes sure to 
    // decode JSON string from the request body into array.
    if ( 0 === strpos( $request->headers->get( 'Content-Type' ), 'application/json' ) ) {
      $data = json_decode( $request->getContent(), TRUE );
      $request->request->replace( is_array( $data ) ? $data : [] );
    }

    $response['data'] = 'Some test data to return';
    $response['method'] = 'POST';

    return new JsonResponse( $response );
  }   //put your code here
}
