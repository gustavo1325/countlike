<?php

namespace Drupal\countlikes\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\countlikes\Ajax\CountlikesCommand;
use Drupal\Core\Url;
use Drupal\Core\Link;
//use Drupal\node\ NodeInterface;

//use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Defines countlikesController class.
 */

class countlikesController extends ControllerBase {

  /**
   * Display the markup.
   *
   * @return array
   *   Return markup array.
   */



   public function messagesPage() {
      // Create render array.
      $page[] = array(
        '#type' => 'markup',
        '#markup' => $content,
      );
      // Attach JavaScript library.
      $page['#attached']['library'][] = 'countlikes/diadia';
      return $page;
    }

    //consulta todos los datos de countlikes de in id dado
    public function consultalike($id){
      $connection = \Drupal::database();
      $query = $connection->query("SELECT * FROM `countlikes` WHERE id_post='$id'");
      $result = $query->fetchAssoc();
      return $result;
    }

    //create db and row the post $id
    public function newrow($id){
      $campos=array(
        'id_post' => $id,
      );
      $connection = \Drupal::database();
      $connection->insert('countlikes')
      ->fields($campos)
      ->execute();
    }

    //update field countlikes
    public function updatecountlike($id){
      $countresult= $this->consultalike($id);

      $campos=array(
        'count' => $countresult['count'] + 1,
      );
      $connection = \Drupal::database();
      $connection->update('countlikes')
      ->fields($campos)
      ->condition('id_post', $id, '=')
      ->execute();
      return $campos['count'];
    }


  public function content(){

          $estado = $_POST["actualizalike"];
          $id = $_POST["idnode"];
          $inicial=array();
          $existe_fila=false;
      //comprueba si existe la fila del post en la base de datos si no existe la crear e actualiza like(en los dos casos)
        if($estado == inicializa){
            $inicial= $this->consultalike($id);
            $response1 = array(
            'prueba' => $estado,
            'id' => $id,
            'countlike' => $inicial['count']);

            while ($row = $inicial){
              if($row['id_post'] == $id){
                    $existe_fila=true;
                    $response = new AjaxResponse();
                    $response->addCommand(
                    new CountlikesCommand($response1)
                  );
                  return $response;
                }
              }
              if($existe_fila == false){ //si no existe crea la fila con newrow()
                $insertar=$this->newrow($id);
                $response2 = array(
                'countlike' => 0);
                $response = new AjaxResponse();
                $response->addCommand(
                new CountlikesCommand($response2)
              );
              return $response;
              }
      }


//event boton like

  if($estado == bottom){
    $actualiza =$this->updatecountlike($id);
    $response3 = array(
    'countlike' => $actualiza);
    $response = new AjaxResponse();
    $response->addCommand(
      new CountlikesCommand($response3)
    );
      return $response;

  }
  }

  public function readMessageCallback($method, $mid) {
    $message = countlikes_load_message($mid);
    // new AJAX Response object.
    $response = new AjaxResponse();
    // Call the readMessage javascript function.
    $response->addCommand( new ReadMessageCommand($message));

   // Return ajax response.
   return $response;
  }


  public function numberlikes(){
    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = $node->id();
    echo($nid);


  }


}
