<?php

namespace Statamic\Addons\Mix;

use Statamic\Extend\Modifier;

class MixModifier extends Modifier
{
  use MixTrait;
  /**
   * Takes the input and turns it into an asset path.
   * 
   * @param string $value Defines whether it's a css file or a js file.
   * @return string
   */
  public function index($value)
  {
    return $this->getAssetPath($value);
  }
}