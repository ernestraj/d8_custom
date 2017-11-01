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
 *   label = @Translation("Expose Table"),
 *   uri_paths = {
 *     "canonical" = "/d8_rest_api/expose_table",
 *   }
 * )
 */
class ExposeTableConent extends ResourceBase {
  public function get() {
    //$response = ['message' => 'Hello, this content is coming from rest resource plugin.'];
    $result = db_select('d8_custom','dc')
     ->fields('dc')
     ->execute()
     ->fetchAll();
    $json_string = json_encode($result);
    
    return new ResourceResponse($json_string);
  }
}
