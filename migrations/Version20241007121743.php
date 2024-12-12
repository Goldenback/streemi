<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241007121743 extends AbstractMigration
{
	public function getDescription(): string
	{
		return '';
	}

	public function up(Schema $schema): void
	{
		$this->addSql('ALTER TABLE comment ADD media_id INT NOT NULL');
		$this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
		$this->addSql('CREATE INDEX IDX_9474526CEA9FDD75 ON comment (media_id)');
	}

	public function down(Schema $schema): void
	{
		$this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CEA9FDD75');
		$this->addSql('DROP INDEX IDX_9474526CEA9FDD75 ON comment');
		$this->addSql('ALTER TABLE comment DROP media_id');
	}
}
