<?php
/**
 * What can I do? what can't I do!
 * User: mistrzJoda
 * Date: 27.11.15
 */
namespace AppBundle\Tests\Twig;

use AppBundle\DependencyInjection\AppExtension;
use AppBundle\Tests\AppWebTestCase;
use AppBundle\Twig\FontAwesomeExtension;
use Mockery as M;
use Twig_SimpleFunction;

class FontAwesomeExtensionTest extends AppWebTestCase
{
    /** @var  FontAwesomeExtension */
    protected $font;

    protected function setUp()
    {
        $this->font = new FontAwesomeExtension();
    }

    public function testGetFunction()
    {
        /** @var Twig_SimpleFunction[] $twig */
        $twig = $this->font->getFunctions();
        $this->assertEquals('icon', $twig[0]->getName());
    }

    public function testIcon()
    {
        $this->assertEquals('<i class="fa fa-name"> </i>', $this->font->icon('name'));
    }

    public function testGetName()
    {
        $this->assertEquals('font_awesome_extension', $this->font->getName());
    }
}