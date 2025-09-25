<?php
namespace DVP\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use DVP\Blog\Model\Post as PostModel;
use DVP\Blog\Model\ResourceModel\Post as PostResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(PostModel::class, PostResource::class);
    }
}
