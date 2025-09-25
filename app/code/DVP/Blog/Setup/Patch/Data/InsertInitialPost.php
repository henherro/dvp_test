<?php
namespace DVP\Blog\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class InsertInitialPost implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $setup = $this->moduleDataSetup;
        $setup->startSetup();

        // 1️⃣ Insertar el post
        $setup->getConnection()->insert(
            $setup->getTable('dvp_blog_post'),
            [
                'title' => 'Primer post de prueba',
                'url_key' => 'primer-post',
                'content' => 'Este es el contenido completo del primer post de prueba.',
                'short_content' => 'Resumen del primer post.',
                'status' => 1, // publicado
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        $postId = $setup->getConnection()->lastInsertId($setup->getTable('dvp_blog_post'));

        // 2️⃣ Insertar dos comentarios para este post
        $setup->getConnection()->insertMultiple(
            $setup->getTable('dvp_blog_post_comment'),
            [
                [
                    'post_id' => $postId,
                    'author_name' => 'Usuario 1',
                    'author_email' => 'usuario1@example.com',
                    'content' => 'Primer comentario de prueba.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'post_id' => $postId,
                    'author_name' => 'Usuario 2',
                    'author_email' => 'usuario2@example.com',
                    'content' => 'Segundo comentario de prueba.',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]
        );

        $setup->endSetup();
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }
}
