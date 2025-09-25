<?php
namespace DVP\Blog\Model\GraphQl\Mutation;

use DVP\Blog\Api\PostRepositoryInterface;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\Exception\LocalizedException;

class DeletePost implements ResolverInterface
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $postId = $args['post_id'] ?? null;
        if (!$postId) {
            throw new LocalizedException(__('Post ID is required.'));
        }

        $post = $this->postRepository->getById($postId);
        if (!$post->getId()) {
            throw new LocalizedException(__('Post not found.'));
        }

        $this->postRepository->delete($post);

        return ['success' => true];
    }
}
