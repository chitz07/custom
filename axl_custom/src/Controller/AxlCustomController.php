<?php
namespace Drupal\axl_custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\NodeType;

/**
 * Provides route responses for the axl_custom module.
 */
class AxlCustomController extends ControllerBase {

  /**
   * @param api_key   The api key set via settings form
   * @param node_id   Node id of a basic page
   * 
   * @return markup
   *   Renders JSON format of a basic page.
   */
  public function jsonPage($api_key, $node_id) {
    $site_api_key = \Drupal::config('axl_custom.settings')->get('siteapikey');
    $values = \Drupal::entityQuery('node')->condition('nid', $node_id)->execute();
    $node_exists = !empty($values);
    if ($node_exists) {
      $entityObj = entity_load('node', $node_id);
      $bundle = $entityObj->bundle();
    }
    //show access denied if the api key provided is not a match or if the node id not a basic page.
    if (($site_api_key != $api_key) || ($bundle != 'page')) {
      throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
    }
    //return the JSON format of the entity.
    else {
      $serializer = \Drupal::service('serializer');
      $data = $serializer->serialize($entityObj, 'json', ['plugin_id' => 'entity']);
      return ['#type' => 'markup',
            '#markup' => $this->t($data)
           ];
    }
  }
}
