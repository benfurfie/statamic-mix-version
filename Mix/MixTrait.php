<?php

namespace Statamic\Addons\Mix;

use Statamic\API\Config;
use Statamic\API\File;
use Statamic\API\Str;
use Statamic\API\URL;
use Statamic\Extend\HasParameters;

trait MixTrait
{
  /**
   * Access Statamic's methods for retrieving parameters
   */
  use HasParameters;

  /**
   * Define the name of Mix's manifest file.
   */
  static $manifest = 'mix-manifest.json';

  /**
   * Return the path of the given asset file type.
   */
  public function getAssetPath($type)
  {
    /**
     * Check to see if the user has specified a src param.
     * If they have, use that to build the path.
     * Otherwise, default to the theme name.
     */
    $src = $this->getPath();
    /**
     * Build the path by taking the type (passed through the function)
     * and the $src (taken from above).
     */
    $path = '/' . $type . '/' . Str::ensureRight($src, '.' . $type);
    /**
     * Grab the manifest from the collection and pass through the path.
     */
    $manifest = $this->getManifest()->get($path);
    /**
     * Use our themeUrl function to check if the asset exists in the manifest.
     * If it does, pass through the path. Else, return the boolean.
     */
    return $this->themeUrl($manifest ? $manifest : $path);
  }

  /**
   * Check to see if the user has specified a src param.
   * If they have, use that to build the path.
   * Otherwise, default to the theme name.
   */
  private function getPath()
  {
    if($this->get('src'))
    {
      return $this->get('src');
    }
    return $this->get('src', Config::get('theming.theme'));
  }

  /**
   * Transforms the asset directory into a relative or absolute URL
   * for use in the front-end.
   *
   * @param string $path
   * @return string $url
   */
  private function themeUrl($path)
  {
    $theme = Config::get('theming.theme');
    $hotFile = sprintf('%s/hot', rtrim($theme, '/'));

    if (File::disk('themes')->exists($hotFile)) {
      $hotServer = trim(File::disk('themes')->get($hotFile));

      if ($hotServer) {
        return sprintf('%s/%s', rtrim($hotServer, '/'), ltrim($path, '/'));
      }
    }

    $themePath = URL::assemble(
      Config::get('system.filesystems.themes.url'),
      $theme
    );

    $url = URL::assemble(
      $themePath,
      $path
    );

    $url = URL::prependSiteUrl(
      $url,
      $this->get('locale', default_locale()),
      false
    );

    // If user wants the url as an absolute url
    if(!$this->getBool('absolute'))
    {
      $url = URL::makeRelative($url);
    }

    return $url;
  }

  /**
   * Returns the revision manifest contained within a Collection.
   *
   * @return \Illuminate\Support\Collection
   */
  private function getManifest()
  {
    $path = root_path(
      URL::assemble(
        Config::get('system.filesystems.themes.root'),
        Config::get('theming.theme'),
        static::$manifest
      )
    );
    return collect(json_decode(File::get($path), true));
  }
}
