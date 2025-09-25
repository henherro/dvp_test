<?php
namespace DVP\Blog\Model\GraphQl\Mutation;

use DVP\Blog\Api\PostRepositoryInterface;
use DVP\Blog\Api\Data\PostInterfaceFactory;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Exception\LocalizedException;

class SavePost implements ResolverInterface
{
    protected $postRepository;
    protected $postFactory;

    public function __construct(
        PostRepositoryInterface $postRepository,
        PostInterfaceFactory $postFactory
    ) {
        $this->postRepository = $postRepository;
        $this->postFactory = $postFactory;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $input = $args['input'] ?? null;
        if (!$input) {
            throw new LocalizedException(__('Input is required.'));
        }

        if (!empty($input['post_id'])) {
            try {
                $post = $this->postRepository->getById($input['post_id']);
            } catch (\Exception $e) {
                throw new LocalizedException(__('Post not found.'));
            }
        } else {
            $post = $this->postFactory->create();
        }

        foreach ($input as $key => $val) {
            if ($key !== 'post_id') {
                $post->setData($key, $val);
            }
        }

        $this->postRepository->save($post);

        return [
            'success' => true,
            'post' => $post->getData()
        ];
    }
}
