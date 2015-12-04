<?php
/**
 * Created by PhpStorm.
 * User: marcinos
 * Date: 03.12.15
 * Time: 17:58
 */

namespace AppBundle\Tests\Form\Type;


use AppBundle\Form\Type\DateWithDatepickerType;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Mockery as M;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateWithDatepickerTypeTest extends TestCase
{

    public function testParentAndBlockPrefix(){
        $d = $this->getDateWithDatepickerType();

        $this->assertEquals('Symfony\Component\Form\Extension\Core\Type\DateType', $d->getParent());
        $this->assertEquals('date_with_datepicker', $d->getBlockPrefix());
    }

    public function testConfigureOptions()
    {
        $optionResolver = M::mock(OptionsResolver::class);
        $optionResolver->shouldReceive('setDefaults')->once();

        $d = $this->getDateWithDatepickerType();
        $ar_configure_options = $d->configureOptions($optionResolver);

        $this->assertArrayHasKey('widget', $ar_configure_options);
        $this->assertArrayHasKey('format', $ar_configure_options);
        $this->assertArrayHasKey('attr', $ar_configure_options);
        $this->assertArrayHasKey('class', $ar_configure_options['attr']);
        $this->assertArrayHasKey('data-provide', $ar_configure_options['attr']);
        $this->assertArrayHasKey('data-date-format', $ar_configure_options['attr']);
        $this->assertArrayHasKey('data-date-autoclose', $ar_configure_options['attr']);
        $this->assertArrayHasKey('data-date-today-highlight', $ar_configure_options['attr']);

        $this->assertEquals('single_text', $ar_configure_options['widget']);
        $this->assertEquals('yyyy-MM-dd', $ar_configure_options['format']);

        $this->assertEquals('datepicker', $ar_configure_options['attr']['data-provide']);
        $this->assertEquals('yyyy-mm-dd', $ar_configure_options['attr']['data-date-format']);

    }

    private function getDateWithDatepickerType()
    {
        return new DateWithDatepickerType();
    }

}