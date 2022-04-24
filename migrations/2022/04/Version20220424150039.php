<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\TabularDataReader;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220424150039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Import fixtures for clinic entity';
    }

    public function up(Schema $schema): void
    {
        foreach ($this->getRows() as $row) {
            $this->addSql($this->getInsertStatement(), $this->getInsertParams($row));
        }
    }

    public function down(Schema $schema): void
    {
    }

    private function getRows(): TabularDataReader
    {
        $csv = (Reader::createFromPath(__DIR__ . '/20220424150039/clinic.csv'))
            ->setHeaderOffset(0)
            ->setDelimiter(',');

        return (Statement::create())->process($csv);
    }

    private function getInsertStatement(): string
    {
        return sprintf(
            "INSERT IGNORE INTO clinic (%s) VALUES (%s)",
            implode(', ', array_keys($this->getInsertColumns())),
            implode(', ', array_values($this->getInsertColumns())),
        );
    }

    private function getInsertColumns(): array
    {
        return [
            'id' => 'NULL',
            'name' => ':name',
            'country' => ':country',
            'city' => ':city',
            'email' => ':email',
            'zip_code' => ':zip_code',
            'street_address' => ':street_address',
            'created_at' => 'NOW()',
            'updated_at' => 'NOW()',
        ];
    }

    private function getInsertParams(array $row): array
    {
        return [
            $row['name'],
            $row['country'],
            $row['city'],
            $row['email'],
            $row['zip_code'],
            $row['street_address'],
        ];
    }
}
