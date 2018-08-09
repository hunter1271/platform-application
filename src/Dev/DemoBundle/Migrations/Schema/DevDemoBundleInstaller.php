<?php

namespace Dev\DemoBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Demo dev bundle installer script
 */
class DevDemoBundleInstaller implements Installation
{
    /**
     * @inheritdoc
     */
    public function getMigrationVersion()
    {
        return 'v1_0';
    }

    /**
     * @inheritdoc
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $table = $schema->createTable('dev_demo_products');
        $table->addColumn('id', Type::INTEGER, ['autoincrement' => true]);
        $table->addColumn('name', Type::STRING, ['length' => 255]);
        $table->setPrimaryKey(['id']);
    }
}
