<?php

namespace Drupal\newsletter_sularyy\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a 'newsletter_sularyy.
 *
 * @Block(
 *   id = "countlikes",
 *   admin_label = @Translation("countlikes block"),
 *   category = @Translation("Sularyy"),
 * )
 */

class countlikesBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */

  



  public function build() {

    return [
      '#theme' => '',

      '#attached' => [
        'library' => [
          'countlikes/command.js',
        ],
      ],
    ];
  }

}
