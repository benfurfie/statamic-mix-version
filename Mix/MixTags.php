<?php

namespace Statamic\Addons\Mix;

use Statamic\Extend\Tags;

class MixTags extends Tags
{
  use MixTrait;

  /**
   * The {{ mix }} tag - outputs the manifest file as JSON.
   * Largely used for debugging.
   *
   * @return string
   */
  public function index()
  {
    return $this->getManifest()->toJson();
  }

  /**
   * The {{ mix:css }} tag outputs the URL or tag for the theme's main CSS file.
   * 
   * @return string
   */
  public function css()
  {
    $url = $this->getAssetPath('css');
    if($this->getBool('tag')) {
      return '<link rel="stylesheet" href="' . $url . '" />';
    }
    return $url;
  }

  /**
   * The {{ mix:js }} tag outputs the URL or tag for the theme's main JS file.
   *
   * @return string
   */
  public function js()
  {
    $url = $this->getAssetPath('js');
    if($this->getBool('tag')) {
      return '<script src="' . $url . '"></script>';
    }
    return $url;
  }
}