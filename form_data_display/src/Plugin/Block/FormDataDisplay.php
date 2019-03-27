<?php

namespace Drupal\form_data_display\Plugin\Block;

use Drupal\Core\Database\Connection;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "form_data_display_block",
 *   admin_label = @Translation("block"),
 * )
 */
class FormDataDisplay extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $db = \Drupal::database();
    $query = $db->select('custom_form_data', 'custom');
    $query->fields('custom', array('name','phone'));
    $result = $query->execute();
    $resultArray = $result->fetchAll();
    // print_r($resultArray);
    // kint($resultArray);
    // var_dump($resultArray);
    // die();
    // while ($comment = $result->fetchAssoc()) {
    //   print_r($comment);
    // }
    $str = '<table><thead><th>Name</th><th>Phone</th></thead>';
    foreach($resultArray as $key)
    {
      $str .='<tr>';
      foreach($key as $subkey)
      {
        $str .='<td>'.$subkey.'</td>';
      }
      $str .='</tr>';
    }
    $str .= '</table>';
    // $strArray = explode('.',$str);
    // foreach ($strArray as $key) {
    //   # code...
    //   echo $key.'<br>';
    // }
    // die();
    return [
      '#type' => '#markup',
      '#markup' => $str,
    ];
  }
}