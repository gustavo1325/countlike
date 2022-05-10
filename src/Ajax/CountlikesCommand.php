<?php
namespace Drupal\countlikes\Ajax;

use Drupal\Core\Ajax\CommandInterface;

/**
 * Class CountlikesCommand.
 */
class CountlikesCommand implements CommandInterface {

  protected $message;

  public function __construct($message) {
    $this->message = $message;
  }

  /**
   * Render custom ajax command.
   *
   * @return ajax
   *   Command function.
   */
  public function render() {
    return [
      'message' => $this->message,
    ];
  }

}
