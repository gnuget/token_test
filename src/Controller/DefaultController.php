<?php

namespace Drupal\token_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Utility\Token;

/**
 * Class DefaultController.
 *
 * @package Drupal\token_test\Controller
 */
class DefaultController extends ControllerBase {

  /**
   * Drupal\Core\Utility\Token definition.
   *
   * @var \Drupal\Core\Utility\Token
   */
  protected $token;

  /**
   * {@inheritdoc}
   */
  public function __construct(Token $token) {
    $this->token = $token;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('token')
    );
  }

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function hello() {
    $node = node_load(1);
    $value = $this->token->replace('[node:summary]', ['node' => $node]);
    return [
      '#type' => 'markup',
      '#markup' => $value,
    ];
  }

}
