<?php
namespace DVP\Blog\Model\Resolver\Mutation;

use DVP\Blog\Model\PostRepository;
use DVP\Blog\Api\PostRepositoryInterface;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;


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

        try {
            $post = $this->postRepository->get($postId); 
            $this->postRepository->delete($post);
            return ['success' => true];
        } catch (NoSuchEntityException $e) {
            return ['success' => false];
        } catch (\Exception $e) {
            throw new LocalizedException(__('Error deleting post: %1', $e->getMessage()));
        }

        $this->postRepository->delete($post);

        return ['success' => true];
    }
}
