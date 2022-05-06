<?php

declare(strict_types=1);

namespace Doop\SyliusProductVariantAttributePlugin\Form\Type;

use Sylius\Bundle\AttributeBundle\Form\Type\AttributeChoiceType;

final class ProductVariantAttributeChoiceType extends AttributeChoiceType
{
    public function getBlockPrefix(): string
    {
        return 'doop_product_variant_attribute_choice';
    }
}
