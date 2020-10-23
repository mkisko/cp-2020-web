<?php
namespace App\Swagger;

use Symfony\Component\Serializer\Normalizer\NormalizableInterface;

final class SwaggerDecorator implements NormalizableInterfacer
{
    private $decorated;

    public function __construct(NormalizerInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $docs = $this->decorated->normalize($object, $format, $context);

        $customDefinition = [
            'name' => 'fields',
            'description' => 'Fields to remove of the output',
            'default' => 'id',
            'in' => 'query',
        ];


        // e.g. add a custom parameter
        $docs['paths']['/foos']['get']['parameters'][] = $customDefinition;

        // e.g. remove an existing parameter
        $docs['paths']['/foos']['get']['parameters'] = array_values(array_filter($docs['paths']['/foos']['get']['parameters'], function ($param) {
            return $param['name'] !== 'bar';
        }));

        // Override title
        $docs['info']['title'] = 'My Api Foo';

        return $docs;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $this->decorated->supportsNormalization($data, $format);
    }
}

