<?php
namespace DVP\Blog\Model\Resolver;

use DVP\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use DVP\Blog\Model\ResourceModel\Comment\CollectionFactory as CommentCollectionFactory;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;

class BlogPosts implements ResolverInterface
{
    protected $postCollectionFactory;
    protected $commentCollectionFactory;

    public function __construct(
        PostCollectionFactory $postCollectionFactory,
        CommentCollectionFactory $commentCollectionFactory
    ) {
        $this->postCollectionFactory = $postCollectionFactory;
        $this->commentCollectionFactory = $commentCollectionFactory;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $postId = $args['post_id'] ?? null;
        $posts = $this->postCollectionFactory->create();

        if ($postId) {
            $posts->addFieldToFilter('post_id', $postId);
        }

        $items = [];
        foreach ($posts->getItems() as $post) {
            $postData = $post->getData();

            $comments = [];
            $commentCollection = $this->commentCollectionFactory->create()
                ->addFieldToFilter('post_id', $post->getId());

            foreach ($commentCollection->getItems() as $comment) {
                $comments[] = $comment->getData();
            }

            $postData['post_comments'] = $comments;
            $items[] = $postData;
        }

        return [
            'totalRecords' => $posts->getSize(),
            'items' => $items
        ];
    }
}
