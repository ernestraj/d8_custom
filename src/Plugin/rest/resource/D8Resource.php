<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\d8_custom\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "d8_resource",
 *   label = @Translation("D8 Resource"),
 *   uri_paths = {
 *     "canonical" = "/d8_rest_api/d8_resource",
 *     "https://www.drupal.org/link-relations/create" = "/d8_rest_api/d8_resource/create"
 *   }
 * )
 */
class D8Resource extends ResourceBase {
  /**
   * Responds to entity GET requests.
   * @return \Drupal\rest\ResourceResponse
   */
    
  public function get() {
    //$response = ['message' => 'Hello, this content is coming from rest resource plugin.'];
    $$node = node_load(1);

    $json_string = json_encode($node);
    $response = ['message' => $json_string];
    
    return $json_string;
  }
  
  /**
     * Responds to POST requests.
     * @return \Drupal\rest\ResourceResponse
     * Returns a list of bundles for specified entity.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *   Throws exception expected.
     */
  public function post($data) {
    $first_name = $data['first_name'];
    $full_name = $data['full_name'];
    $entry = array(
      'first_name' => $first_name,
      'full_name' => $full_name
    );
    try {
      $return_value = db_insert('d8_custom')
        ->fields($entry)
        ->execute();
    }
    catch (\Exception $e) {
      drupal_set_message(t('db_insert failed. Message = %message, query= %query', [
        '%message' => $e->getMessage(),
        '%query' => $e->query_string,
      ]
      ), 'error');
    }
    
    $text = 'Your record id is ' . $return_value;
        
    return new ResourceResponse($text);
  }
}