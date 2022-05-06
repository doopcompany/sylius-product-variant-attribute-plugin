<p align="center">
    <a href="https://sylius.com" target="_blank">
        <img src="https://demo.sylius.com/assets/shop/img/logo.png" />
    </a>
</p>

## Sylius Product Variant Attribute Plugin

Add attributes on your products variants.

## Install

Install the plugin with composer

`$ composer require doopcompany/sylius-product-variant-attribute-plugin`

Register the plugin to your `config/bundles.php`

```php
<?php

return [
    // ...
    Doop\SyliusProductVariantAttributePlugin\DoopSyliusProductVariantAttributePlugin::class => ['all' => true],
];
```

Import the configuration file, for example in `config/packages/doop_sylius_product_variant_attribute_plugin.yaml`

```yaml
imports:
    - { resource: '@DoopSyliusProductVariantAttributePlugin/Resources/config/config.yaml' }
```

Import the routing file, for example in `config/routes/sylius_admin.yaml`

```yaml
doop_sylius_product_variant_attribute_plugin:
    resource: '@DoopSyliusProductVariantAttributePlugin/Resources/config/admin_routing.yaml'
    prefix: /admin
```

Update your `ProductVariant` entity by implementing the `ProductVariantInterface` and using the `ProductVariantTrait`

```php
<?php

declare(strict_types=1);

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\ProductVariant as BaseProductVariant;
use Sylius\Component\Product\Model\ProductVariantTranslationInterface;
use Doop\SyliusProductVariantAttributePlugin\Entity\ProductVariantInterface;
use Doop\SyliusProductVariantAttributePlugin\Entity\ProductVariantTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_product_variant")
 */
class ProductVariant extends BaseProductVariant implements ProductVariantInterface
{
    use ProductVariantTrait {
        __construct as attributesConstruct;
    }

    public function __construct()
    {
        parent::__construct();

        $this->attributesConstruct();
    }

    protected function createTranslation(): ProductVariantTranslationInterface
    {
        return new ProductVariantTranslation();
    }
}
```

Finally, don't forget to update your database!

```bash
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
```

## Usage

Like in product edition, variants now has an `Attributes` tab in which you can add attributes. The operation and
possibilities are the same as with the existing attributes.

The variant attributes list differ from the existing one used for products. A new entry is added to the `Catalog` menu
in order to manage this new list.

By default, the existing entry `Attributes` is renamed to `Products attributes`. You can change this behaviour by
defining the following configuration:

```yaml
doop_sylius_product_variant_attribute_plugin:
    rename_product_attribute_menu_entry: false
```
