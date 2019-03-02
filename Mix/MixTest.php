<?php

use Statamic\Addons\Mix\MixTags;
use Statamic\Testing\TestCase;

class MixTest extends TestCase
{
  public function mixTags()
  {
    return new MixTags();
  }

  public function testMixDebugReturnsJson()
  {
    $assetPath = $this->mixTags()->index();
    $jsonCheck = json_decode($assetPath);
    $this->assertNotNull($jsonCheck);
  }

  public function testCssFileIsReturned()
  {
    $assetPath = $this->mixTags()->css();
    $this->assertStringEndsWith('css', $assetPath);
    $this->assertStringEndsNotWith('js', $assetPath);
  }

  public function testJsFileIsReturned()
  {
    $assetPath = $this->mixTags()->js();
    $this->assertStringEndsWith('js', $assetPath);
    $this->assertStringEndsNotWith('css', $assetPath);
  }
}
