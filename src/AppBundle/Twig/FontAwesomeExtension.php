<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 25.11.15
 * Time: 19:37
 */

namespace AppBundle\Twig;


class FontAwesomeExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('icon', [$this, 'icon'], [
                'is_safe' => ['html']
            ]),
        ];
    }

    public function icon($name)
    {
        return sprintf('<i class="fa fa-%s"></i>', $name);
    }

    public function getName()
    {
        return 'font_awesome_extension';
    }

}