<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateLocationTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        // $table = $this->table(tableName: 'locations', ['id' => false] );
        $table = $this->table(tableName: 'locations', options: ['id' => false] );

        $table->addColumn(columnName: 'device', type: 'char', options: ['length' => 32] );
        $table->addColumn(columnName: 'latitude', type: 'string', options: ['length' => 10] );
        $table->addColumn(columnName: 'longitude', type: 'string', options: ['length' => 10] );

        $table->create();
    }
}
