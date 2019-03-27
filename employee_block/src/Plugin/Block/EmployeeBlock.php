<?php

namespace Drupal\employee_block\Plugin\Block;

use Drupal\Core\Database\Connection;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "employee_block",
 *   admin_label = @Translation("Employee block"),
 * )
 */
class EmployeeBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $db = \Drupal::database();
    $query = $db->select('node__field_employee_id', 'eid');
    $query->join('node__field_employee_name', 'ename', 'eid.entity_id = ename.entity_id');
    $query->fields('eid', array('field_employee_id_value'));
    $query->fields('ename', array('field_employee_name_value'));
    $result = $query->execute();
    $resultArray = $result->fetchAll();
    // print_r($resultArray);
    // kint($resultArray);
    // var_dump($resultArray);
    // die();
    // while ($comment = $result->fetchAssoc()) {
    //   print_r($comment);
    // }
    $str = '<table><thead><th>ID</th><th>Name</th></thead>';
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