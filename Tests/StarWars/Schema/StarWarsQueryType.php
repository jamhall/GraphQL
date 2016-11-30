<?php
/**
 * Date: 07.12.15
 *
 * @author Portey Vasil <portey@gmail.com>
 */

namespace Youshido\Tests\StarWars\Schema;


use Youshido\GraphQL\Field\Field;
use Youshido\GraphQL\Field\FieldFactory;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Execution\ArgumentBag;

class StarWarsQueryType extends AbstractObjectType
{

    /**
     * @return String type name
     */
    public function getName()
    {
        return 'Query';
    }

    public function build($config)
    {
        $config
            ->addField('hero', [
                'type'    => new CharacterInterface(),
                'args'    => [
                    'episode' => ['type' => new EpisodeEnum()]
                ],
                'resolve' => function ($root, ArgumentBag $args) {
                    return StarWarsData::getHero($args->get('episode', null));
                },
            ])
            ->addField(new Field([
                'name'    => 'human',
                'type'    => new HumanType(),
                'args'    => [
                    'id' => new IdType()
                ],
                'resolve' => function ($value = null, ArgumentBag $args) {
                    $humans = StarWarsData::humans();
                    return $args->has('id') ? $humans[$args->get('id')] : null;
                }
            ]))
            ->addField(new Field([
                'name'    => 'droid',
                'type'    => new DroidType(),
                'args'    => [
                    'id' => new IdType()
                ],
                'resolve' => function ($value = null, ArgumentBag $args) {
                    $droids = StarWarsData::droids();
                    return $args->has('id') ? $droids[$args->get('id')] : null;
                }
            ]));
    }
}
