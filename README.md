# Skapiec

```php
$feedGenerator = new Sylapi\Feeds\FeedGenerator();
$feedGenerator->setFeed(new Sylapi\Feeds\Skapiec\Feed(
    Sylapi\Feeds\Parameters::create([])
));

$product = new \Sylapi\Feeds\Models\Product();
//...
$feedGenerator->appendProduct($product);
$feedGenerator->appendProduct($product);
//...
$feedGenerator->appendProduct($product);
//...
$feedGenerator->save();
echo $feedGenerator->filePath();
```

## Commands

| COMMAND | DESCRIPTION |
| ------ | ------ |
| composer tests | Testy |
| composer phpstan |  PHPStan |
| composer coverage | PHPUnit Coverage |
| composer coverage-html | PHPUnit Coverage HTML (DIR: ./coverage/) |
